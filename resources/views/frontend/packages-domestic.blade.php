@extends('frontend.layouts.app')

@section('title', 'Tailor-Made India Holiday Packages | UniWorld Holidays')
@section('meta_description', 'Explore personalised India holiday packages for Kashmir, Goa, Kerala, Rajasthan and more, with curated stays, private transfers and flexible itineraries.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'India Holidays', 'subtitle' => 'Thoughtfully paced journeys across the country'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'Journeys across India',
                'title' => 'Remarkable landscapes, designed around you',
                'text' => 'Compare flexible itineraries spanning Himalayan valleys, coastal retreats, cultural capitals and restorative backwaters.',
            ])
            @include('frontend.components.filter-bar')
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @forelse($tours ?? [] as $tour)
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
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-goa.webp', 'title' => 'Goa Beach Break', 'duration' => '3 Nights / 4 Days', 'type' => 'Friends', 'description' => 'Beach stay, North Goa sightseeing, water sports, and leisure evenings.', 'price' => 'INR 15,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-kashmir.webp', 'title' => 'Kashmir Delight', 'duration' => '5 Nights / 6 Days', 'type' => 'Family', 'description' => 'Srinagar, Gulmarg, Pahalgam, houseboat stay, and valley views.', 'price' => 'INR 24,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/demo/destination-himachal.png', 'title' => 'Himachal Getaway', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Shimla, Manali, mountain roads, adventure activities, and cozy stays.', 'price' => 'INR 21,999', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
            @if(isset($tours) && $tours instanceof \Illuminate\Pagination\AbstractPaginator && $tours->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $tours->links() }}</div>
            @endif
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
