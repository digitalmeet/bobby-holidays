<?php

use Illuminate\Support\Facades\Route;

Route::name('frontend.')->group(function () {
    Route::view('/', 'frontend.home')->name('home');
    Route::view('/about-us', 'frontend.about')->name('about');
    Route::view('/domestic-packages', 'frontend.packages-domestic')->name('domestic');
    Route::view('/international-packages', 'frontend.packages-international')->name('international');
    Route::view('/services', 'frontend.services')->name('services');
    Route::view('/gallery', 'frontend.gallery')->name('gallery');
    Route::view('/faq', 'frontend.faq')->name('faq');
    Route::view('/blog', 'frontend.blog')->name('blog');
    Route::view('/packages/kashmir-delight', 'frontend.package-detail')->name('package.show');
    Route::view('/blog/family-holiday-planning', 'frontend.blog-detail')->name('blog.show');
    Route::view('/contact-us', 'frontend.contact')->name('contact');
    Route::view('/privacy-policy', 'frontend.privacy')->name('privacy');
    Route::view('/terms-conditions', 'frontend.terms')->name('terms');
});
