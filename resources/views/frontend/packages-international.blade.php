@extends('frontend.layouts.app')

@section('title', 'International Packages - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'International Packages'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'World Tours',
                'title' => 'International packages made simple',
                'text' => 'Perfect for connecting package records, visa rules, inclusions, and seasonal pricing later.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-dubai.svg', 'title' => 'Dubai Explorer', 'duration' => '4 Nights / 5 Days', 'type' => 'Group', 'description' => 'City tour, dhow cruise, desert safari, and Burj Khalifa ticket.', 'price' => 'INR 49,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-bali.svg', 'title' => 'Bali Honeymoon', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Villa stay, temple tours, beaches, and romantic experiences.', 'price' => 'INR 64,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/blog-passport.svg', 'title' => 'Singapore Family Fun', 'duration' => '4 Nights / 5 Days', 'type' => 'Family', 'description' => 'Sentosa, Universal Studios, city tour, and family-friendly hotels.', 'price' => 'INR 59,999', 'url' => route('frontend.package.show')])</div>
            </div>
        </div>
    </section>
@endsection
