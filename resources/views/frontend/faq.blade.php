@extends('frontend.layouts.app')

@section('title', 'FAQ - UniWorld Holidays')

@section('content')
    <div id="reading-progress"></div>

    {{-- Hero --}}
    <div class="cms-page-hero">
        <div class="container" style="position:relative;z-index:2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <span class="service-hero-breadcrumb" style="font-size:13px;">
                    <a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:rgba(255,255,255,0.9);">FAQ</span>
                </span>
            </nav>
            <div class="service-hero-icon">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <h1 class="fw-bold text-white mb-2" style="font-size:clamp(1.6rem,4vw,2.4rem);">Frequently Asked Questions</h1>
            <p style="color:rgba(255,255,255,0.75);max-width:520px;margin-bottom:0;">Find quick answers to common travel queries. Can't find what you need? Just ask us.</p>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    @if($faqs->count())
                        {{-- Search --}}
                        <div class="faq-search-wrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" class="faq-search-input" id="faq-search" placeholder="Search questions…" autocomplete="off">
                        </div>

                        {{-- Category Tabs --}}
                        <div class="faq-category-tabs" id="faq-tabs">
                            <button class="faq-tab-btn active" data-target="all">All</button>
                            @foreach($faqs as $category => $items)
                                <button class="faq-tab-btn" data-target="{{ Str::slug($category) }}">
                                    {{ ucwords(str_replace('_', ' ', $category)) }}
                                </button>
                            @endforeach
                        </div>

                        {{-- No results --}}
                        <div class="faq-no-results" id="faq-no-results">
                            <i class="fa-solid fa-face-sad-tear fa-2x mb-3" style="color:#cbd5e0;"></i>
                            <p class="mb-0">No questions match your search. <a href="{{ route('frontend.contact') }}" style="color:#064f68;">Ask us directly →</a></p>
                        </div>

                        {{-- FAQ Groups --}}
                        @foreach($faqs as $category => $items)
                            <div class="faq-category-section active" id="faq-section-{{ Str::slug($category) }}" data-category="{{ Str::slug($category) }}">
                                <div class="faq-category-title">
                                    {{ ucwords(str_replace('_', ' ', $category)) }}
                                </div>
                                @foreach($items as $faq)
                                    <div class="faq-item" data-question="{{ strtolower($faq->question) }}">
                                        <button class="faq-question" type="button">
                                            <span>{{ $faq->question }}</span>
                                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                                        </button>
                                        <div class="faq-answer">
                                            <div class="content-body" style="font-size:15px;">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-circle-question fa-3x mb-3" style="color:#cbd5e0;"></i>
                            <p class="text-muted">No FAQs available yet. Have a question? <a href="{{ route('frontend.contact') }}" style="color:#064f68;">Contact us</a>.</p>
                        </div>
                    @endif

                    {{-- Bottom CTA --}}
                    <div class="blog-cta-block mt-5">
                        <h5 class="text-white fw-bold mb-2">Didn't find your answer?</h5>
                        <p class="mb-4" style="color:rgba(255,255,255,0.75);">Our travel experts are happy to help with any question about your trip.</p>
                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                            <a href="{{ route('frontend.contact') }}" class="btn btn-light fw-bold px-4" style="border-radius:8px;color:#064f68;">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send a Message
                            </a>
                            <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}" target="_blank" class="btn fw-bold px-4" style="background:#25d366;color:#fff;border-radius:8px;">
                                <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp Us
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

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

    // Custom accordion
    document.querySelectorAll('.faq-question').forEach(function(q) {
        q.addEventListener('click', function() {
            const item = this.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            // Close all in same section
            item.closest('.faq-category-section').querySelectorAll('.faq-item.open').forEach(function(o) {
                o.classList.remove('open');
            });
            if (!isOpen) item.classList.add('open');
        });
    });

    // Category tabs
    const tabs = document.querySelectorAll('.faq-tab-btn');
    const sections = document.querySelectorAll('.faq-category-section');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const target = this.dataset.target;
            sections.forEach(function(s) {
                if (target === 'all' || s.dataset.category === target) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
            document.getElementById('faq-search').value = '';
        });
    });

    // Live search
    const searchInput = document.getElementById('faq-search');
    const noResults = document.getElementById('faq-no-results');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            // Show all sections when searching
            sections.forEach(function(s) { s.classList.add('active'); });
            tabs.forEach(function(t) { t.classList.remove('active'); });
            document.querySelector('[data-target="all"]').classList.add('active');

            let visible = 0;
            document.querySelectorAll('.faq-item').forEach(function(item) {
                const match = !q || item.dataset.question.includes(q);
                item.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            noResults.style.display = visible === 0 && q ? 'block' : 'none';
        });
    }
})();
</script>
@endpush
@endsection
