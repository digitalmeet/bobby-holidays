@extends('frontend.layouts.app')

@section('title', 'International Holiday Packages from India | UniWorld Holidays')
@section('meta_description', 'Discover personalised international holidays to Dubai, Bali, Singapore, Thailand, the Maldives and more, with coordinated stays, transfers and visa guidance.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'International Holidays', 'subtitle' => 'Well-coordinated journeys beyond India'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Journeys beyond India',
                'title' => 'International travel, coordinated with clarity',
                'text' => 'Bring flights, stays, transfers, experiences and destination guidance together in one considered plan.',
            ])
            @include('frontend.components.filter-bar')
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($tours ?? [] as $tour)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.package-card', [
                            'image' => media_url($tour->hero_image, 'assets/frontend/images/demo/destination-dubai.webp'),
                            'title' => $tour->title,
                            'duration' => $tour->duration_nights . ' Nights / ' . $tour->duration_days . ' Days',
                            'type' => ucfirst($tour->category ?? 'Tour'),
                            'description' => $tour->subtitle ?? str($tour->overview ?? '')->stripTags()->limit(100),
                            'price' => $tour->starting_price ? 'INR ' . number_format($tour->starting_price) : 'On Request',
                            'url' => route('frontend.tour.show', $tour->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-dubai.webp', 'title' => 'Dubai Explorer', 'duration' => '4 Nights / 5 Days', 'type' => 'Group', 'description' => 'City tour, dhow cruise, desert safari, and Burj Khalifa ticket.', 'price' => 'INR 49,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-bali.webp', 'title' => 'Bali Honeymoon', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Villa stay, temple tours, beaches, and romantic experiences.', 'price' => 'INR 64,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-singapore.png', 'title' => 'Singapore Family Fun', 'duration' => '4 Nights / 5 Days', 'type' => 'Family', 'description' => 'Sentosa, Universal Studios, city tour, and family-friendly hotels.', 'price' => 'INR 59,999', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
            @if(isset($tours) && $tours instanceof \Illuminate\Pagination\AbstractPaginator && $tours->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $tours->links() }}</div>
            @endif
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
