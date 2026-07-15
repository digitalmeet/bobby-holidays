@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - UniWorld Holidays')

@section('content')
    <div id="reading-progress"></div>

    <div class="cms-page-hero">
        <div class="container" style="position:relative;z-index:2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <span class="service-hero-breadcrumb" style="font-size:13px;">
                    <a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:rgba(255,255,255,0.9);">Privacy Policy</span>
                </span>
            </nav>
            <div class="service-hero-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <h1 class="fw-bold text-white mb-2" style="font-size:clamp(1.6rem,4vw,2.4rem);">Privacy Policy</h1>
            <div class="cms-last-updated" style="background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);">
                <i class="fa-solid fa-clock"></i> Last updated July 2026
            </div>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="cms-content-card">
                        <div class="content-body">
                            <p>This policy explains how UniWorld Holidays collects, uses, and protects information you share when making travel enquiries or bookings.</p>

                            <h2 id="information-collected">Information We Collect</h2>
                            <p>We may collect enquiry details such as name, phone, email, destination, travel dates, and preferences to respond to travel requests and prepare personalised itineraries.</p>

                            <h2 id="information-use">How We Use Your Information</h2>
                            <p>Information may be used to prepare quotes, coordinate bookings, provide customer support, send relevant travel updates, and improve our services.</p>

                            <h2 id="data-sharing">Data Sharing</h2>
                            <p>Travel-related information may be shared with hotels, transport providers, visa partners, or service vendors only where required for trip planning. We do not sell your data to third parties.</p>

                            <h2 id="data-security">Data Security</h2>
                            <p>We take reasonable steps to protect your information from unauthorised access, disclosure, or misuse. Our systems use industry-standard security practices.</p>

                            <h2 id="your-rights">Your Rights</h2>
                            <p>You may request access to, correction of, or deletion of your personal data at any time by contacting us directly.</p>

                            <h2 id="contact">Contact Us</h2>
                            <p class="mb-0">For privacy questions or data requests, contact us at <a href="mailto:{{ setting('company_email', 'hello@uniworldholidays.com') }}">{{ setting('company_email', 'hello@uniworldholidays.com') }}</a>.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cms-toc-sidebar">
                        <div class="cms-toc-card">
                            <h6><i class="fa-solid fa-list me-2"></i>On this page</h6>
                            <ul class="cms-toc-list">
                                <li><a href="#information-collected">Information We Collect</a></li>
                                <li><a href="#information-use">How We Use It</a></li>
                                <li><a href="#data-sharing">Data Sharing</a></li>
                                <li><a href="#data-security">Data Security</a></li>
                                <li><a href="#your-rights">Your Rights</a></li>
                                <li><a href="#contact">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="card border-0 shadow-sm rounded-3 mt-4">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-envelope fa-lg mb-3" style="color:#064f68;"></i>
                                <h6 class="fw-bold mb-1">Privacy Questions?</h6>
                                <p class="text-muted small mb-3">We're happy to clarify anything.</p>
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

@push('scripts')
<script>
(function() {
    const bar = document.getElementById('reading-progress');
    if (bar) {
        window.addEventListener('scroll', function() {
            const d = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.width = (d > 0 ? (window.scrollY / d) * 100 : 0) + '%';
        }, { passive: true });
    }
    const btn = document.querySelector('.go-top-btn');
    if (btn) {
        window.addEventListener('scroll', function() { btn.classList.toggle('is-visible', window.scrollY > 300); }, { passive: true });
        btn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }
    // Active TOC link
    const links = document.querySelectorAll('.cms-toc-list a');
    window.addEventListener('scroll', function() {
        let current = '';
        document.querySelectorAll('.content-body h2[id]').forEach(function(h) {
            if (window.scrollY >= h.offsetTop - 180) current = h.id;
        });
        links.forEach(function(a) {
            a.classList.toggle('active', a.getAttribute('href') === '#' + current);
        });
    }, { passive: true });
})();
</script>
@endpush
@endsection
