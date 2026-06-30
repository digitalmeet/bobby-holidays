@extends('frontend.layouts.app')

@section('title', $service['title'] . ' - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => $service['title'], 'subtitle' => 'Our Services'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:rgba(6,79,104,0.08);">
                                    <i class="{{ $service['icon'] }} fa-lg" style="color:#064f68;"></i>
                                </span>
                                <div>
                                    <h2 class="h4 fw-bold mb-0" style="color:#064f68;">{{ $service['title'] }}</h2>
                                    <p class="text-muted mb-0 small">{{ $service['short'] }}</p>
                                </div>
                            </div>
                            <div class="content-body">
                                {!! $service['content'] !!}
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 mt-4" style="background:linear-gradient(135deg, #064f68 0%, #0a7a9e 100%);">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="text-white mb-1">Ready to get started?</h5>
                                    <p class="text-white-50 mb-0">Share your requirements and our team will prepare a personalised plan.</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <a href="{{ route('frontend.contact') }}" class="btn btn-light fw-semibold px-4"><i class="fa-solid fa-paper-plane me-1"></i> Enquire Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-header border-0 py-3 px-4" style="background:#064f68;">
                                <h6 class="mb-0 text-white fw-semibold"><i class="fa-solid fa-list me-2"></i>All Services</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($services as $s)
                                    @php $isActive = ($s['slug'] === $service['slug']); @endphp
                                    <a href="{{ route('frontend.service.show', $s['slug']) }}"
                                       class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 px-4 {{ $isActive ? 'fw-bold' : '' }}"
                                       @if($isActive) style="background:rgba(6,79,104,0.06);border-left:3px solid #064f68;color:#064f68;" @endif>
                                        <i class="{{ $s['icon'] }} fa-fw {{ $isActive ? '' : 'text-muted' }}" @if($isActive) style="color:#064f68;" @endif></i>
                                        {{ $s['title'] }}
                                        @if($isActive)
                                            <i class="fa-solid fa-chevron-right ms-auto small" style="color:#064f68;"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-3 mt-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(6,79,104,0.08);">
                                        <i class="fa-solid fa-headset fa-lg" style="color:#064f68;"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold">Speak to an Expert</h6>
                                <p class="text-muted small mb-3">Available Mon-Sat, 9AM-7PM</p>
                                <a href="tel:{{ setting('company_phone', '+91 98765 43210') }}" class="btn d-block mb-2 fw-semibold text-white" style="background:#064f68;">
                                    <i class="fa-solid fa-phone me-1"></i> {{ setting('company_phone', '+91 98765 43210') }}
                                </a>
                                <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}" class="btn btn-outline-success d-block fw-semibold" target="_blank">
                                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
