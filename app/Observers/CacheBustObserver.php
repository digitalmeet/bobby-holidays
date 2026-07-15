<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CacheBustObserver
{
    public function saved($model): void
    {
        $this->bust($model);
    }

    public function deleted($model): void
    {
        $this->bust($model);
    }

    private function bust($model): void
    {
        $class = class_basename($model);

        match ($class) {
            'Tour' => Cache::forget('home.tours'),
            'Destination' => collect(['home.destinations', 'destinations.list'])->each(fn ($k) => Cache::forget($k)),
            'Post' => Cache::forget('home.posts'),
            'Testimonial' => Cache::forget('home.testimonials'),
            'Faq' => Cache::forget('faqs.grouped'),
            'Page' => Cache::forget('services.list'),
            'Enquiry' => collect(['nav.enquiries.new', 'dashboard_stats'])->each(fn ($k) => Cache::forget($k)),
            'Booking' => collect(['nav.bookings.active', 'dashboard_stats'])->each(fn ($k) => Cache::forget($k)),
            'Quotation' => collect(['nav.quotations.draft', 'dashboard_stats'])->each(fn ($k) => Cache::forget($k)),
            'Payment' => Cache::forget('dashboard_stats'),
            default => null,
        };
    }
}
