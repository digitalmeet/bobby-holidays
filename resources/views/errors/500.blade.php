@extends('frontend.layouts.app')

@section('title', 'Server Error — UniWorld Holidays')

@section('content')
    <section class="section-padding" style="min-height:60vh;display:flex;align-items:center;">
        <div class="container text-center">
            <div style="font-size:120px;font-weight:800;color:#064f68;line-height:1;opacity:0.15;">500</div>
            <h1 class="fw-bold mb-3" style="color:#064f68;margin-top:-30px;">Something Went Wrong</h1>
            <p class="text-muted mb-4 mx-auto" style="max-width:480px;">We're experiencing a temporary issue. Please try again in a moment or contact our team if the problem persists.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('frontend.home') }}" class="btn-brand"><i class="fa-solid fa-house me-2"></i>Back to Home</a>
                <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}" class="btn-outline-brand" target="_blank"><i class="fa-brands fa-whatsapp me-2"></i>WhatsApp Us</a>
            </div>
        </div>
    </section>
@endsection
