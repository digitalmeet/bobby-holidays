<div class="topbar">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <a href="tel:+919876543210"><i class="fa-solid fa-phone me-1"></i> +91 98765 43210</a>
            <a href="mailto:hello@uniworldholidays.com"><i class="fa-solid fa-envelope me-1"></i> hello@uniworldholidays.com</a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span><i class="fa-solid fa-location-dot me-1"></i> Ahmedabad, Gujarat</span>
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
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.domestic') ? 'active' : '' }}" href="{{ route('frontend.domestic') }}">Domestic Packages</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.international') ? 'active' : '' }}" href="{{ route('frontend.international') }}">International Packages</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.services') ? 'active' : '' }}" href="{{ route('frontend.services') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.blog') ? 'active' : '' }}" href="{{ route('frontend.blog') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">Contact Us</a></li>
            </ul>

            <div class="header-actions">
                <a class="header-call" href="tel:+919876543210" aria-label="Call UniWorld Holidays"><i class="fa-solid fa-phone"></i></a>
                <a class="header-whatsapp" href="https://wa.me/919876543210" aria-label="WhatsApp UniWorld Holidays"><i class="fa-brands fa-whatsapp"></i></a>
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
            <a class="service-nav-item active" href="{{ route('frontend.domestic') }}"><i class="fa-solid fa-suitcase-rolling"></i> Holidays</a>
            <a class="service-nav-item" href="{{ route('frontend.services') }}"><i class="fa-solid fa-plane"></i> Flights</a>
            <a class="service-nav-item" href="{{ route('frontend.services') }}"><i class="fa-solid fa-hotel"></i> Hotels</a>
            <a class="service-nav-item" href="{{ route('frontend.services') }}"><i class="fa-solid fa-ship"></i> Cruise</a>
            <a class="service-nav-item" href="{{ route('frontend.services') }}"><i class="fa-solid fa-passport"></i> Visa</a>
            <div class="dropdown service-nav-more">
                <button class="service-nav-item" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i> More <i class="fa-solid fa-chevron-down small"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('frontend.services') }}">Travel Insurance</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.services') }}">MICE / Corporate Travel</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.international') }}">Honeymoon Packages</a></li>
                    <li><a class="dropdown-item" href="{{ route('frontend.gallery') }}">Travel Gallery</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
