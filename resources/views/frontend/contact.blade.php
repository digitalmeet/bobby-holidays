@extends('frontend.layouts.app')

@section('title', 'Contact Us - UniWorld Holidays')

@section('content')
    @include('frontend.components.page-banner', ['title' => 'Contact Us'])

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="section-kicker"><i class="fa-solid fa-headset"></i> Contact</span>
                    <h2 class="section-title">Tell us where you want to go.</h2>
                    <p class="section-text mb-4">This form is static for now. It is structured so a future controller can validate and store enquiries without changing the UI.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-solid fa-phone"></i></span>
                                <h3 class="h6 fw-bold">Call</h3>
                                <a href="tel:+919876543210">+91 98765 43210</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <span class="icon-box"><i class="fa-brands fa-whatsapp"></i></span>
                                <h3 class="h6 fw-bold">WhatsApp</h3>
                                <a href="https://wa.me/919876543210">Chat with us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <form class="row g-3" action="{{ route('frontend.contact') }}" method="get">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Your name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="date">Travel Date</label>
                            <input class="form-control date-picker" id="date" name="date" type="text" placeholder="Select date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="package_type">Package Type</label>
                            <select class="form-select destination-select" id="package_type" name="package_type">
                                <option>Domestic Package</option>
                                <option>International Package</option>
                                <option>Honeymoon Package</option>
                                <option>Corporate Travel</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="destination_contact">Destination</label>
                            <input class="form-control" id="destination_contact" name="destination" type="text" placeholder="Preferred destination">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Share trip details"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn-brand" type="submit"><i class="fa-solid fa-paper-plane"></i> Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
