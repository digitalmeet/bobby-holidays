@unless (request()->routeIs('frontend.home'))
    <div class="sticky-enquiry-bar">
        <div class="container">
            <form class="sticky-enquiry-form" action="{{ route('frontend.contact') }}" method="get">
                <div class="sticky-enquiry-title">
                    <span>Escorted Tour Packages</span>
                    <small>Get a quick callback</small>
                </div>
                <div class="sticky-enquiry-fields">
                    <label class="visually-hidden" for="sticky_enquiry_name">Name</label>
                    <input class="form-control" id="sticky_enquiry_name" name="name" type="text" placeholder="Name">

                    <label class="visually-hidden" for="sticky_enquiry_email">Email Address</label>
                    <input class="form-control" id="sticky_enquiry_email" name="email" type="email" placeholder="Email Address">

                    <label class="visually-hidden" for="sticky_enquiry_phone">Phone number</label>
                    <input class="form-control" id="sticky_enquiry_phone" name="phone" type="tel" placeholder="Phone number">
                </div>
                <label class="sticky-enquiry-consent" for="sticky_enquiry_consent">
                    <input id="sticky_enquiry_consent" name="privacy_acceptance" type="checkbox" value="1" required>
                    <span>I accept the <a href="{{ route('frontend.privacy') }}">Privacy Policy</a> and authorise UniWorld Holidays to contact me with details.</span>
                </label>
                <button class="btn-brand btn-accent sticky-enquiry-submit" type="submit">
                    <i class="fa-solid fa-paper-plane"></i> Submit
                </button>
            </form>
        </div>
    </div>
@endunless
