@extends('frontend.layouts.app')

@section('title', 'International Packages - UniWorld Holidays')
@section('meta_description', 'Explore international holiday packages — Dubai, Bali, Singapore, Europe, Thailand and more.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'International Packages', 'subtitle' => 'Explore the world with us'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'World Tours',
                'title' => 'International packages made simple',
                'text' => 'Visa assistance, flights, hotels, and sightseeing — all planned for you.',
            ])
            @include('frontend.components.filter-bar')
            <div class="row g-4">
                @forelse($tours ?? [] as $tour)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.package-card', [
                            'image' => $tour->hero_image ? asset('storage/' . $tour->hero_image) : asset('assets/frontend/images/destination-dubai.svg'),
                            'title' => $tour->title,
                            'duration' => $tour->duration_nights . ' Nights / ' . $tour->duration_days . ' Days',
                            'type' => ucfirst($tour->category ?? 'Tour'),
                            'description' => $tour->subtitle ?? str($tour->overview ?? '')->stripTags()->limit(100),
                            'price' => $tour->starting_price ? 'INR ' . number_format($tour->starting_price) : 'On Request',
                            'url' => route('frontend.tour.show', $tour->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-dubai.svg', 'title' => 'Dubai Explorer', 'duration' => '4 Nights / 5 Days', 'type' => 'Group', 'description' => 'City tour, dhow cruise, desert safari, and Burj Khalifa ticket.', 'price' => 'INR 49,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-bali.svg', 'title' => 'Bali Honeymoon', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Villa stay, temple tours, beaches, and romantic experiences.', 'price' => 'INR 64,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/blog-passport.svg', 'title' => 'Singapore Family Fun', 'duration' => '4 Nights / 5 Days', 'type' => 'Family', 'description' => 'Sentosa, Universal Studios, city tour, and family-friendly hotels.', 'price' => 'INR 59,999', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
            @if(isset($tours) && $tours instanceof \Illuminate\Pagination\AbstractPaginator && $tours->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $tours->links() }}</div>
            @endif
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
