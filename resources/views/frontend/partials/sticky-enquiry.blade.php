@unless (request()->routeIs('frontend.home', 'frontend.contact'))
    <div class="sticky-enquiry-bar">
        <div class="container">
            <form class="sticky-enquiry-form needs-validation" id="stickyEnquiryForm" action="{{ route('frontend.contact.submit') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="source_page" value="{{ request()->path() }}">
                <div class="sticky-enquiry-title">
                    <span>Quick Enquiry</span>
                    <small>Get a callback in 30 minutes</small>
                </div>
                <div class="sticky-enquiry-fields">
                    <div class="sticky-enquiry-field"><label class="visually-hidden" for="sticky_enquiry_name">Name</label><input class="form-control" id="sticky_enquiry_name" name="name" type="text" placeholder="Name" autocomplete="name" maxlength="255" required><div class="invalid-feedback">Please enter your name.</div></div>
                    <div class="sticky-enquiry-field"><label class="visually-hidden" for="sticky_enquiry_phone">Phone number</label><input class="form-control" id="sticky_enquiry_phone" name="phone" type="tel" placeholder="Phone number" autocomplete="tel" minlength="10" maxlength="20" pattern="[0-9+\s\-]{10,20}" required><div class="invalid-feedback">Enter a valid phone number.</div></div>
                    <div class="sticky-enquiry-field"><label class="visually-hidden" for="sticky_enquiry_email">Email Address</label><input class="form-control" id="sticky_enquiry_email" name="email" type="email" placeholder="Email (optional)" autocomplete="email" maxlength="255"><div class="invalid-feedback">Enter a valid email address.</div></div>
                </div>
                <label class="sticky-enquiry-consent" for="sticky_enquiry_consent">
                    <input id="sticky_enquiry_consent" name="privacy_acceptance" type="checkbox" value="1" required>
                    <span>I accept the <a href="{{ route('frontend.privacy') }}">Privacy Policy</a></span>
                    <span class="invalid-feedback">Please accept the Privacy Policy.</span>
                </label>
                <button class="btn-brand btn-accent sticky-enquiry-submit" type="submit" id="stickySubmitBtn">
                    <i class="fa-solid fa-paper-plane"></i> Submit
                </button>
            </form>
            <div class="sticky-enquiry-success d-none" id="stickySuccess">
                <div class="d-flex align-items-center gap-2 text-success">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                    <span><strong>Thank you!</strong> We will call you shortly.</span>
                </div>
            </div>
        </div>
    </div>
@endunless

@push('scripts')
<script>
document.getElementById('stickyEnquiryForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const btn = document.getElementById('stickySubmitBtn');
    const successDiv = document.getElementById('stickySuccess');

    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(response => {
        if (response.ok) {
            form.classList.add('d-none');
            successDiv.classList.remove('d-none');
            setTimeout(() => {
                successDiv.classList.add('d-none');
                form.classList.remove('d-none');
                form.reset();
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit';
            }, 5000);
        } else return response.json().then(data => Promise.reject(data));
    })
    .catch((error) => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit';
        const message = error?.errors ? Object.values(error.errors).flat().join('\n') : 'We could not submit your enquiry. Please try again.';
        alert(message);
    });
});
</script>
@endpush
