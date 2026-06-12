@extends('frontend.layouts.app')

@section('title', 'UniWorld Holidays - Premium Domestic and International Tours')

@section('content')
    <section class="hero-section parallax-hero">
        <div class="parallax-orbit parallax-orbit-one"></div>
        <div class="parallax-orbit parallax-orbit-two"></div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <span class="hero-kicker"><i class="fa-solid fa-plane-departure"></i> Premium travel planning</span>
                <h1 class="hero-title">Curated holidays across India and the world.</h1>
                <p class="hero-text">UniWorld Holidays crafts elegant itineraries for families, couples, groups, and corporate travellers with the right balance of comfort, sightseeing, and care.</p>
                <div class="hero-actions d-flex flex-wrap gap-3">
                    <a class="btn-brand btn-accent" href="{{ route('frontend.domestic') }}"><i class="fa-solid fa-map-location-dot"></i> Explore Packages</a>
                    <a class="btn-outline-brand" href="{{ route('frontend.contact') }}"><i class="fa-solid fa-headset"></i> Plan My Trip</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat"><strong>100+</strong><span>Curated destinations</span></div>
                    <div class="hero-stat"><strong>12+</strong><span>Years travel expertise</span></div>
                    <div class="hero-stat"><strong>24/7</strong><span>Trip assistance</span></div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.search-form')

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Signature Destinations',
                'title' => 'Blue-sky escapes travellers ask for first',
                'text' => 'Static destination cards today, ready for CMS-managed destination records, galleries, and package relations later.',
            ])
            <div class="destination-carousel owl-carousel owl-theme">
                @include('frontend.components.destination-card', ['image' => 'assets/frontend/images/destination-goa.svg', 'title' => 'Goa Coastal Escape', 'location' => 'India', 'duration' => '4 Days', 'description' => 'Beach stays, relaxed cafes, water sports, and sunset evenings planned with smooth transfers.', 'url' => route('frontend.domestic')])
                @include('frontend.components.destination-card', ['image' => 'assets/frontend/images/destination-kashmir.svg', 'title' => 'Kashmir Valley Retreat', 'location' => 'India', 'duration' => '6 Days', 'description' => 'Houseboats, gardens, snow views, and elegant sightseeing across Srinagar and Gulmarg.', 'url' => route('frontend.domestic')])
                @include('frontend.components.destination-card', ['image' => 'assets/frontend/images/destination-dubai.svg', 'title' => 'Dubai Luxury Break', 'location' => 'UAE', 'duration' => '5 Days', 'description' => 'Desert safari, Burj Khalifa, marina evenings, premium shopping, and family attractions.', 'url' => route('frontend.international')])
                @include('frontend.components.destination-card', ['image' => 'assets/frontend/images/destination-bali.svg', 'title' => 'Bali Honeymoon Mood', 'location' => 'Indonesia', 'duration' => '6 Days', 'description' => 'Private villas, temples, beaches, floating breakfast, and slow romantic experiences.', 'url' => route('frontend.international')])
            </div>
        </div>
    </section>

    <section class="section-padding bg-soft">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-media">
                        <img src="{{ asset('assets/frontend/images/about-agency.svg') }}" alt="UniWorld Holidays planning desk">
                        <div class="experience-badge">
                            <strong>12+</strong>
                            <span>Years of travel craft</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="section-kicker"><i class="fa-solid fa-circle-check"></i> The UniWorld Way</span>
                    <h2 class="section-title">Travel planning that feels calm, clear, and personal.</h2>
                    <p class="section-text mb-4">We help travellers choose the right destination, hotel category, route, activities, and travel pace. Every block is static now but structured for future package, destination, testimonial, and enquiry data.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-route', 'title' => 'Balanced Itineraries', 'description' => 'Sightseeing, leisure, transfers, and rest time planned with care.'])</div>
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-shield-heart', 'title' => 'Reliable Support', 'description' => 'Practical help before, during, and after the journey.'])</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Best Selling Packages',
                'title' => 'Holiday plans built for real travellers',
                'text' => 'These cards are ready to become dynamic package records with slugs, inclusions, seasonal rates, and enquiry tracking.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-kashmir.svg', 'title' => 'Kashmir Delight', 'duration' => '5 Nights / 6 Days', 'type' => 'Family', 'description' => 'Srinagar, Gulmarg, Pahalgam, houseboat stay, and scenic transfers.', 'price' => 'INR 24,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-dubai.svg', 'title' => 'Dubai Explorer', 'duration' => '4 Nights / 5 Days', 'type' => 'Group', 'description' => 'City tour, desert safari, dhow cruise, and Burj Khalifa experience.', 'price' => 'INR 49,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-bali.svg', 'title' => 'Romantic Bali', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Villa stay, island tours, beach clubs, and honeymoon inclusions.', 'price' => 'INR 64,999', 'url' => route('frontend.package.show')])</div>
            </div>
        </div>
    </section>

    @include('frontend.components.cta')

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Services',
                'title' => 'Everything your trip needs',
                'text' => 'Service blocks can later connect to service pages, destination modules, or CMS-managed content.',
            ])
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-suitcase-rolling', 'title' => 'Tour Packages', 'description' => 'Domestic and international packages for every travel style.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Booking', 'description' => 'Comfortable stays across budget, premium, and luxury categories.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-passport', 'title' => 'Visa Assistance', 'description' => 'Document checklist, appointment support, and application guidance.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-plane', 'title' => 'Flights', 'description' => 'Flight options matched with route, budget, and package timing.'])</div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-soft">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Guest Notes',
                'title' => 'Designed for confident travel',
                'text' => 'Testimonials are static placeholders ready for approval status, ratings, traveller type, and destination relations.',
            ])
            <div class="testimonial-carousel owl-carousel owl-theme">
                <div class="testimonial-card">
                    <div class="rating mb-3">★★★★★</div>
                    <p class="text-muted">The Dubai plan was smooth from pickup to sightseeing. We had enough time for family activities and relaxed evenings.</p>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <span class="testimonial-avatar d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-user"></i></span>
                        <div><strong>Mehta Family</strong><span class="d-block text-muted small">Dubai Explorer</span></div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="rating mb-3">★★★★★</div>
                    <p class="text-muted">Our Kashmir trip felt beautifully paced. Hotels, car, and sightseeing were handled with real attention.</p>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <span class="testimonial-avatar d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-user"></i></span>
                        <div><strong>Shah Family</strong><span class="d-block text-muted small">Kashmir Retreat</span></div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="rating mb-3">★★★★★</div>
                    <p class="text-muted">The honeymoon inclusions in Bali were thoughtful, and the itinerary still gave us enough private time.</p>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <span class="testimonial-avatar d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-user"></i></span>
                        <div><strong>Aarav & Nisha</strong><span class="d-block text-muted small">Bali Honeymoon</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Travel Stories',
                'title' => 'Helpful reads before you go',
                'text' => 'Blog cards are static placeholders for future posts, categories, slugs, and SEO data.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-family-trip.svg', 'title' => 'How to plan a family holiday without stress', 'date' => '08 Jun 2026', 'category' => 'Planning', 'description' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time.', 'url' => route('frontend.blog.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-passport.svg', 'title' => 'Visa documents travellers should prepare early', 'date' => '08 Jun 2026', 'category' => 'Visa', 'description' => 'A practical checklist for smoother international trip preparation.', 'url' => route('frontend.blog.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/blog-honeymoon.svg', 'title' => 'Best honeymoon ideas for beach lovers', 'date' => '08 Jun 2026', 'category' => 'Honeymoon', 'description' => 'Beach destinations with privacy, romance, and memorable local experiences.', 'url' => route('frontend.blog.show')])</div>
            </div>
        </div>
    </section>
@endsection
