@extends('frontend.layouts.app')

@section('title', 'About Us - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'About Us'])

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <img class="rounded-3" src="{{ asset('assets/frontend/images/about-agency.svg') }}" alt="About UniWorld Holidays">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="section-kicker"><i class="fa-solid fa-users"></i> Our Story</span>
                    <h2 class="section-title">A travel agency focused on trust, comfort, and clear planning.</h2>
                    <p class="section-text mb-4">UniWorld Holidays helps travellers explore India and the world with thoughtfully planned packages, transparent communication, and dependable travel assistance.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-earth-asia', 'title' => '100+ Destinations', 'description' => 'Domestic and international choices for every season.'])</div>
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-face-smile', 'title' => 'Happy Travellers', 'description' => 'Service-first planning for families, couples, and groups.'])</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
