@extends('frontend.layouts.app')

@section('title', 'Access Denied — UniWorld Holidays')

@section('content')
    <section class="section-padding" style="min-height:60vh;display:flex;align-items:center;">
        <div class="container text-center">
            <div style="font-size:120px;font-weight:800;color:#064f68;line-height:1;opacity:0.15;">403</div>
            <h1 class="fw-bold mb-3" style="color:#064f68;margin-top:-30px;">Access Denied</h1>
            <p class="text-muted mb-4 mx-auto" style="max-width:480px;">You don't have permission to access this page. If you believe this is an error, please contact our team.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('frontend.home') }}" class="btn-brand"><i class="fa-solid fa-house me-2"></i>Back to Home</a>
            </div>
        </div>
    </section>
@endsection
