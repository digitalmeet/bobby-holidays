@extends('frontend.layouts.app')

@section('title', 'Contact Us - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Contact Us', 'subtitle' => 'Get in touch with our travel experts'])

    <section class="section-padding">
        <div class="container">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation me-2"></i> Please fix the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="section-kicker"><i class="fa-solid fa-headset"></i> Contact</span>
                    <h2 class="section-title">Tell us where you want to go.</h2>
                    <p class="section-text mb-4">Fill the form and our travel experts will get back to you within 2 hours with a customised itinerary and quotation.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-solid fa-phone"></i></span>
                                <h3 class="h6 fw-bold">Call</h3>
                                <a href="tel:{{ setting('company_phone', '+91 98765 43210') }}">{{ setting('company_phone', '+91 98765 43210') }}</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-brands fa-whatsapp"></i></span>
                                <h3 class="h6 fw-bold">WhatsApp</h3>
                                <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}">Chat with us</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-solid fa-envelope"></i></span>
                                <h3 class="h6 fw-bold">Email</h3>
                                <a href="mailto:{{ setting('company_email', 'hello@uniworldholidays.com') }}">{{ setting('company_email', 'hello@uniworldholidays.com') }}</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-solid fa-location-dot"></i></span>
                                <h3 class="h6 fw-bold">Office</h3>
                                <span>{{ setting('company_city', 'Ahmedabad, Gujarat') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div id="formSuccess" class="alert alert-success d-none">
                        <i class="fa-solid fa-check-circle me-2"></i> <strong>Thank you!</strong> Your enquiry has been submitted. We will contact you shortly.
                    </div>
                    <form class="row g-3 needs-validation" id="contactForm" action="{{ route('frontend.contact.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Your name" value="{{ old('name') }}" required minlength="2">
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your phone" value="{{ old('phone') }}" required minlength="10" pattern="[0-9+\s\-]{10,20}">
                            <div class="invalid-feedback">Please enter a valid phone number (min 10 digits).</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your email" value="{{ old('email') }}">
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="travel_date">Travel Date</label>
                            <input class="form-control date-picker" id="travel_date" name="travel_date" type="text" placeholder="Select date" value="{{ old('travel_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="destination">Destination</label>
                            <input class="form-control" id="destination" name="destination" type="text" placeholder="Where to?" value="{{ old('destination', request('destination')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="adults">Adults</label>
                            <input class="form-control" id="adults" name="adults" type="number" min="1" max="50" value="{{ old('adults', 2) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="children">Children</label>
                            <input class="form-control" id="children" name="children" type="number" min="0" max="20" value="{{ old('children', 0) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="message">Message / Requirements</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Tell us about your trip — dates, preferences, budget, special requirements...">{{ old('message') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn-brand" type="submit" id="submitBtn">
                                <i class="fa-solid fa-paper-plane"></i> Send Enquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
(function() {
    const form = document.getElementById('contactForm');
    const btn = document.getElementById('submitBtn');
    const successDiv = document.getElementById('formSuccess');

    form.addEventListener('submit', function(e) {
        // Client-side validation
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Prevent double submit
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';

        // Submit via AJAX
        e.preventDefault();
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            return response.json().then(data => { throw data; });
        })
        .then(data => {
            form.classList.add('d-none');
            successDiv.classList.remove('d-none');
            window.scrollTo({ top: successDiv.offsetTop - 100, behavior: 'smooth' });
        })
        .catch(err => {
            // Show server validation errors
            if (err.errors) {
                let msg = Object.values(err.errors).flat().join('\n');
                alert(msg);
            } else {
                // Fallback: normal form submit
                form.submit();
            }
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Enquiry';
        });
    });
})();
</script>
@endpush
