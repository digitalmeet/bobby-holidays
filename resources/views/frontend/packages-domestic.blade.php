@extends('frontend.layouts.app')

@section('title', 'Domestic Packages - UniWorld Holidays')
@section('meta_description', 'Explore our curated domestic holiday packages across India — Kashmir, Goa, Kerala, Himachal and more.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Domestic Packages', 'subtitle' => 'Explore the beauty of India'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'India Tours',
                'title' => 'Domestic holidays for every mood',
                'text' => 'From hill stations to beaches, heritage walks to wildlife — find your perfect Indian getaway.',
            ])
            @include('frontend.components.filter-bar')
            <div class="row g-4">
                @forelse($tours ?? [] as $tour)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.package-card', [
                            'image' => $tour->hero_image ? asset('storage/' . $tour->hero_image) : asset('assets/frontend/images/destination-kashmir.svg'),
                            'title' => $tour->title,
                            'duration' => $tour->duration_nights . ' Nights / ' . $tour->duration_days . ' Days',
                            'type' => ucfirst($tour->category ?? 'Tour'),
                            'description' => $tour->subtitle ?? str($tour->overview ?? '')->stripTags()->limit(100),
                            'price' => $tour->starting_price ? 'INR ' . number_format($tour->starting_price) : 'On Request',
                            'url' => route('frontend.tour.show', $tour->slug),
                        ])
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-goa.svg', 'title' => 'Goa Beach Break', 'duration' => '3 Nights / 4 Days', 'type' => 'Friends', 'description' => 'Beach stay, North Goa sightseeing, water sports, and leisure evenings.', 'price' => 'INR 15,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-kashmir.svg', 'title' => 'Kashmir Delight', 'duration' => '5 Nights / 6 Days', 'type' => 'Family', 'description' => 'Srinagar, Gulmarg, Pahalgam, houseboat stay, and valley views.', 'price' => 'INR 24,999', 'url' => route('frontend.contact')])</div>
                    <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/page-banner.svg', 'title' => 'Himachal Getaway', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Shimla, Manali, mountain roads, adventure activities, and cozy stays.', 'price' => 'INR 21,999', 'url' => route('frontend.contact')])</div>
                @endforelse
            </div>
            @if(isset($tours) && $tours instanceof \Illuminate\Pagination\AbstractPaginator && $tours->hasPages())
                <div class="d-flex justify-content-center mt-5">{{ $tours->links() }}</div>
            @endif
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
