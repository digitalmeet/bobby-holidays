<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    /**
     * Homepage with featured destinations and tours.
     */
    public function home()
    {
        $featuredDestinations = Cache::remember('home.destinations', 300, fn () =>
            Destination::active()
                ->featured()
                ->ordered()
                ->withCount(['tours' => fn ($q) => $q->active()->published()])
                ->limit(8)
                ->get()
        );

        $featuredTours = Cache::remember('home.tours', 300, fn () =>
            Tour::active()
                ->featured()
                ->published()
                ->ordered()
                ->with('destination')
                ->limit(6)
                ->get()
        );

        $testimonials = Cache::remember('home.testimonials', 300, fn () =>
            \App\Models\Testimonial::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->with('tour')
                ->limit(6)
                ->get()
        );

        $posts = Cache::remember('home.posts', 300, fn () =>
            Post::published()
                ->latest('published_at')
                ->limit(3)
                ->get()
        );

        return view('frontend.home', compact('featuredDestinations', 'featuredTours', 'testimonials', 'posts'));
    }

    /**
     * All destinations listing.
     */
    public function destinations()
    {
        $destinations = Cache::remember('destinations.list', 300, fn () =>
            Destination::active()
                ->ordered()
                ->withCount(['tours' => fn ($q) => $q->active()->published()])
                ->paginate(12)
        );

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

        $query = $this->applyTourFilters($query, $request);

        $tours = $query->paginate(12)->withQueryString();

        return view('frontend.packages-domestic', compact('tours'));
    }

    public function toursInternational(Request $request)
    {
        $query = Tour::active()
            ->published()
            ->whereHas('destination', fn ($q) => $q->where('continent', '!=', 'Domestic'))
            ->ordered()
            ->with('destination');

        $query = $this->applyTourFilters($query, $request);

        $tours = $query->paginate(12)->withQueryString();

        return view('frontend.packages-international', compact('tours'));
    }

    private function applyTourFilters($query, Request $request)
    {
        if ($request->filled('duration')) {
            match ($request->duration) {
                '1-3'  => $query->where('duration_days', '<=', 3),
                '4-6'  => $query->whereBetween('duration_days', [4, 6]),
                '7+'   => $query->where('duration_days', '>=', 7),
                default => null,
            };
        }

        if ($request->filled('budget')) {
            match ($request->budget) {
                'under15'  => $query->where('starting_price', '<', 15000),
                '15-30'    => $query->whereBetween('starting_price', [15000, 30000]),
                '30-60'    => $query->whereBetween('starting_price', [30000, 60000]),
                '60plus'   => $query->where('starting_price', '>', 60000),
                default    => null,
            };
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        return $query;
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
            ->limit(4)
            ->get();

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
        $faqs = Cache::remember('faqs.grouped', 600, fn () =>
            Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->groupBy('category')
        );

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
        $services = Cache::remember('services.list', 600, fn () =>
            Page::service()->published()->orderBy('sort_order')->get()
        );

        return view('frontend.services', compact('services'));
    }

    public function serviceShow(string $slug)
    {
        $service = Page::service()->published()->where('slug', $slug)->firstOrFail();
        $services = Page::service()->published()->orderBy('sort_order')->get();

        return view('frontend.service-detail', compact('service', 'services'));
    }
}
