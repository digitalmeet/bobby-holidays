@extends('frontend.layouts.app')

@section('title', 'Services - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Services'])

    <section class="section-padding">
        <div class="container">
            @include('frontend.components.section-heading', [
                'kicker' => 'What We Do',
                'title' => 'Travel services under one roof',
                'text' => 'These service blocks can become database-managed service pages or CMS sections later.',
            ])
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-suitcase-rolling', 'title' => 'Holiday Packages', 'description' => 'Custom domestic and international tour packages for every traveller.'])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Booking', 'description' => 'Curated hotel options based on budget, location, and comfort preferences.'])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-plane-departure', 'title' => 'Flight Booking', 'description' => 'Flight support aligned with package timing and traveller convenience.'])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-passport', 'title' => 'Visa Assistance', 'description' => 'Guidance for documents, appointments, forms, and follow-ups.'])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-briefcase', 'title' => 'Corporate Travel', 'description' => 'Efficient planning for meetings, incentives, and business travel.'])</div>
                <div class="col-lg-4 col-md-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-car-side', 'title' => 'Transfers', 'description' => 'Airport pickup, local transfers, and sightseeing transport support.'])</div>
            </div>
        </div>
    </section>
@endsection
