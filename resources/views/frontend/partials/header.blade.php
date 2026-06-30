<div class="topbar">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <a href="tel:{{ setting('company_phone', '+91 98765 43210') }}"><i class="fa-solid fa-phone me-1"></i> {{ setting('company_phone', '+91 98765 43210') }}</a>
            <a href="mailto:{{ setting('company_email', 'hello@uniworldholidays.com') }}"><i class="fa-solid fa-envelope me-1"></i> {{ setting('company_email', 'hello@uniworldholidays.com') }}</a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span><i class="fa-solid fa-location-dot me-1"></i> {{ setting('company_city', 'Ahmedabad, Gujarat') }}</span>
            <a href="{{ route('frontend.contact') }}">Plan a Trip</a>
        </div>
    </div>
</div>

<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frontend.home') }}" aria-label="UniWorld Holidays home">
                <img class="brand-logo" src="{{ asset('assets/frontend/images/uniworld-logo-cropped.png') }}" alt="UniWorld Holidays">
            </a>

            <ul class="navbar-nav main-nav ms-auto me-3">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.home') ? 'active' : '' }}" href="{{ route('frontend.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.destinations*') ? 'active' : '' }}" href="{{ route('frontend.destinations') }}">Destinations</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.domestic') ? 'active' : '' }}" href="{{ route('frontend.domestic') }}">Domestic</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.international') ? 'active' : '' }}" href="{{ route('frontend.international') }}">International</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.blog*') ? 'active' : '' }}" href="{{ route('frontend.blog') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">Contact</a></li>
            </ul>

            <div class="header-actions">
                <a class="header-call" href="tel:{{ setting('company_phone', '+91 98765 43210') }}" aria-label="Call UniWorld Holidays"><i class="fa-solid fa-phone"></i></a>
                <a class="header-whatsapp" href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}" aria-label="WhatsApp UniWorld Holidays"><i class="fa-brands fa-whatsapp"></i></a>
                <a class="btn-brand d-none d-xl-inline-flex" href="{{ route('frontend.contact') }}"><i class="fa-solid fa-paper-plane"></i> Enquire Now</a>
                <button class="mobile-menu-toggle d-lg-none" type="button" aria-label="Open mobile menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>
</header>

<div class="service-nav-strip">
    <div class="container">
        <div class="service-nav-inner">
            <a class="service-nav-item {{ request()->routeIs('frontend.domestic') || request()->routeIs('frontend.international') || request()->routeIs('frontend.tour.show') ? 'active' : '' }}" href="{{ route('frontend.domestic') }}"><i class="fa-solid fa-suitcase-rolling"></i> Holidays</a>
            <a class="service-nav-item {{ request()->is('services/flights') ? 'active' : '' }}" href="{{ route('frontend.service.show', 'flights') }}"><i class="fa-solid fa-plane"></i> Flights</a>
            <a class="service-nav-item {{ request()->is('services/hotel-booking') ? 'active' : '' }}" href="{{ route('frontend.service.show', 'hotel-booking') }}"><i class="fa-solid fa-hotel"></i> Hotels</a>
            <a class="service-nav-item {{ request()->is('services/cruise') ? 'active' : '' }}" href="{{ route('frontend.service.show', 'cruise') }}"><i class="fa-solid fa-ship"></i> Cruise</a>
            <a class="service-nav-item {{ request()->is('services/visa-assistance') ? 'active' : '' }}" href="{{ route('frontend.service.show', 'visa-assistance') }}"><i class="fa-solid fa-passport"></i> Visa</a>
            <div class="dropdown service-nav-more">
                <button class="service-nav-item {{ request()->is('services/travel-insurance') || request()->is('services/corporate-travel') ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i> More <i class="fa-solid fa-chevron-down small"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('frontend.service.show', 'travel-insurance') }}">Travel Insurance</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.service.show', 'corporate-travel') }}">Corporate & MICE</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.international') }}">Honeymoon Packages</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.destinations') }}">All Destinations</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
