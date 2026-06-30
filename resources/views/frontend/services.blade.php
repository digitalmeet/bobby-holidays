@extends('frontend.layouts.app')

@section('title', 'Our Services - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Our Services', 'subtitle' => 'Complete travel solutions under one roof'])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <p class="lead text-muted">From planning your itinerary to ensuring a smooth return, we handle every aspect of your journey with precision and care.</p>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $services = app(App\Http\Controllers\FrontendController::class)->getServicesData();
                @endphp
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width:56px;height:56px;">
                                        <i class="{{ $service['icon'] }} fa-lg text-primary"></i>
                                    </span>
                                </div>
                                <h3 class="h5 fw-bold mb-2">{{ $service['title'] }}</h3>
                                <p class="text-muted flex-grow-1">{{ $service['short'] }}</p>
                                <a href="{{ route('frontend.service.show', $service['slug']) }}" class="btn-outline-brand mt-3 align-self-start">
                                    Learn More <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.components.cta')
@endsection
