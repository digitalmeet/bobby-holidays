<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\OnlinePayment;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Quotation;
use App\Models\Setting;
use App\Models\Tour;
use App\Models\User;
use App\Mail\QuotationSent;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductionReadinessTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_marketing_pages_can_be_requested_repeatedly(): void
    {
        $homeResponse = $this->get(route('frontend.home'));
        $homeResponse->assertOk();
        $this->assertStringContainsString('public', $homeResponse->headers->get('Cache-Control'));
        $this->assertStringContainsString('s-maxage=600', $homeResponse->headers->get('Cache-Control'));

        $this->get(route('frontend.home'))->assertOk();
        $this->get(route('frontend.destinations'))->assertOk();
        $this->get(route('frontend.destinations'))->assertOk();
        $this->get(route('frontend.services'))->assertOk();
        $this->get(route('frontend.faq'))->assertOk();
    }

    public function test_enquiries_require_and_record_explicit_privacy_consent(): void
    {
        $payload = [
            'name' => 'Neha Kapoor',
            'phone' => '9876543210',
            'email' => 'neha@example.test',
            'destination' => 'Kerala',
        ];

        $this->postJson(route('frontend.contact.submit'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors('privacy_acceptance');

        $this->postJson(route('frontend.contact.submit'), $payload + [
            'privacy_acceptance' => '1',
            'source_page' => 'packages/kerala',
        ])->assertOk();

        $enquiry = Enquiry::where('email', 'neha@example.test')->firstOrFail();
        $this->assertNotNull($enquiry->privacy_accepted_at);
        $this->assertSame(config('legal.privacy_policy_version'), $enquiry->privacy_policy_version);
        $this->assertSame('sticky-enquiry', $enquiry->consent_source);
    }

    public function test_search_funnel_preserves_trip_preferences_on_the_contact_form(): void
    {
        $brief = [
            'destination' => 'Kerala',
            'adults' => 4,
            'budget_range' => '₹50,000 - ₹1,00,000',
        ];

        $response = $this->post(route('frontend.plan-trip'), $brief);
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        $this->assertStringContainsString('brief=', $location);
        $this->assertStringNotContainsString('destination=Kerala', $location);
        $this->assertStringNotContainsString('budget_range=', $location);

        $this->get(route('frontend.contact', ['brief' => encrypted_query($brief)]))
            ->assertOk()
            ->assertSee('value="Kerala"', false)
            ->assertSee('value="4"', false)
            ->assertSee('value="₹50,000 - ₹1,00,000" selected', false)
            ->assertDontSee('id="stickyEnquiryForm"', false);
    }

    public function test_package_filters_are_encrypted_and_tampered_filter_links_fail_safely(): void
    {
        $response = $this->post(route('frontend.tour.filters'), [
            'market' => 'domestic',
            'duration' => '4-6',
            'budget' => '15-30',
            'category' => 'family',
        ]);

        $response->assertRedirect();
        $location = $response->headers->get('Location');
        $this->assertStringContainsString('filters=', $location);
        $this->assertStringNotContainsString('duration=4-6', $location);
        $this->assertStringNotContainsString('budget=15-30', $location);
        $this->assertStringNotContainsString('category=family', $location);

        $this->get(route('frontend.domestic', ['filters' => 'altered-value']))
            ->assertOk()
            ->assertSee('Any Duration', false);
    }

    public function test_health_check_reports_dependency_status_without_caching(): void
    {
        $response = $this->get(route('health'));

        $response->assertOk()
            ->assertJsonPath('status', 'ok')
            ->assertJsonPath('checks.db', 'ok')
            ->assertJsonPath('checks.cache', 'ok');
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_mobile_navigation_exposes_keyboard_and_reduced_motion_support(): void
    {
        $this->get(route('frontend.home'))
            ->assertOk()
            ->assertSee('aria-controls="mobileNavigation"', false)
            ->assertSee('id="mobileNavigation"', false)
            ->assertSee('aria-hidden="true"', false)
            ->assertSee('prefers-reduced-motion:reduce', false);

        $script = file_get_contents(public_path('assets/frontend/js/main.js'));
        $this->assertStringContainsString('event.key === "Escape"', $script);
        $this->assertStringContainsString('autoplay: prefersReducedMotion ? false', $script);
    }

    public function test_repeated_cards_use_equal_height_grid_and_carousel_layouts(): void
    {
        $this->get(route('frontend.home'))
            ->assertOk()
            ->assertSee('destination-carousel swiper', false)
            ->assertSee('row g-4 equal-card-grid', false);

        $this->get(route('frontend.destinations'))
            ->assertOk()
            ->assertSee('row g-4 equal-card-grid', false);

        $styles = file_get_contents(public_path('assets/frontend/css/style.css'));
        $this->assertStringContainsString('.equal-card-grid > [class*="col-"]', $styles);
        $this->assertStringContainsString('.destination-carousel .swiper-slide', $styles);
        $this->assertStringContainsString('align-items: stretch', $styles);
        $this->assertStringContainsString('.travel-discovery-links', $styles);
        $this->assertStringContainsString('padding: 72px 0', $styles);

        $responsiveStyles = file_get_contents(public_path('assets/frontend/css/responsive.css'));
        $this->assertStringContainsString('padding: 36px 0', $responsiveStyles);
    }

    public function test_enterprise_reports_and_destinations_admin_page_render_for_super_admin(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('super_admin');

        $this->actingAs($user)
            ->get('/admin/destinations')
            ->assertOk();

        $this->actingAs($user)
            ->get('/admin/sales-report')
            ->assertOk()
            ->assertSee('Sales performance command center');

        $this->actingAs($user)
            ->get('/admin/revenue-report')
            ->assertOk()
            ->assertSee('Revenue and collection overview');

        $this->actingAs($user)
            ->get('/admin/bookings-report')
            ->assertOk()
            ->assertSee('Booking operations control tower');

        $this->actingAs($user)
            ->get('/admin/activity-report')
            ->assertOk()
            ->assertSee('Audit and operational activity');
    }

    public function test_operational_records_cannot_be_deleted_and_new_enquiry_fields_are_available(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('super_admin');
        $destination = Destination::create(['name' => 'Deletion Guard', 'slug' => 'deletion-guard']);

        $this->assertFalse(Gate::forUser($user)->allows('delete', $destination));
        $this->assertFalse(Gate::forUser($user)->allows('forceDelete', $destination));

        $enquiry = Enquiry::create([
            'name' => 'Address Test',
            'phone' => '9876543210',
            'address' => '12 Riverfront Road, Ahmedabad, Gujarat 380009',
            'destination_other' => 'A custom island itinerary',
            'tour_other' => 'A private anniversary journey',
            'budget_min' => 50000,
            'budget_max' => 90000,
            'budget_range' => '₹50,000 – ₹90,000',
        ]);

        $this->assertSame(50000, $enquiry->budget_min);
        $this->assertSame(90000, $enquiry->budget_max);
        $this->assertDatabaseHas('enquiries', ['id' => $enquiry->id, 'destination_other' => 'A custom island itinerary']);
    }

    public function test_customer_specific_pages_are_never_publicly_cached(): void
    {
        $quoteResponse = $this->get('/quote/does-not-exist');
        $quoteResponse->assertNotFound()->assertHeader('Pragma', 'no-cache');
        $this->assertStringContainsString('private', $quoteResponse->headers->get('Cache-Control'));
        $this->assertStringContainsString('no-store', $quoteResponse->headers->get('Cache-Control'));

        $paymentResponse = $this->get('/pay/does-not-exist');
        $paymentResponse->assertNotFound()->assertHeader('Pragma', 'no-cache');
        $this->assertStringContainsString('private', $paymentResponse->headers->get('Cache-Control'));
        $this->assertStringContainsString('no-store', $paymentResponse->headers->get('Cache-Control'));
    }

    public function test_tour_and_blog_json_ld_render_without_blade_directive_errors(): void
    {
        $destination = Destination::create([
            'name' => 'Kashmir',
            'slug' => 'kashmir',
            'country' => 'India',
            'continent' => 'Domestic',
            'is_active' => true,
        ]);

        Tour::create([
            'destination_id' => $destination->id,
            'title' => 'Kashmir Delight',
            'slug' => 'kashmir-delight',
            'duration_days' => 5,
            'duration_nights' => 4,
            'starting_price' => 32000,
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        Post::create([
            'title' => 'A Practical Guide to Kashmir',
            'slug' => 'guide-to-kashmir',
            'content' => '<p>Travel guide content.</p>',
            'category' => 'Travel Guide',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $this->get(route('frontend.tour.show', 'kashmir-delight'))
            ->assertOk()
            ->assertSee('"@context"', false);

        $this->get(route('frontend.blog.show', 'guide-to-kashmir'))
            ->assertOk()
            ->assertSee('"@context"', false);
    }

    public function test_filament_job_and_payment_audit_tables_are_available(): void
    {
        foreach (['exports', 'imports', 'failed_import_rows', 'payment_logs', 'online_payment_logs', 'setting_logs'] as $table) {
            $this->assertTrue(Schema::hasTable($table), "Expected the {$table} table to exist.");
        }

        $payment = Payment::create([
            'amount' => 12500,
            'currency' => 'INR',
            'method' => 'bank_transfer',
            'reference_number' => 'TEST-BANK-001',
            'payment_date' => now()->toDateString(),
            'status' => 'received',
        ]);

        $onlinePayment = OnlinePayment::create([
            'gateway' => 'razorpay',
            'order_id' => 'order_test_001',
            'amount' => 5000,
            'currency' => 'INR',
            'status' => 'created',
        ]);

        $this->assertDatabaseHas('payment_logs', [
            'record_id' => $payment->id,
            'action' => 'created',
        ]);
        $this->assertDatabaseHas('online_payment_logs', [
            'record_id' => $onlinePayment->id,
            'action' => 'created',
        ]);
    }

    public function test_payment_order_uses_the_server_amount_and_customer_identity(): void
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();
        $this->enableRazorpay();

        $quotation = Quotation::create([
            'client_name' => 'Aarav Mehta',
            'client_email' => 'aarav@example.test',
            'client_phone' => '9876543210',
            'title' => 'Kashmir Family Holiday',
            'total_amount' => 48750,
            'validity_date' => now()->addWeek(),
            'status' => 'sent',
        ]);

        Http::fake([
            'api.razorpay.com/v1/orders' => Http::response([
                'id' => 'order_server_amount',
                'amount' => 4_875_000,
                'currency' => 'INR',
            ]),
        ]);

        $response = $this->postJson(route('payment.create-order'), [
            'quotation_id' => $quotation->id,
            'access_token' => $quotation->access_token,
            'amount' => 1,
            'client_name' => 'Spoofed Client',
        ]);

        $response->assertOk()
            ->assertJsonPath('amount', 4_875_000)
            ->assertJsonPath('order_id', 'order_server_amount');

        $this->assertDatabaseHas('online_payments', [
            'quotation_id' => $quotation->id,
            'order_id' => 'order_server_amount',
            'amount' => 48750,
            'client_name' => 'Aarav Mehta',
        ]);
    }

    public function test_payment_verification_is_idempotent_and_updates_booking_atomically(): void
    {
        $this->withoutMiddleware();
        $this->enableRazorpay();

        $booking = Booking::create([
            'client_name' => 'Diya Shah',
            'client_email' => 'diya@example.test',
            'total_amount' => 25000,
            'paid_amount' => 0,
            'balance_amount' => 25000,
            'status' => 'confirmed',
        ]);

        $onlinePayment = OnlinePayment::create([
            'booking_id' => $booking->id,
            'gateway' => 'razorpay',
            'order_id' => 'order_idempotent',
            'amount' => 25000,
            'currency' => 'INR',
            'status' => 'created',
        ]);

        $paymentId = 'pay_idempotent';
        $signature = hash_hmac('sha256', "{$onlinePayment->order_id}|{$paymentId}", 'test_secret');

        Http::fake([
            'api.razorpay.com/v1/payments/*' => Http::response([
                'id' => $paymentId,
                'order_id' => $onlinePayment->order_id,
                'amount' => 2_500_000,
                'currency' => 'INR',
                'status' => 'captured',
            ]),
        ]);

        $payload = [
            'razorpay_order_id' => $onlinePayment->order_id,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
        ];

        $this->postJson(route('payment.verify'), $payload)->assertOk()->assertJson(['success' => true]);
        $this->postJson(route('payment.verify'), $payload)->assertOk()->assertJson(['success' => true]);

        $this->assertSame(1, Payment::where('online_payment_id', $onlinePayment->id)->count());
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'paid_amount' => 25000,
            'balance_amount' => 0,
            'status' => 'fully_paid',
        ]);
    }

    public function test_public_quotation_requires_its_access_token_and_expired_quotes_cannot_be_accepted(): void
    {
        $this->withoutMiddleware();

        $quotation = Quotation::create([
            'client_name' => 'Ishaan Patel',
            'title' => 'Dubai Discovery',
            'total_amount' => 72000,
            'validity_date' => now()->subDay(),
            'status' => 'sent',
        ]);

        $this->get(route('quotation.public', $quotation->public_id))->assertNotFound();
        $this->get($quotation->publicUrl())->assertOk();

        $this->post(route('quotation.accept', $quotation->public_id), [
            'access_token' => $quotation->access_token,
        ])->assertNotFound();

        $this->assertDatabaseHas('quotations', [
            'id' => $quotation->id,
            'status' => 'viewed',
            'accepted_at' => null,
        ]);
    }

    public function test_quotation_pdf_is_downloadable_and_the_delivery_email_includes_it(): void
    {
        $quotation = Quotation::create([
            'client_name' => 'PDF Client',
            'client_email' => 'pdf.client@example.test',
            'title' => 'Kerala Luxury Journey',
            'total_amount' => 85000,
            'validity_date' => now()->addWeek(),
            'status' => 'sent',
        ]);

        $this->get(route('quotation.pdf', [
            'publicId' => $quotation->public_id,
            'token' => $quotation->access_token,
        ]))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');

        $this->assertCount(1, (new QuotationSent($quotation))->attachments());
    }

    public function test_sensitive_settings_are_encrypted_at_rest_and_readable_through_helper(): void
    {
        $stored = Setting::prepareValue('razorpay_key_secret', 'super-secret-value');
        Setting::create(['key' => 'razorpay_key_secret', 'value' => $stored]);

        $this->assertNotSame('super-secret-value', Setting::where('key', 'razorpay_key_secret')->value('value'));
        $this->assertStringStartsWith('encrypted:', Setting::where('key', 'razorpay_key_secret')->value('value'));
        $this->assertSame('super-secret-value', setting('razorpay_key_secret'));

        $setting = Setting::where('key', 'razorpay_key_secret')->firstOrFail();
        $setting->update(['value' => Setting::prepareValue($setting->key, 'rotated-secret')]);

        $log = $setting->activityLogs()->firstWhere('action', 'updated');
        $this->assertSame('[REDACTED]', $log->old_values['value']);
        $this->assertSame('[REDACTED]', $log->new_values['value']);
    }

    public function test_booking_balance_is_recalculated_for_direct_payment_changes(): void
    {
        $booking = Booking::create([
            'client_name' => 'Balance Test Client',
            'total_amount' => 100000,
            'paid_amount' => 0,
            'balance_amount' => 100000,
            'status' => 'confirmed',
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => 25000,
            'currency' => 'INR',
            'method' => 'upi',
            'reference_number' => 'BALANCE-TEST-001',
            'payment_date' => now()->toDateString(),
            'status' => 'received',
        ]);

        $booking->refresh();
        $this->assertSame('25000.00', $booking->paid_amount);
        $this->assertSame('75000.00', $booking->balance_amount);
        $this->assertSame('partial_paid', $booking->status);

        $payment->update(['status' => 'refunded']);
        $booking->refresh();
        $this->assertSame('0.00', $booking->paid_amount);
        $this->assertSame('100000.00', $booking->balance_amount);
        $this->assertSame('confirmed', $booking->status);

        $payment->update(['status' => 'received']);
        $payment->delete();
        $booking->refresh();
        $this->assertSame('0.00', $booking->paid_amount);
        $this->assertSame('100000.00', $booking->balance_amount);
    }

    public function test_booking_references_use_an_atomic_monotonic_sequence(): void
    {
        $first = Booking::create([
            'client_name' => 'First Sequence Client',
            'total_amount' => 1000,
            'balance_amount' => 1000,
        ]);
        $second = Booking::create([
            'client_name' => 'Second Sequence Client',
            'total_amount' => 1000,
            'balance_amount' => 1000,
        ]);

        $year = now()->format('Y');
        $this->assertSame("UW-{$year}-000001", $first->booking_ref);
        $this->assertSame("UW-{$year}-000002", $second->booking_ref);
        $this->assertDatabaseHas('booking_sequences', [
            'year' => $year,
            'last_number' => 2,
        ]);
    }

    private function enableRazorpay(): void
    {
        Setting::create(['key' => 'razorpay_enabled', 'value' => 'true']);
        Setting::create(['key' => 'razorpay_key_id', 'value' => 'rzp_test_key']);
        Setting::create(['key' => 'razorpay_key_secret', 'value' => 'test_secret']);
    }
}
