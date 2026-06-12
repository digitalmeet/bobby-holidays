@extends('frontend.layouts.app')

@section('title', 'Terms and Conditions - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Terms and Conditions'])

    <section class="section-padding">
        <div class="container">
            <div class="policy-card">
                <h1 class="section-title">Terms and Conditions</h1>
                <p class="text-muted">This static terms page is a placeholder for legal review. Package availability, pricing, inclusions, cancellation rules, and payment schedules may vary by destination and travel date.</p>
                <h2 class="h4 fw-bold mt-4">Quotes and Bookings</h2>
                <p class="text-muted">Quotes are subject to availability until payment confirmation. Final booking details should be verified before payment.</p>
                <h2 class="h4 fw-bold mt-4">Cancellations</h2>
                <p class="text-muted">Cancellation charges may apply based on airline, hotel, supplier, visa, and service rules.</p>
                <h2 class="h4 fw-bold mt-4">Traveller Responsibility</h2>
                <p class="text-muted mb-0">Travellers are responsible for valid documents, timely reporting, and following local rules at the destination.</p>
            </div>
        </div>
    </section>
@endsection
