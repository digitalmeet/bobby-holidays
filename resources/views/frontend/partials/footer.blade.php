<footer class="site-footer">
    <div class="container">
        <div class="row g-4 footer-main">
            <div class="col-lg-4 col-md-6 footer-brand-col">
                <a class="d-inline-block mb-3" href="{{ route('frontend.home') }}">
                    <img class="footer-logo" src="{{ asset('assets/frontend/images/uniworld-logo-cropped.png') }}" alt="UniWorld Holidays">
                </a>
                <p>UniWorld Holidays designs domestic and international vacations, group tours, honeymoon escapes, and business travel support with reliable planning from enquiry to return.</p>
                <div class="footer-social mt-3">
                    @if(setting('social_facebook'))<a href="{{ setting('social_facebook') }}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>@endif
                    @if(setting('social_instagram'))<a href="{{ setting('social_instagram') }}" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>@endif
                    @if(setting('social_youtube'))<a href="{{ setting('social_youtube') }}" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>@endif
                    @if(setting('social_linkedin'))<a href="{{ setting('social_linkedin') }}" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>@endif
                </div>
            </div>

            <div class="col-lg-2 col-md-6 footer-link-col">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.domestic') }}">Domestic Packages</a></li>
                    <li><a href="{{ route('frontend.international') }}">International Packages</a></li>
                    <li><a href="{{ route('frontend.services') }}">Services</a></li>
                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                    <li><a href="{{ route('frontend.blog') }}">Blog</a></li>
                    <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-link-col">
                <h3 class="footer-title">Destinations</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.destinations') }}">All Destinations</a></li>
                    <li><a href="{{ route('frontend.domestic') }}">Goa</a></li>
                    <li><a href="{{ route('frontend.domestic') }}">Kashmir</a></li>
                    <li><a href="{{ route('frontend.domestic') }}">Kerala</a></li>
                    <li><a href="{{ route('frontend.international') }}">Dubai</a></li>
                    <li><a href="{{ route('frontend.international') }}">Bali</a></li>
                    <li><a href="{{ route('frontend.international') }}">Singapore</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-link-col">
                <h3 class="footer-title">Services</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.services') }}">Holiday Packages</a></li>
                    <li><a href="{{ route('frontend.services') }}">Hotel Booking</a></li>
                    <li><a href="{{ route('frontend.services') }}">Flight Booking</a></li>
                    <li><a href="{{ route('frontend.services') }}">Visa Assistance</a></li>
                    <li><a href="{{ route('frontend.services') }}">Corporate Travel</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-contact-col">
                <h3 class="footer-title">Contact</h3>
                <ul class="footer-links">
                    <li><a href="tel:{{ setting('company_phone', '+91 98765 43210') }}">{{ setting('company_phone', '+91 98765 43210') }}</a></li>
                    <li><a href="mailto:{{ setting('company_email', 'hello@uniworldholidays.com') }}">{{ setting('company_email', 'hello@uniworldholidays.com') }}</a></li>
                    <li>{{ setting('company_city', 'Ahmedabad, Gujarat, India') }}</li>
                </ul>
                <form class="mt-3" action="{{ route('frontend.contact') }}" method="get">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email address" aria-label="Email address">
                        <button class="btn btn-brand" type="submit" aria-label="Subscribe"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
            <p class="mb-0">Copyright &copy; {{ date('Y') }} UniWorld Holidays. All rights reserved.</p>
            <div class="footer-legal d-flex gap-3">
                <a href="{{ route('frontend.privacy') }}">Privacy Policy</a>
                <a href="{{ route('frontend.terms') }}">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
