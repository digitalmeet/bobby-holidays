@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Privacy Policy'])

    <section class="section-padding">
        <div class="container">
            <div class="policy-card">
                <h1 class="section-title">Privacy Policy</h1>
                <p class="text-muted">This static policy page is a placeholder for legal review. UniWorld Holidays may collect enquiry details such as name, phone, email, destination, travel dates, and preferences to respond to travel requests.</p>
                <h2 class="h4 fw-bold mt-4">Information Use</h2>
                <p class="text-muted">Information may be used to prepare quotes, coordinate bookings, provide support, and improve travel services.</p>
                <h2 class="h4 fw-bold mt-4">Data Sharing</h2>
                <p class="text-muted">Travel-related information may be shared with hotels, transport providers, visa partners, or service vendors only where required for trip planning.</p>
                <h2 class="h4 fw-bold mt-4">Contact</h2>
                <p class="text-muted mb-0">For privacy questions, contact hello@uniworldholidays.com.</p>
            </div>
        </div>
    </section>
@endsection
