<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Tour;
use App\Models\TourPricing;
use App\Models\Traveller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;
use App\Policies\BookingPolicy;
use App\Policies\DestinationPolicy;
use App\Policies\EnquiryPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\QuotationPolicy;
use App\Policies\QuotationItemPolicy;
use App\Policies\TourPolicy;
use App\Policies\TourPricingPolicy;
use App\Policies\TravellerPolicy;
use App\Policies\PagePolicy;
use App\Policies\PostPolicy;
use App\Policies\BannerPolicy;
use App\Policies\TestimonialPolicy;
use App\Policies\FaqPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Travel core models
        Destination::class => DestinationPolicy::class,
        Tour::class => TourPolicy::class,
        TourPricing::class => TourPricingPolicy::class,
        
        // Enquiry and quotation models
        Enquiry::class => EnquiryPolicy::class,
        Quotation::class => QuotationPolicy::class,
        QuotationItem::class => QuotationItemPolicy::class,
        
        // Booking and payment models
        Booking::class => BookingPolicy::class,
        Traveller::class => TravellerPolicy::class,
        Payment::class => PaymentPolicy::class,
        
        // CMS models
        Page::class => PagePolicy::class,
        Post::class => PostPolicy::class,
        Banner::class => BannerPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Faq::class => FaqPolicy::class,
        Setting::class => SettingPolicy::class,
        
        // User management models
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates if needed
        Gate::before(function (User $user, string $ability) {
            // Super admin bypasses all gates
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}