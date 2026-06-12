<section class="lead-capture-section {{ $class ?? '' }}">
    <div class="container">
        <div class="lead-capture-card" data-aos="fade-up">
            <div class="lead-capture-copy">
                <span class="section-kicker"><i class="fa-solid fa-headset"></i> {{ $kicker ?? 'Free Travel Consultation' }}</span>
                <h2>{{ $title ?? 'Get a custom quote from our holiday expert' }}</h2>
                <p>{{ $text ?? 'Share your details and preferred destination. Our team will call back with the best itinerary, hotels, and price options.' }}</p>
            </div>
            <form class="lead-capture-form" action="{{ route('frontend.contact') }}" method="get">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="{{ $id ?? 'lead' }}_name">Name</label>
                        <input class="form-control" id="{{ $id ?? 'lead' }}_name" name="name" type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="{{ $id ?? 'lead' }}_email">Email</label>
                        <input class="form-control" id="{{ $id ?? 'lead' }}_email" name="email" type="email" placeholder="Email address">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="{{ $id ?? 'lead' }}_phone">Phone</label>
                        <input class="form-control" id="{{ $id ?? 'lead' }}_phone" name="phone" type="tel" placeholder="Phone number">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="{{ $id ?? 'lead' }}_destination">Destination</label>
                        <input class="form-control" id="{{ $id ?? 'lead' }}_destination" name="destination" type="text" value="{{ $destination ?? '' }}" placeholder="Where to?">
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="lead-benefits">
                                <span><i class="fa-solid fa-check"></i> No obligation quote</span>
                                <span><i class="fa-solid fa-check"></i> Best-fit hotels</span>
                                <span><i class="fa-solid fa-check"></i> WhatsApp support</span>
                            </div>
                            <button class="btn-brand btn-accent" type="submit"><i class="fa-solid fa-paper-plane"></i> Request Callback</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
