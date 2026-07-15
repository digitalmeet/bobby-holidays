@extends('frontend.layouts.app')

@section('title', $service->title . ' - UniWorld Holidays')
@section('meta_description', $service->short_description ?? '')

@section('content')
    <div id="reading-progress"></div>

    {{-- Service Hero --}}
    <div class="service-hero">
        <div class="container" style="position:relative;z-index:2;">
            <nav aria-label="breadcrumb" class="mb-4">
                <span class="service-hero-breadcrumb" style="font-size:13px;">
                    <a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <a href="{{ route('frontend.services') }}">Services</a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:rgba(255,255,255,0.9);">{{ $service->title }}</span>
                </span>
            </nav>
            <div class="service-hero-icon">
                <i class="{{ $service->icon ?? 'fa-solid fa-star' }}"></i>
            </div>
            <h1 class="fw-bold text-white mb-2" style="font-size:clamp(1.6rem,4vw,2.4rem);">{{ $service->title }}</h1>
            @if($service->short_description)
                <p style="color:rgba(255,255,255,0.75);max-width:560px;font-size:16px;margin-bottom:0;">{{ $service->short_description }}</p>
            @endif
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="cms-content-card mb-4">
                        <div class="content-body">
                            {!! $service->content !!}
                        </div>
                    </div>

                    {{-- CTA Banner --}}
                    <div class="blog-cta-block">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-start text-center mb-3 mb-md-0">
                                <h5 class="text-white fw-bold mb-1">Ready to get started?</h5>
                                <p style="color:rgba(255,255,255,0.75);margin-bottom:0;">Share your requirements and our team will prepare a personalised plan.</p>
                            </div>
                            <div class="col-md-4 text-md-end text-center">
                                <a href="{{ route('frontend.contact') }}" class="btn btn-light fw-bold px-4" style="border-radius:8px;color:#064f68;">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Enquire Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sticky-top" style="top:120px;">

                        {{-- Why Choose Us --}}
                        <div class="service-trust-block mb-4">
                            <div class="fw-bold mb-3" style="color:#064f68;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">Why UniWorld Holidays</div>
                            <div class="service-trust-item">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Trusted by 5,000+ travellers</span>
                            </div>
                            <div class="service-trust-item">
                                <i class="fa-solid fa-headset"></i>
                                <span>Dedicated support Mon–Sat, 9AM–7PM</span>
                            </div>
                            <div class="service-trust-item">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <span>Transparent pricing, no hidden fees</span>
                            </div>
                            <div class="service-trust-item">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Flexible change & cancellation help</span>
                            </div>
                        </div>

                        {{-- All Services --}}
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                            <div class="card-header border-0 py-3 px-4" style="background:#064f68;">
                                <h6 class="mb-0 text-white fw-semibold"><i class="fa-solid fa-list me-2"></i>All Services</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($services as $s)
                                    @php $isActive = ($s->slug === $service->slug); @endphp
                                    <a href="{{ route('frontend.service.show', $s->slug) }}"
                                       class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 px-4 {{ $isActive ? 'fw-bold' : '' }}"
                                       @if($isActive) style="background:rgba(6,79,104,0.06);border-left:3px solid #064f68;color:#064f68;" @endif>
                                        <i class="{{ $s->icon ?? 'fa-solid fa-circle' }} fa-fw {{ $isActive ? '' : 'text-muted' }}" @if($isActive) style="color:#064f68;" @endif></i>
                                        {{ $s->title }}
                                        @if($isActive)
                                            <i class="fa-solid fa-chevron-right ms-auto small" style="color:#064f68;"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Speak to Expert --}}
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(6,79,104,0.08);">
                                        <i class="fa-solid fa-headset fa-lg" style="color:#064f68;"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold">Speak to an Expert</h6>
                                <p class="text-muted small mb-3">Available Mon–Sat, 9AM–7PM</p>
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

@push('scripts')
<script>
(function() {
    const bar = document.getElementById('reading-progress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (docHeight > 0 ? (scrollTop / docHeight) * 100 : 0) + '%';
    }, { passive: true });
    const btn = document.querySelector('.go-top-btn');
    if (btn) {
        window.addEventListener('scroll', function() { btn.classList.toggle('is-visible', window.scrollY > 300); }, { passive: true });
        btn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }
})();
</script>
@endpush
@endsection
