@extends('frontend.layouts.app')

@section('title', 'Kashmir Delight Package - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Kashmir Delight'])

    <section class="section-padding package-detail-section">
        <div class="container">
            <div class="package-detail-hero" data-aos="fade-up">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-7">
                        <div class="package-detail-media">
                            <img src="{{ asset('assets/frontend/images/destination-kashmir.svg') }}" alt="Kashmir Delight package">
                            <div class="package-media-badge">
                                <i class="fa-solid fa-star"></i>
                                Best for families
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="package-summary-card">
                            <span class="section-kicker"><i class="fa-solid fa-mountain-sun"></i> Escorted Tour Package</span>
                            <h1>Kashmir Delight with Srinagar, Gulmarg, and Pahalgam</h1>
                            <p>Houseboat stay, valley drives, gardens, snow viewpoints, and private transfers planned at a comfortable pace.</p>

                            <div class="package-facts">
                                <span><i class="fa-solid fa-calendar-days"></i> 5 Nights / 6 Days</span>
                                <span><i class="fa-solid fa-location-dot"></i> Srinagar, Gulmarg, Pahalgam</span>
                                <span><i class="fa-solid fa-user-group"></i> Family / Couple</span>
                                <span><i class="fa-solid fa-car"></i> Private transfers</span>
                            </div>

                            <div class="package-price-box">
                                <div>
                                    <small>Starting from</small>
                                    <strong>INR 24,999</strong>
                                    <span>per person</span>
                                </div>
                                <a class="btn-brand btn-accent" href="{{ route('frontend.contact') }}"><i class="fa-solid fa-paper-plane"></i> Get Quote</a>
                            </div>

                            <div class="package-trust-row">
                                <span><i class="fa-solid fa-check"></i> Custom hotels</span>
                                <span><i class="fa-solid fa-check"></i> Easy EMI guidance</span>
                                <span><i class="fa-solid fa-check"></i> WhatsApp support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="package-content-grid">
                <div class="package-main-content">
                    <div class="package-nav-card">
                        <a href="#overview">Overview</a>
                        <a href="#itinerary">Itinerary</a>
                        <a href="#inclusions">Inclusions</a>
                        <a href="#policy">Policy</a>
                    </div>

                    <div id="overview" class="policy-card package-section-card">
                        <h2 class="h4 fw-bold mb-3">Package Overview</h2>
                        <p class="text-muted mb-0">This Kashmir package is designed for travellers who want scenic beauty without rushed travel days. The plan covers Srinagar, Gulmarg, and Pahalgam with comfortable transfers, curated stays, and enough leisure time to enjoy the destination.</p>
                    </div>

                    <div id="itinerary" class="itinerary-card package-section-card">
                        <h2 class="h4 fw-bold mb-3">Day-wise Itinerary</h2>
                        <ul class="timeline-list">
                            <li><span>1</span><div><strong>Arrival in Srinagar</strong><p class="text-muted mb-0">Airport pickup, hotel check-in, and relaxed evening by Dal Lake.</p></div></li>
                            <li><span>2</span><div><strong>Srinagar Sightseeing</strong><p class="text-muted mb-0">Mughal gardens, Shikara experience, and local market time.</p></div></li>
                            <li><span>3</span><div><strong>Gulmarg Excursion</strong><p class="text-muted mb-0">Scenic drive, snow activities by season, and optional gondola ticket.</p></div></li>
                            <li><span>4</span><div><strong>Pahalgam Valley</strong><p class="text-muted mb-0">Drive through saffron fields and enjoy valley viewpoints.</p></div></li>
                            <li><span>5</span><div><strong>Leisure and Houseboat</strong><p class="text-muted mb-0">Slow morning, optional shopping, and houseboat stay.</p></div></li>
                            <li><span>6</span><div><strong>Departure</strong><p class="text-muted mb-0">Breakfast, checkout, and airport transfer.</p></div></li>
                        </ul>
                    </div>

                    <div id="inclusions" class="policy-card package-section-card">
                        <h2 class="h4 fw-bold mb-3">Inclusions</h2>
                        <div class="inclusion-grid">
                            <span><i class="fa-solid fa-check"></i> Hotel accommodation</span>
                            <span><i class="fa-solid fa-check"></i> Daily breakfast</span>
                            <span><i class="fa-solid fa-check"></i> Airport transfers</span>
                            <span><i class="fa-solid fa-check"></i> Sightseeing vehicle</span>
                            <span><i class="fa-solid fa-check"></i> Houseboat experience</span>
                            <span><i class="fa-solid fa-check"></i> Travel assistance</span>
                        </div>
                    </div>

                    <div id="policy" class="policy-card package-section-card">
                        <h2 class="h4 fw-bold mb-3">Important Notes</h2>
                        <p class="text-muted mb-0">Final pricing depends on travel dates, hotel category, vehicle type, seasonal availability, and selected add-ons. Cancellation and change policies will be shared with the final quote.</p>
                    </div>
                </div>

                <aside class="package-side-content">
                    <div class="policy-card package-help-card">
                        <h2 class="h5 fw-bold">Need help choosing dates?</h2>
                        <p class="text-muted">Talk to our holiday expert for hotel upgrades, honeymoon inclusions, child-friendly plans, or group pricing.</p>
                        <a class="btn-brand w-100 mb-2" href="{{ route('frontend.contact') }}"><i class="fa-solid fa-headset"></i> Request Callback</a>
                        <a class="btn-outline-brand w-100" href="https://wa.me/919876543210"><i class="fa-brands fa-whatsapp"></i> WhatsApp Quote</a>
                    </div>

                    <div class="policy-card package-help-card">
                        <h2 class="h5 fw-bold">Popular add-ons</h2>
                        <ul class="package-addons">
                            <li>Gondola ticket assistance</li>
                            <li>Premium houseboat stay</li>
                            <li>Honeymoon room decor</li>
                            <li>Additional leisure day</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
