@extends('frontend.layouts.app')

@section('title', 'Gallery - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Gallery'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Travel Moments',
                'title' => 'A glimpse of holidays we love planning',
                'text' => 'Gallery cards are static now and ready for future albums, destination tags, and image upload management.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/destination-goa.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/destination-goa.svg') }}" alt="Goa beach holiday">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Goa Coastline</h2><p class="text-muted mb-0">Beach breaks and laid-back evenings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/destination-kashmir.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/destination-kashmir.svg') }}" alt="Kashmir mountain holiday">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Kashmir Peaks</h2><p class="text-muted mb-0">Scenic valleys and snow views.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/destination-dubai.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/destination-dubai.svg') }}" alt="Dubai skyline holiday">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Dubai Skyline</h2><p class="text-muted mb-0">Urban icons and desert evenings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/destination-bali.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/destination-bali.svg') }}" alt="Bali honeymoon holiday">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Bali Romance</h2><p class="text-muted mb-0">Villas, temples, and slow mornings.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/cta-beach.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/cta-beach.svg') }}" alt="Beach vacation">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Island Leisure</h2><p class="text-muted mb-0">Warm sand, blue water, and easy plans.</p></div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a class="gallery-card glightbox d-block" href="{{ asset('assets/frontend/images/page-banner.svg') }}" data-gallery="travel-gallery">
                        <img src="{{ asset('assets/frontend/images/page-banner.svg') }}" alt="Mountain vacation">
                        <div class="card-body-pad"><h2 class="h5 fw-bold mb-1">Mountain Routes</h2><p class="text-muted mb-0">Quiet stays and scenic drives.</p></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
