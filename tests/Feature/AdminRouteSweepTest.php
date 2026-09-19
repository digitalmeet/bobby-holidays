<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Quotation;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\User;
use Database\Seeders\ClientDemoSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRouteSweepTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_admin_index_create_edit_and_report_page_renders_for_super_admin(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(ClientDemoSeeder::class);

        $admin = User::where('email', 'demo.admin@uniworld.test')->firstOrFail();
        $this->actingAs($admin);

        $staticRoutes = [
            'filament.admin.pages.dashboard',
            'filament.admin.pages.manage-settings',
            'filament.admin.pages.sales-report',
            'filament.admin.pages.revenue-report',
            'filament.admin.pages.bookings-report',
            'filament.admin.pages.activity-report',
            'filament.admin.resources.banners.index',
            'filament.admin.resources.bookings.index',
            'filament.admin.resources.destinations.index',
            'filament.admin.resources.enquiries.index',
            'filament.admin.resources.faqs.index',
            'filament.admin.resources.follow-ups.index',
            'filament.admin.resources.pages.index',
            'filament.admin.resources.posts.index',
            'filament.admin.resources.quotations.index',
            'filament.admin.resources.roles.index',
            'filament.admin.resources.testimonials.index',
            'filament.admin.resources.tours.index',
            'filament.admin.resources.users.index',
            'filament.admin.resources.banners.create',
            'filament.admin.resources.bookings.create',
            'filament.admin.resources.destinations.create',
            'filament.admin.resources.enquiries.create',
            'filament.admin.resources.faqs.create',
            'filament.admin.resources.pages.create',
            'filament.admin.resources.posts.create',
            'filament.admin.resources.quotations.create',
            'filament.admin.resources.roles.create',
            'filament.admin.resources.testimonials.create',
            'filament.admin.resources.tours.create',
            'filament.admin.resources.users.create',
        ];

        foreach ($staticRoutes as $routeName) {
            $this->get(route($routeName))
                ->assertOk("Admin route [{$routeName}] did not render successfully.");
        }

        $editRoutes = [
            'filament.admin.resources.banners.edit' => Banner::firstOrFail(),
            'filament.admin.resources.bookings.edit' => Booking::firstOrFail(),
            'filament.admin.resources.destinations.edit' => Destination::firstOrFail(),
            'filament.admin.resources.enquiries.edit' => Enquiry::firstOrFail(),
            'filament.admin.resources.faqs.edit' => Faq::firstOrFail(),
            'filament.admin.resources.pages.edit' => Page::firstOrFail(),
            'filament.admin.resources.posts.edit' => Post::firstOrFail(),
            'filament.admin.resources.quotations.edit' => Quotation::firstOrFail(),
            'filament.admin.resources.roles.edit' => Role::firstOrFail(),
            'filament.admin.resources.testimonials.edit' => Testimonial::firstOrFail(),
            'filament.admin.resources.tours.edit' => Tour::firstOrFail(),
            'filament.admin.resources.users.edit' => User::firstOrFail(),
        ];

        foreach ($editRoutes as $routeName => $record) {
            $this->get(route($routeName, ['record' => $record]))
                ->assertOk("Admin edit route [{$routeName}] did not render successfully.");
        }
    }

    public function test_demo_public_browsing_flow_and_placeholder_media_render(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(ClientDemoSeeder::class);

        $tour = Tour::firstOrFail();
        $destination = Destination::firstOrFail();
        $post = Post::firstOrFail();

        foreach ([
            route('frontend.home'),
            route('frontend.destinations'),
            route('frontend.destination.show', $destination->slug),
            route('frontend.domestic'),
            route('frontend.international'),
            route('frontend.tour.show', $tour->slug),
            route('frontend.services'),
            route('frontend.blog'),
            route('frontend.blog.show', $post->slug),
            route('frontend.faq'),
            route('frontend.contact'),
            route('frontend.about'),
            route('frontend.gallery'),
            route('frontend.privacy'),
            route('frontend.terms'),
        ] as $url) {
            $response = $this->get($url);
            $this->assertSame(200, $response->getStatusCode(), "Public URL [{$url}] did not render successfully.");
        }

        foreach (['holiday-packages', 'hotel-booking', 'flights', 'visa-assistance', 'cruise', 'corporate-travel', 'travel-insurance'] as $serviceSlug) {
            $this->get(route('frontend.service.show', $serviceSlug))
                ->assertOk("Service page [{$serviceSlug}] did not render successfully.");
        }

        $this->get(route('frontend.home'))
            ->assertSee('Journeys designed around the way you want to travel.')
            ->assertSee('Tailor-Made India &amp; International Holidays', false);

        $this->assertDatabaseHas('settings', [
            'key' => 'company_tagline',
            'value' => 'Personalised holidays, thoughtfully planned',
        ]);

        $this->get(route('frontend.tour.show', $tour->slug))
            ->assertSee('People also explore')
            ->assertSee('Popular searches');

        $this->assertSame(
            asset('assets/frontend/images/image-placeholder.svg'),
            media_url(null),
        );
        $this->assertFileExists(public_path('assets/frontend/images/image-placeholder.svg'));
    }
}
