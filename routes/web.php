<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Route;

// Public Quotation Routes
Route::prefix('quote')->group(function () {
    Route::get('/{publicId}', [QuotationController::class, 'show'])->name('quotation.public');
    Route::get('/{publicId}/pdf', [QuotationController::class, 'downloadPdf'])->name('quotation.pdf');
    Route::post('/{publicId}/accept', [QuotationController::class, 'accept'])->name('quotation.accept');
    Route::post('/{publicId}/reject', [QuotationController::class, 'reject'])->name('quotation.reject');
});

// Online Payment Routes (Razorpay — feature-flagged)
Route::prefix('pay')->group(function () {
    Route::get('/{publicId}', [RazorpayController::class, 'paymentPage'])->name('payment.page');
    Route::post('/create-order', [RazorpayController::class, 'createOrder'])->name('payment.create-order');
    Route::post('/verify', [RazorpayController::class, 'verifyPayment'])->name('payment.verify');
});

// Frontend Routes
Route::name('frontend.')->group(function () {
    // Dynamic pages
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations');
    Route::get('/destinations/{slug}', [FrontendController::class, 'destinationShow'])->name('destination.show');
    Route::get('/domestic-packages', [FrontendController::class, 'toursDomestic'])->name('domestic');
    Route::get('/international-packages', [FrontendController::class, 'toursInternational'])->name('international');
    Route::get('/packages/{slug}', [FrontendController::class, 'tourShow'])->name('tour.show');

    // Contact form
    Route::get('/contact-us', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');

    // CMS-managed pages (dynamic from DB, with known slug fallback)
    Route::get('/about-us', [FrontendController::class, 'page'])->name('about')->defaults('slug', 'about-us');
    Route::get('/gallery', [FrontendController::class, 'page'])->name('gallery')->defaults('slug', 'gallery');
    Route::get('/privacy-policy', [FrontendController::class, 'page'])->name('privacy')->defaults('slug', 'privacy-policy');
    Route::get('/terms-conditions', [FrontendController::class, 'page'])->name('terms')->defaults('slug', 'terms-conditions');
    Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page.show');

    // Service pages
    Route::get('/services', [FrontendController::class, 'services'])->name('services');
    Route::get('/services/{slug}', [FrontendController::class, 'serviceShow'])->name('service.show');

    // Dynamic CMS pages
    Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
    Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
});
