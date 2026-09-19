@extends('frontend.layouts.app')

@section('title', 'About UniWorld Holidays | Personalised Travel Planning')
@section('meta_description', 'Meet the UniWorld Holidays team and discover our approach to personalised itineraries, transparent proposals and dependable travel coordination.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'About UniWorld Holidays', 'subtitle' => 'Travel planning built on clarity, care and accountability'])

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-animate="fade-right">
                    <img class="rounded-3" src="{{ asset('assets/frontend/images/demo/about-travel-consultation.png') }}" alt="UniWorld Holidays consultant planning a journey with travellers" loading="lazy" decoding="async">
                </div>
                <div class="col-lg-6" data-animate="fade-left">
                    <span class="section-kicker"><i class="fa-solid fa-users"></i> Our approach</span>
                    <h2 class="section-title">Travel advice that begins with listening.</h2>
                    <p class="section-text mb-4">UniWorld Holidays plans journeys across India and selected international destinations for families, couples, groups and organisations. We begin with your priorities, explain the options clearly and coordinate the details through to your return.</p>
                    <div class="row g-3 equal-card-grid equal-card-grid--2">
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-earth-asia', 'title' => 'Destination-led advice', 'description' => 'Recommendations grounded in season, route, interests and practical travel time.'])</div>
                        <div class="col-sm-6">@include('frontend.components.service-card', ['icon' => 'fa-solid fa-handshake', 'title' => 'One accountable team', 'description' => 'Clear ownership from the first conversation through final trip coordination.'])</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
