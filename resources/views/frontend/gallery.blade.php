@extends('frontend.layouts.app')

@section('title', 'Travel Inspiration Gallery | UniWorld Holidays')
@section('meta_description', 'Browse travel inspiration from Kashmir, Goa, Dubai, Bali and island and mountain destinations planned by UniWorld Holidays.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Travel Inspiration', 'subtitle' => 'A visual introduction to journeys across India and beyond'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Places worth experiencing',
                'title' => 'A glimpse of the journeys we design',
                'text' => 'From mountain mornings and coastal evenings to cultural landmarks and private island stays.',
            ])
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-goa.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-goa.webp') }}" alt="Goa beach holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Goa Coastline</h2><p class="text-muted mb-0">Beach breaks and laid-back evenings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-kashmir.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-kashmir.webp') }}" alt="Kashmir mountain holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Kashmir Peaks</h2><p class="text-muted mb-0">Scenic valleys and snow views.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-dubai.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-dubai.webp') }}" alt="Dubai skyline holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Dubai Skyline</h2><p class="text-muted mb-0">Urban icons and desert evenings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-bali.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-bali.webp') }}" alt="Bali honeymoon holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Bali Romance</h2><p class="text-muted mb-0">Villas, temples, and slow mornings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-maldives.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-maldives.webp') }}" alt="Maldives island holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Island Leisure</h2><p class="text-muted mb-0">Warm sand, blue water, and easy plans.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/demo/destination-rajasthan.webp') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/demo/destination-rajasthan.webp') }}" alt="Rajasthan heritage holiday" loading="lazy" decoding="async">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Mountain Routes</h2><p class="text-muted mb-0">Quiet stays and scenic drives.</p></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
