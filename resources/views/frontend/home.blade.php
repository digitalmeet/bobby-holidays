@extends('frontend.layouts.app')

@section('title', 'Tailor-Made India & International Holidays | UniWorld Holidays')
@section('meta_description', 'Plan tailor-made holidays across India, Asia, the Middle East and island destinations with considered itineraries, clear proposals and dependable trip support.')

@section('content')
    <section class="hero-section parallax-hero">
        <div class="hero-carousel swiper" aria-hidden="true">
            <div class="swiper-wrapper">
                @forelse($heroBanners ?? [] as $banner)
                    <div class="swiper-slide hero-carousel-slide">
                        @if($banner->media_type === 'video' && $banner->video_path)
                            <video class="hero-media" autoplay muted loop playsinline preload="metadata" poster="{{ media_url($banner->video_poster, 'assets/frontend/images/demo/destination-goa.webp') }}">
                                <source src="{{ media_url($banner->video_path) }}" type="{{ str_ends_with(strtolower($banner->video_path), '.webm') ? 'video/webm' : 'video/mp4' }}">
                            </video>
                        @else
                            <img class="hero-media" src="{{ media_url($banner->image, 'assets/frontend/images/demo/destination-goa.webp') }}" alt="" fetchpriority="{{ $loop->first ? 'high' : 'low' }}" decoding="async">
                        @endif
                    </div>
                @empty
                    <div class="swiper-slide hero-carousel-slide"><img class="hero-media" src="{{ asset('assets/frontend/images/demo/destination-goa.webp') }}" alt="" fetchpriority="high" decoding="async"></div>
                @endforelse
            </div>
        </div>
        <div class="parallax-orbit parallax-orbit-one"></div>
        <div class="parallax-orbit parallax-orbit-two"></div>
        <div class="container">
            <div class="hero-content" data-animate="fade-up">
                <span class="hero-kicker"><i class="fa-solid fa-plane-departure"></i> Personalised holidays, thoughtfully planned</span>
                <h1 class="hero-title">Journeys designed around the way you want to travel.</h1>
                <p class="hero-text">From relaxed family escapes to milestone honeymoons and executive travel, UniWorld Holidays combines considered itineraries, carefully selected stays and responsive support.</p>
                <div class="hero-stats">
                    <div class="hero-stat"><strong>Tailored</strong><span>Itineraries built around you</span></div>
                    <div class="hero-stat"><strong>Clear</strong><span>Proposals and inclusions</span></div>
                    <div class="hero-stat"><strong>Supported</strong><span>From enquiry to return</span></div>
                </div>
                <div class="hero-actions d-flex flex-wrap gap-3">
                    <a class="btn-brand btn-accent" href="{{ route('frontend.domestic') }}"><i class="fa-solid fa-map-location-dot"></i> Explore Holidays</a>
                    <a class="btn-outline-brand" href="{{ route('frontend.contact') }}"><i class="fa-solid fa-headset"></i> Design My Journey</a>
                </div>
            </div>
        </div>
        <a class="hero-scroll-cue" href="#holiday-search" aria-label="Scroll to holiday search"><span>Scroll to explore</span><i class="fa-solid fa-arrow-down" aria-hidden="true"></i></a>
    </section>

    @include('frontend.components.search-form')

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Signature Destinations',
                'title' => 'Distinctive places, considered experiences',
                'text' => 'Explore destinations selected for their culture, scenery, hospitality and breadth of experiences.',
            ])
            <div class="destination-carousel swiper">
                <div class="swiper-wrapper">
                    @forelse($featuredDestinations ?? [] as $destination)
                        <div class="swiper-slide">
                            @include('frontend.components.destination-card', [
                                'image' => media_url($destination->hero_image, 'assets/frontend/images/demo/destination-goa.webp'),
                                'title' => $destination->name,
                                'location' => $destination->country ?? $destination->continent,
                                'duration' => ($destination->tours_count ?? 0) . ' Packages',
                                'description' => $destination->short_description ?? 'Discover ' . $destination->name,
                                'url' => route('frontend.destination.show', $destination->slug),
                            ])
                        </div>
                    @empty
                        <div class="swiper-slide">@include('frontend.components.destination-card', ['image' => 'assets/frontend/images/demo/destination-goa.webp', 'title' => 'Goa Coastal Escape', 'location' => 'India', 'duration' => '4 Days', 'description' => 'Beach stays, relaxed cafes, water sports, and sunset evenings.', 'url' => route('frontend.domestic')])</div>
                        <div class="swiper-slide">@include('frontend.components.destination-card', ['image' => 'assets/frontend/images/demo/destination-kashmir.webp', 'title' => 'Kashmir Valley Retreat', 'location' => 'India', 'duration' => '6 Days', 'description' => 'Houseboats, gardens, snow views, and elegant sightseeing.', 'url' => route('frontend.domestic')])</div>
                        <div class="swiper-slide">@include('frontend.components.destination-card', ['image' => 'assets/frontend/images/demo/destination-dubai.webp', 'title' => 'Dubai Luxury Break', 'location' => 'UAE', 'duration' => '5 Days', 'description' => 'Desert safari, Burj Khalifa, marina evenings.', 'url' => route('frontend.international')])</div>
                        <div class="swiper-slide">@include('frontend.components.destination-card', ['image' => 'assets/frontend/images/demo/destination-bali.webp', 'title' => 'Bali Honeymoon Mood', 'location' => 'Indonesia', 'duration' => '6 Days', 'description' => 'Private villas, temples, beaches, floating breakfast.', 'url' => route('frontend.international')])</div>
                    @endforelse
                </div>
                <div class="swiper-button-prev dest-swiper-prev"></div>
                <div class="swiper-button-next dest-swiper-next"></div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-soft">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-animate="fade-right">
                    <div class="about-media">
                        <img src="{{ asset('assets/frontend/images/demo/about-travel-consultation.png') }}" alt="UniWorld Holidays consultant planning a journey with travellers" loading="lazy" decoding="async" width="600" height="450">
                        <div class="experience-badge">
                            <strong>12+</strong>
                            <span>Years of travel craft</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-animate="fade-left">
                    <span class="section-kicker"><i class="fa-solid fa-circle-check"></i> The UniWorld approach</span>
                    <h2 class="section-title">Confident decisions at every stage of your journey.</h2>
                    <p class="section-text mb-4">We translate your priorities into a practical travel plan—matching the destination, route, stay category, experiences and pace to your party.</p>
                    <div class="row g-3 equal-card-grid equal-card-grid--2">
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-route', 'title' => 'Well-paced itineraries', 'description' => 'Meaningful sightseeing balanced with efficient transfers and time to enjoy each place.'])</div>
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-shield-heart', 'title' => 'Accountable support', 'description' => 'One informed team coordinating details before departure and throughout your holiday.'])</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Most requested journeys',
                'title' => 'Proven itineraries, personalised for you',
                'text' => 'Start with a thoughtfully structured holiday, then refine the hotels, experiences and pace to suit your plans.',
            ])
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($featuredTours ?? [] as $tour)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.package-card', [
                            'image' => media_url($tour->hero_image, 'assets/frontend/images/demo/destination-kashmir.webp'),
                            'title' => $tour->title,
                            'duration' => $tour->duration_nights . ' Nights / ' . $tour->duration_days . ' Days',
                            'type' => ucfirst($tour->category ?? 'Tour'),
                            'description' => $tour->subtitle ?? str($tour->overview ?? '')->stripTags()->limit(100),
                            'price' => $tour->starting_price ? 'INR ' . number_format($tour->starting_price) : 'On Request',
                            'url' => route('frontend.tour.show', $tour->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-kashmir.webp', 'title' => 'Kashmir Delight', 'duration' => '5 Nights / 6 Days', 'type' => 'Family', 'description' => 'Srinagar, Gulmarg, Pahalgam, houseboat stay, and scenic transfers.', 'price' => 'INR 24,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-dubai.webp', 'title' => 'Dubai Explorer', 'duration' => '4 Nights / 5 Days', 'type' => 'Group', 'description' => 'City tour, desert safari, dhow cruise, and Burj Khalifa experience.', 'price' => 'INR 49,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-bali.webp', 'title' => 'Romantic Bali', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Villa stay, island tours, beach clubs, and honeymoon inclusions.', 'price' => 'INR 64,999', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
        </div>
    </section>

    @include('frontend.components.cta')

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Services',
                'title' => 'One team for every travel detail',
                'text' => 'Coordinated holiday planning for independent travellers, families, groups and organisations.',
            ])
            <div class="row g-4 equal-card-grid equal-card-grid--4">
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-suitcase-rolling', 'title' => 'Tailor-made holidays', 'description' => 'Flexible India and international itineraries shaped around your interests and pace.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-hotel', 'title' => 'Curated stays', 'description' => 'Hotels and resorts shortlisted for location, comfort, service and value.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-passport', 'title' => 'Visa guidance', 'description' => 'Practical document checklists and application coordination for supported destinations.'])</div>
                <div class="col-lg-3 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-plane', 'title' => 'Flights and transfers', 'description' => 'Connections and ground transport aligned with your itinerary and arrival times.'])</div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-soft">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Traveller perspectives',
                'title' => 'The details our guests remember',
                'text' => 'Feedback on pacing, coordination and the experiences that made each journey personal.',
            ])
            <div class="testimonial-carousel swiper">
                <div class="swiper-wrapper">
                    @forelse($testimonials ?? [] as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="rating mb-3">{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</div>
                                <p class="text-muted">{{ $testimonial->content }}</p>
                                <div class="d-flex align-items-center gap-3 mt-4">
                                    <span class="testimonial-avatar d-inline-flex align-items-center justify-content-center">
                                        @if($testimonial->avatar)
                                            <img src="{{ media_url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="rounded-circle" style="width:40px;height:40px;object-fit:cover">
                                        @else
                                            <i class="fa-solid fa-user"></i>
                                        @endif
                                    </span>
                                    <div><strong>{{ $testimonial->name }}</strong><span class="d-block text-muted small">{{ $testimonial->location ?? ($testimonial->tour?->title ?? '') }}</span></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="rating mb-3">★★★★★</div>
                                <p class="text-muted">The Dubai plan was smooth from pickup to sightseeing. We had enough time for family activities.</p>
                                <div class="d-flex align-items-center gap-3 mt-4"><span class="testimonial-avatar d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-user"></i></span><div><strong>Mehta Family</strong><span class="d-block text-muted small">Dubai Explorer</span></div></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="rating mb-3">★★★★★</div>
                                <p class="text-muted">Our Kashmir trip felt beautifully paced. Hotels, car, and sightseeing were handled with attention.</p>
                                <div class="d-flex align-items-center gap-3 mt-4"><span class="testimonial-avatar d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-user"></i></span><div><strong>Shah Family</strong><span class="d-block text-muted small">Kashmir Retreat</span></div></div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination testimonial-pagination"></div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Travel intelligence',
                'title' => 'Practical guidance for better holidays',
                'text' => 'Destination insights, planning checklists and informed answers to common travel decisions.',
            ])
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($posts ?? [] as $post)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.blog-card', [
                            'image' => media_url($post->featured_image, 'assets/frontend/images/demo/destination-kashmir.webp'),
                            'title' => $post->title,
                            'date' => $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y'),
                            'category' => ucfirst($post->category ?? 'General'),
                            'description' => $post->excerpt ?? str($post->content)->stripTags()->limit(120),
                            'url' => route('frontend.blog.show', $post->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-kashmir.webp', 'title' => 'How to plan a family holiday without stress', 'date' => '08 Jun 2026', 'category' => 'Planning', 'description' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time.', 'url' => route('frontend.blog')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-dubai.webp', 'title' => 'Visa documents travellers should prepare early', 'date' => '08 Jun 2026', 'category' => 'Visa', 'description' => 'A practical checklist for smoother international trip preparation.', 'url' => route('frontend.blog')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.blog-card', ['image' => 'assets/frontend/images/demo/destination-maldives.webp', 'title' => 'Best honeymoon ideas for beach lovers', 'date' => '08 Jun 2026', 'category' => 'Honeymoon', 'description' => 'Beach destinations with privacy, romance, and memorable local experiences.', 'url' => route('frontend.blog')])</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
