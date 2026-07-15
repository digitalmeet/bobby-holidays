@extends('frontend.layouts.app')

@section('title', 'Page Not Found — UniWorld Holidays')

@section('content')
    <section class="section-padding" style="min-height:60vh;display:flex;align-items:center;">
        <div class="container text-center">
            <div style="font-size:120px;font-weight:800;color:#064f68;line-height:1;opacity:0.15;">404</div>
            <h1 class="fw-bold mb-3" style="color:#064f68;margin-top:-30px;">Page Not Found</h1>
            <p class="text-muted mb-4 mx-auto" style="max-width:480px;">The page you're looking for doesn't exist or has been moved. Let us help you find your way.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('frontend.home') }}" class="btn-brand"><i class="fa-solid fa-house me-2"></i>Back to Home</a>
                <a href="{{ route('frontend.contact') }}" class="btn-outline-brand"><i class="fa-solid fa-headset me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>
@endsection
