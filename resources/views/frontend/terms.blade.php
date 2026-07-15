@extends('frontend.layouts.app')

@section('title', 'Terms and Conditions - UniWorld Holidays')

@section('content')
    <div id="reading-progress"></div>

    <div class="cms-page-hero">
        <div class="container" style="position:relative;z-index:2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <span class="service-hero-breadcrumb" style="font-size:13px;">
                    <a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span style="color:rgba(255,255,255,0.9);">Terms & Conditions</span>
                </span>
            </nav>
            <div class="service-hero-icon"><i class="fa-solid fa-file-contract"></i></div>
            <h1 class="fw-bold text-white mb-2" style="font-size:clamp(1.6rem,4vw,2.4rem);">Terms & Conditions</h1>
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
                            <p>By using UniWorld Holidays services, you agree to the following terms. Please read them carefully before making an enquiry or booking.</p>

                            <h2 id="quotes-bookings">Quotes and Bookings</h2>
                            <p>Quotes are subject to availability until payment confirmation. Final booking details including pricing, inclusions, and itinerary should be verified before making any payment.</p>

                            <h2 id="payments">Payments</h2>
                            <p>A booking is confirmed only upon receipt of the agreed advance payment. Balance payments are due as per the schedule communicated at the time of booking.</p>

                            <h2 id="cancellations">Cancellations & Refunds</h2>
                            <p>Cancellation charges may apply based on airline, hotel, supplier, visa, and service rules. Refund timelines depend on the policies of the respective service providers.</p>

                            <h2 id="changes">Changes to Bookings</h2>
                            <p>Any changes to confirmed bookings (dates, hotels, itinerary) are subject to availability and may incur additional charges. Requests must be made in writing.</p>

                            <h2 id="traveller-responsibility">Traveller Responsibility</h2>
                            <p>Travellers are responsible for holding valid travel documents (passport, visa, permits), reporting on time, and following local laws and regulations at the destination.</p>

                            <h2 id="liability">Limitation of Liability</h2>
                            <p>UniWorld Holidays acts as an agent for hotels, airlines, and other service providers. We are not liable for delays, cancellations, or changes caused by third-party providers or force majeure events.</p>

                            <h2 id="contact">Contact</h2>
                            <p class="mb-0">For any queries regarding these terms, contact us at <a href="mailto:{{ setting('company_email', 'hello@uniworldholidays.com') }}">{{ setting('company_email', 'hello@uniworldholidays.com') }}</a>.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cms-toc-sidebar">
                        <div class="cms-toc-card">
                            <h6><i class="fa-solid fa-list me-2"></i>On this page</h6>
                            <ul class="cms-toc-list">
                                <li><a href="#quotes-bookings">Quotes & Bookings</a></li>
                                <li><a href="#payments">Payments</a></li>
                                <li><a href="#cancellations">Cancellations & Refunds</a></li>
                                <li><a href="#changes">Changes to Bookings</a></li>
                                <li><a href="#traveller-responsibility">Traveller Responsibility</a></li>
                                <li><a href="#liability">Limitation of Liability</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="card border-0 shadow-sm rounded-3 mt-4">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-phone fa-lg mb-3" style="color:#064f68;"></i>
                                <h6 class="fw-bold mb-1">Need Clarification?</h6>
                                <p class="text-muted small mb-3">Talk to our team before you book.</p>
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
