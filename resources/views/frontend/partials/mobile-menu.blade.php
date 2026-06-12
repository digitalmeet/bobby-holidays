<div class="mobile-menu-backdrop"></div>
<aside class="mobile-menu" aria-label="Mobile navigation">
    <div class="mobile-menu-head">
        <a class="navbar-brand" href="{{ route('frontend.home') }}">
            <img class="brand-logo" src="{{ asset('assets/frontend/images/uniworld-logo-cropped.png') }}" alt="UniWorld Holidays">
        </a>
        <button class="mobile-menu-close" type="button" aria-label="Close mobile menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="mobile-service-grid">
        <a href="{{ route('frontend.domestic') }}"><i class="fa-solid fa-suitcase-rolling"></i><span>Holidays</span></a>
        <a href="{{ route('frontend.services') }}"><i class="fa-solid fa-money-bill-transfer"></i><span>Forex</span></a>
        <a href="{{ route('frontend.services') }}"><i class="fa-solid fa-plane"></i><span>Flights</span></a>
        <a href="{{ route('frontend.services') }}"><i class="fa-solid fa-hotel"></i><span>Hotels</span></a>
        <a href="{{ route('frontend.services') }}"><i class="fa-solid fa-ship"></i><span>Cruise</span></a>
        <a href="{{ route('frontend.services') }}"><i class="fa-solid fa-passport"></i><span>Visa</span></a>
    </div>

    <ul class="mobile-nav">
        <li><a href="{{ route('frontend.home') }}">Home <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.about') }}">About Us <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.domestic') }}">Domestic Packages <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.international') }}">International Packages <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.services') }}">Services <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.gallery') }}">Gallery <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.faq') }}">FAQ <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.blog') }}">Blog <i class="fa-solid fa-angle-right"></i></a></li>
        <li><a href="{{ route('frontend.contact') }}">Contact Us <i class="fa-solid fa-angle-right"></i></a></li>
    </ul>

    <div class="d-grid gap-2">
        <a class="btn-brand" href="tel:+919876543210"><i class="fa-solid fa-phone"></i> Call Now</a>
        <a class="btn-outline-brand" href="https://wa.me/919876543210"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
    </div>
</aside>
