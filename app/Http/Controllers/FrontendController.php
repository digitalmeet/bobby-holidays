<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FrontendController extends Controller
{
    /**
     * Homepage with featured destinations and tours.
     */
    public function home()
    {
        $heroBanners = Banner::currentlyVisible()
            ->byPosition('homepage_hero')
            ->orderBy('sort_order')
            ->limit(5)
            ->get();

        $featuredDestinations = Destination::active()
            ->featured()
            ->ordered()
            ->withCount(['tours' => fn ($q) => $q->active()->published()])
            ->limit(8)
            ->get();

        $featuredTours = Tour::active()
            ->featured()
            ->published()
            ->ordered()
            ->with('destination')
            ->limit(6)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->with('tour')
            ->limit(6)
            ->get();

        $posts = Post::published()
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('frontend.home', compact('heroBanners', 'featuredDestinations', 'featuredTours', 'testimonials', 'posts'));
    }

    /**
     * All destinations listing.
     */
    public function destinations()
    {
        $destinations = Destination::active()
            ->ordered()
            ->withCount(['tours' => fn ($q) => $q->active()->published()])
            ->paginate(12);

        return view('frontend.destinations', compact('destinations'));
    }

    /**
     * Single destination page with its tours.
     */
    public function destinationShow(string $slug)
    {
        $destination = Destination::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $tours = Tour::where('destination_id', $destination->id)
            ->active()
            ->published()
            ->ordered()
            ->paginate(12);

        return view('frontend.destination-detail', compact('destination', 'tours'));
    }

    /**
     * All tours listing (domestic packages).
     */
    public function toursDomestic(Request $request)
    {
        $query = Tour::active()
            ->published()
            ->whereHas('destination', fn ($q) => $q->where('continent', 'Domestic'))
            ->ordered()
            ->with('destination');

        $filters = $this->decodeTourFilters($request);
        $query = $this->applyTourFilters($query, $filters);

        $tours = $query->paginate(12)->withQueryString();

        return view('frontend.packages-domestic', compact('tours', 'filters'));
    }

    public function toursInternational(Request $request)
    {
        $query = Tour::active()
            ->published()
            ->whereHas('destination', fn ($q) => $q->where('continent', '!=', 'Domestic'))
            ->ordered()
            ->with('destination');

        $filters = $this->decodeTourFilters($request);
        $query = $this->applyTourFilters($query, $filters);

        $tours = $query->paginate(12)->withQueryString();

        return view('frontend.packages-international', compact('tours', 'filters'));
    }

    public function filterTours(Request $request)
    {
        $filters = $request->validate([
            'market' => 'required|in:domestic,international',
            'duration' => 'nullable|in:1-3,4-6,7+',
            'budget' => 'nullable|in:under15,15-30,30-60,60plus',
            'category' => 'nullable|in:family,couple,group,solo,adventure',
        ]);

        $route = $filters['market'] === 'domestic' ? 'frontend.domestic' : 'frontend.international';
        unset($filters['market']);

        return redirect()->route($route, ['filters' => encrypted_query($filters)]);
    }

    private function applyTourFilters($query, array $filters)
    {
        if (!empty($filters['duration'])) {
            match ($filters['duration']) {
                '1-3'  => $query->where('duration_days', '<=', 3),
                '4-6'  => $query->whereBetween('duration_days', [4, 6]),
                '7+'   => $query->where('duration_days', '>=', 7),
                default => null,
            };
        }

        if (!empty($filters['budget'])) {
            match ($filters['budget']) {
                'under15'  => $query->where('starting_price', '<', 15000),
                '15-30'    => $query->whereBetween('starting_price', [15000, 30000]),
                '30-60'    => $query->whereBetween('starting_price', [30000, 60000]),
                '60plus'   => $query->where('starting_price', '>', 60000),
                default    => null,
            };
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        return $query;
    }

    private function decodeTourFilters(Request $request): array
    {
        if (!$request->filled('filters')) {
            return [];
        }

        try {
            $filters = json_decode(Crypt::decryptString((string) $request->query('filters')), true, 512, JSON_THROW_ON_ERROR);

            return array_intersect_key($filters, array_flip(['duration', 'budget', 'category']));
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * Single tour detail page.
     */
    public function tourShow(string $slug)
    {
        $tour = Tour::where('slug', $slug)
            ->active()
            ->published()
            ->with(['destination', 'pricing' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->firstOrFail();

        $relatedTours = Tour::where('destination_id', $tour->destination_id)
            ->where('id', '!=', $tour->id)
            ->active()
            ->published()
            ->with('destination')
            ->limit(3)
            ->get();

        // Keep discovery useful even when a destination has only one package.
        if ($relatedTours->count() < 3) {
            $fallbackTours = Tour::where('id', '!=', $tour->id)
                ->whereNotIn('id', $relatedTours->pluck('id'))
                ->active()
                ->published()
                ->with('destination')
                ->when($tour->category, fn ($query, $category) => $query->orderByRaw('CASE WHEN category = ? THEN 0 ELSE 1 END', [$category]))
                ->latest('published_at')
                ->limit(3 - $relatedTours->count())
                ->get();

            $relatedTours = $relatedTours->concat($fallbackTours);
        }

        return view('frontend.tour-detail', compact('tour', 'relatedTours'));
    }

    /**
     * Blog listing page.
     */
    public function blog()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.blog', compact('posts'));
    }

    /**
     * Single blog post page.
     */
    public function blogShow(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('frontend.blog-detail', compact('post', 'relatedPosts'));
    }

    /**
     * FAQ page.
     */
    public function faq()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('frontend.faq', compact('faqs'));
    }

    /**
     * Dynamic CMS page.
     */
    public function page(Request $request, ?string $slug = null)
    {
        $slug = $slug ?? $request->route('slug');

        // Dedicated blade files for specific pages
        $dedicatedViews = [
            'about-us' => 'frontend.about',
            'gallery' => 'frontend.gallery',
            'privacy-policy' => 'frontend.privacy',
            'terms-conditions' => 'frontend.terms',
        ];

        $page = Page::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $view = $dedicatedViews[$slug] ?? 'frontend.page';

        return view($view, compact('page'));
    }

    /**
     * Services listing page.
     */
    public function services()
    {
        $services = Page::service()->published()->orderBy('sort_order')->get();

        return view('frontend.services', compact('services'));
    }

    public function serviceShow(string $slug)
    {
        $service = Page::service()->published()->where('slug', $slug)->firstOrFail();
        $services = Page::service()->published()->orderBy('sort_order')->get();

        return view('frontend.service-detail', compact('service', 'services'));
    }
}
