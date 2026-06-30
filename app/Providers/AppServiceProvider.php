<?php

namespace App\Providers;

use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\Quotation;
use App\Observers\EnquiryObserver;
use App\Observers\PaymentObserver;
use App\Observers\QuotationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Enquiry::observe(EnquiryObserver::class);
        Quotation::observe(QuotationObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
