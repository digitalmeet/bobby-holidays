<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Quotation;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Observers\CacheBustObserver;
use App\Observers\EnquiryObserver;
use App\Observers\PaymentObserver;
use App\Observers\QuotationObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Slow query logging in local environment
        if ($this->app->isLocal()) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
                    logger()->warning("Slow query ({$query->time}ms): {$query->sql}", [
                        'bindings' => $query->bindings,
                    ]);
                }
            });
        }

        Enquiry::observe(EnquiryObserver::class);
        Quotation::observe(QuotationObserver::class);
        Payment::observe(PaymentObserver::class);

        // Cache invalidation on content changes
        Tour::observe(CacheBustObserver::class);
        Destination::observe(CacheBustObserver::class);
        Post::observe(CacheBustObserver::class);
        Testimonial::observe(CacheBustObserver::class);
        Faq::observe(CacheBustObserver::class);
        Page::observe(CacheBustObserver::class);
        Booking::observe(CacheBustObserver::class);
        Quotation::observe(CacheBustObserver::class);
    }
}
