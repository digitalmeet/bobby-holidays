@extends('frontend.layouts.app')

@section('title', 'How to Plan a Family Holiday - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Family Holiday Planning'])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <img class="rounded-3 mb-4" src="{{ asset('assets/frontend/images/blog-family-trip.svg') }}" alt="Family holiday planning">
                    <div class="blog-meta mb-3">
                        <span><i class="fa-solid fa-calendar"></i> 08 Jun 2026</span>
                        <span><i class="fa-solid fa-tag"></i> Planning</span>
                    </div>
                    <h1 class="section-title">How to plan a family holiday without stress</h1>
                    <p class="lead text-muted">A family trip works best when the plan respects energy levels, food comfort, transfer time, and enough open space between sightseeing blocks.</p>
                    <div class="policy-card mt-4">
                        <h2 class="h4 fw-bold">Start with the right pace</h2>
                        <p class="text-muted">Avoid packing too many attractions into one day. Keep one major sightseeing experience, one flexible meal break, and one relaxed evening slot.</p>
                        <h2 class="h4 fw-bold mt-4">Choose hotels by convenience</h2>
                        <p class="text-muted">A slightly better location can save hours in transfers, especially with children or senior travellers.</p>
                        <h2 class="h4 fw-bold mt-4">Keep documents together</h2>
                        <p class="text-muted mb-0">Passports, IDs, insurance, tickets, hotel vouchers, and emergency contacts should be available offline as well as online.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
