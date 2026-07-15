@extends('frontend.layouts.app')

@section('title', ($page->meta_title ?? $page->title) . ' — UniWorld Holidays')
@section('meta_description', $page->meta_description ?? '')
@section('og_image_meta')
@if($page->og_image)<meta property="og:image" content="{{ asset('storage/' . $page->og_image) }}">@endif
@endsection

@section('content')
    <div id="reading-progress"></div>

    {{-- Hero --}}
    <div class="cms-page-hero">
        <div class="container" style="position:relative;z-index:2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <span class="service-hero-breadcrumb" style="font-size:13px;">
                    <a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:rgba(255,255,255,0.9);">{{ $page->title }}</span>
                </span>
            </nav>
            <h1 class="fw-bold text-white mb-2" style="font-size:clamp(1.6rem,4vw,2.4rem);">{{ $page->title }}</h1>
            @if($page->updated_at)
                <div class="cms-last-updated" style="background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);">
                    <i class="fa-solid fa-clock"></i> Last updated {{ $page->updated_at->format('d M Y') }}
                </div>
            @endif
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="cms-content-card">
                        <div class="content-body" id="cms-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>

                {{-- TOC Sidebar --}}
                <div class="col-lg-4">
                    <div class="cms-toc-sidebar">
                        <div class="cms-toc-card" id="cms-toc" style="display:none;">
                            <h6><i class="fa-solid fa-list me-2"></i>On this page</h6>
                            <ul class="cms-toc-list" id="cms-toc-list"></ul>
                        </div>

                        {{-- CTA card --}}
                        <div class="card border-0 shadow-sm rounded-3 mt-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:rgba(6,79,104,0.08);">
                                        <i class="fa-solid fa-headset fa-lg" style="color:#064f68;"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold mb-1">Have a question?</h6>
                                <p class="text-muted small mb-3">Our team is happy to help with anything.</p>
                                <a href="{{ route('frontend.contact') }}" class="btn d-block fw-semibold text-white" style="background:#064f68;border-radius:8px;">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Contact Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('frontend.components.cta')

@push('scripts')
<script>
(function() {
    // Reading progress
    const bar = document.getElementById('reading-progress');
    if (bar) {
        window.addEventListener('scroll', function() {
            const d = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.width = (d > 0 ? (window.scrollY / d) * 100 : 0) + '%';
        }, { passive: true });
    }

    // Back to top
    const btn = document.querySelector('.go-top-btn');
    if (btn) {
        window.addEventListener('scroll', function() { btn.classList.toggle('is-visible', window.scrollY > 300); }, { passive: true });
        btn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }

    // Auto TOC
    const content = document.getElementById('cms-content');
    const tocList = document.getElementById('cms-toc-list');
    const tocCard = document.getElementById('cms-toc');
    if (content && tocList) {
        const headings = content.querySelectorAll('h2, h3');
        if (headings.length >= 2) {
            headings.forEach(function(h, i) {
                if (!h.id) h.id = 'section-' + i;
                const li = document.createElement('li');
                li.innerHTML = '<a href="#' + h.id + '">' + h.textContent + '</a>';
                if (h.tagName === 'H3') li.querySelector('a').style.paddingLeft = '22px';
                tocList.appendChild(li);
            });
            tocCard.style.display = 'block';

            // Active on scroll
            const links = tocList.querySelectorAll('a');
            window.addEventListener('scroll', function() {
                let current = '';
                headings.forEach(function(h) {
                    if (window.scrollY >= h.offsetTop - 180) current = h.id;
                });
                links.forEach(function(a) {
                    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
                });
            }, { passive: true });
        }
    }
})();
</script>
@endpush
@endsection
