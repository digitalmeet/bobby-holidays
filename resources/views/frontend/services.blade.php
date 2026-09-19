@extends('frontend.layouts.app')

@section('title', 'Travel Planning Services | UniWorld Holidays')
@section('meta_description', 'Explore personalised holiday planning, hotel selection, flights, transfers, visa guidance and corporate travel coordination from UniWorld Holidays.')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Travel Services', 'subtitle' => 'Connected planning for every stage of your journey'])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <p class="lead text-muted">Choose individual services or let one consultant coordinate the complete journey—from route design and reservations to documentation guidance and on-trip support.</p>
                </div>
            </div>
            <div class="row g-4 equal-card-grid equal-card-grid--3">
                @php
                    $services = $services ?? collect();
                @endphp
                @foreach($services as $s)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width:56px;height:56px;">
                                        <i class="{{ $s->icon }} fa-lg text-primary"></i>
                                    </span>
                                </div>
                                <h3 class="h5 fw-bold mb-2">{{ $s->title }}</h3>
                                <p class="text-muted flex-grow-1">{{ $s->short_description }}</p>
                                <a href="{{ route('frontend.service.show', $s->slug) }}" class="btn-outline-brand mt-3 align-self-start">
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
