@unless (request()->routeIs('frontend.home'))
    <div class="sticky-enquiry-bar">
        <div class="container">
            <form class="sticky-enquiry-form" id="stickyEnquiryForm" action="{{ route('frontend.contact.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="source_page" value="{{ request()->path() }}">
                <div class="sticky-enquiry-title">
                    <span>Quick Enquiry</span>
                    <small>Get a callback in 30 minutes</small>
                </div>
                <div class="sticky-enquiry-fields">
                    <label class="visually-hidden" for="sticky_enquiry_name">Name</label>
                    <input class="form-control" id="sticky_enquiry_name" name="name" type="text" placeholder="Name" required>

                    <label class="visually-hidden" for="sticky_enquiry_phone">Phone number</label>
                    <input class="form-control" id="sticky_enquiry_phone" name="phone" type="tel" placeholder="Phone number" required>

                    <label class="visually-hidden" for="sticky_enquiry_email">Email Address</label>
                    <input class="form-control" id="sticky_enquiry_email" name="email" type="email" placeholder="Email (optional)">
                </div>
                <label class="sticky-enquiry-consent" for="sticky_enquiry_consent">
                    <input id="sticky_enquiry_consent" name="privacy_acceptance" type="checkbox" value="1" required>
                    <span>I accept the <a href="{{ route('frontend.privacy') }}">Privacy Policy</a></span>
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

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => {
        if (response.ok || response.redirected) {
            form.classList.add('d-none');
            successDiv.classList.remove('d-none');
            setTimeout(() => {
                successDiv.classList.add('d-none');
                form.classList.remove('d-none');
                form.reset();
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit';
            }, 5000);
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit';
            alert('Please fill all required fields correctly.');
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Submit';
    });
});
</script>
@endpush
