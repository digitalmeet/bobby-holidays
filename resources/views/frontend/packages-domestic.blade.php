@extends('frontend.layouts.app')

@section('title', 'Domestic Packages - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Domestic Packages'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'India Tours',
                'title' => 'Domestic holidays for every mood',
                'text' => 'Static package cards now; ready for package categories, filters, and enquiry actions later.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-goa.svg', 'title' => 'Goa Beach Break', 'duration' => '3 Nights / 4 Days', 'type' => 'Friends', 'description' => 'Beach stay, North Goa sightseeing, water sports, and leisure evenings.', 'price' => 'INR 15,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/destination-kashmir.svg', 'title' => 'Kashmir Delight', 'duration' => '5 Nights / 6 Days', 'type' => 'Family', 'description' => 'Srinagar, Gulmarg, Pahalgam, houseboat stay, and valley views.', 'price' => 'INR 24,999', 'url' => route('frontend.package.show')])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.package-card', ['image' => 'assets/frontend/images/page-banner.svg', 'title' => 'Himachal Getaway', 'duration' => '5 Nights / 6 Days', 'type' => 'Couple', 'description' => 'Shimla, Manali, mountain roads, adventure activities, and cozy stays.', 'price' => 'INR 21,999', 'url' => route('frontend.package.show')])</div>
            </div>
        </div>
    </section>
@endsection
