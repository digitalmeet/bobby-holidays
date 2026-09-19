<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\OnlinePayment;
use App\Models\Payment;
use App\Models\Quotation;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class RazorpayController extends Controller
{
    public function __construct(private readonly RazorpayService $razorpay)
    {
    }

    /**
     * Check if Razorpay is enabled via settings.
     */
    private function isEnabled(): bool
    {
        return setting('razorpay_enabled', 'false') === 'true';
    }

    /**
     * Create a Razorpay order for a booking or quotation.
     */
    public function createOrder(Request $request)
    {
        if (!$this->isEnabled()) {
            abort(404, 'Online payments are not enabled.');
        }

        $validated = $request->validate([
            'booking_id' => 'nullable|integer|exists:bookings,id',
            'quotation_id' => 'nullable|integer|exists:quotations,id',
        ]);

        if (count(array_filter([
            $validated['booking_id'] ?? null,
            $validated['quotation_id'] ?? null,
        ])) !== 1) {
            throw ValidationException::withMessages([
                'payment_reference' => 'Provide exactly one booking or quotation.',
            ]);
        }

        $keyId = setting('razorpay_key_id');
        if (!$keyId || !setting('razorpay_key_secret')) {
            return response()->json(['error' => 'Payment gateway not configured.'], 500);
        }

        [$amount, $booking, $quotation] = $this->resolvePayable($validated, (string) $request->input('access_token', ''));
        $amountInPaise = (int) round($amount * 100);

        try {
            $order = $this->razorpay->createOrder($amountInPaise, 'uw_' . str()->uuid());
        } catch (RuntimeException $exception) {
            Log::error('Razorpay order creation failed', ['message' => $exception->getMessage()]);

            return response()->json(['error' => 'Failed to create payment order. Please try again.'], 502);
        }

        $onlinePayment = OnlinePayment::create([
            'booking_id' => $booking?->id,
            'quotation_id' => $quotation?->id,
            'gateway' => 'razorpay',
            'order_id' => $order['id'],
            'amount' => $amount,
            'currency' => 'INR',
            'status' => 'created',
            'client_name' => $booking?->client_name ?? $quotation?->client_name,
            'client_email' => $booking?->client_email ?? $quotation?->client_email,
            'client_phone' => $booking?->client_phone ?? $quotation?->client_phone,
            'gateway_response' => ['order' => $order],
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'key_id' => $keyId,
            'payment_record_id' => $onlinePayment->id,
        ]);
    }

    /**
     * Verify payment after Razorpay callback.
     */
    public function verifyPayment(Request $request)
    {
        if (!$this->isEnabled()) {
            abort(404);
        }

        $validated = $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        if (!$this->razorpay->verifySignature(
            $validated['razorpay_order_id'],
            $validated['razorpay_payment_id'],
            $validated['razorpay_signature'],
        )) {
            Log::warning('Razorpay signature verification failed', [
                'order_id' => $validated['razorpay_order_id'],
                'payment_id' => $validated['razorpay_payment_id'],
            ]);

            return response()->json(['error' => 'Payment verification failed.'], 400);
        }

        try {
            $gatewayPayment = $this->razorpay->fetchPayment($validated['razorpay_payment_id']);
        } catch (RuntimeException $exception) {
            Log::error('Razorpay payment verification request failed', ['message' => $exception->getMessage()]);

            return response()->json(['error' => 'Unable to confirm payment with the provider.'], 502);
        }

        $onlinePayment = OnlinePayment::where('order_id', $validated['razorpay_order_id'])->first();
        if (!$onlinePayment) {
            return response()->json(['error' => 'Payment record not found.'], 404);
        }

        if (!$this->gatewayPaymentMatches($onlinePayment, $gatewayPayment)) {
            Log::warning('Razorpay payment data did not match the local order', [
                'order_id' => $validated['razorpay_order_id'],
                'payment_id' => $validated['razorpay_payment_id'],
            ]);

            return response()->json(['error' => 'Payment details do not match the order.'], 400);
        }

        DB::transaction(function () use ($onlinePayment, $validated, $gatewayPayment): void {
            $onlinePayment = OnlinePayment::query()->lockForUpdate()->findOrFail($onlinePayment->id);

            if ($onlinePayment->status === 'captured') {
                if ($onlinePayment->payment_id !== $validated['razorpay_payment_id']) {
                    throw ValidationException::withMessages(['payment' => 'This order has already been paid.']);
                }

                return;
            }

            $onlinePayment->update([
                'payment_id' => $validated['razorpay_payment_id'],
                'signature' => $validated['razorpay_signature'],
                'status' => 'captured',
                'paid_at' => now(),
                'gateway_response' => ['payment' => $gatewayPayment],
            ]);

            if (!$onlinePayment->booking_id) {
                return;
            }

            $booking = Booking::query()->lockForUpdate()->findOrFail($onlinePayment->booking_id);

            Payment::firstOrCreate(
                ['online_payment_id' => $onlinePayment->id],
                [
                    'booking_id' => $booking->id,
                    'amount' => $onlinePayment->amount,
                    'currency' => $onlinePayment->currency,
                    'method' => 'online',
                    'reference_number' => $validated['razorpay_payment_id'],
                    'payment_date' => now()->toDateString(),
                    'status' => 'received',
                    'notes' => 'Online payment via Razorpay',
                ],
            );

            $totalPaid = (float) $booking->payments()->where('status', 'received')->sum('amount');
            $balance = max(0, (float) $booking->total_amount - $totalPaid);
            $status = $booking->status;

            if (!in_array($status, ['completed', 'cancelled', 'refunded'], true)) {
                $status = $balance <= 0 ? 'fully_paid' : 'partial_paid';
            }

            $booking->update([
                'paid_amount' => $totalPaid,
                'balance_amount' => $balance,
                'status' => $status,
            ]);
        }, 3);

        return response()->json(['success' => true, 'message' => 'Payment verified successfully.']);
    }

    /**
     * Show payment page (public — for client to pay from quotation link).
     */
    public function paymentPage(string $publicId, Request $request)
    {
        if (!$this->isEnabled()) {
            abort(404, 'Online payments are not available.');
        }

        $quotation = Quotation::where('public_id', $publicId)
            ->whereIn('status', ['sent', 'viewed', 'accepted'])
            ->valid()
            ->firstOrFail();

        abort_unless(
            $quotation->access_token && hash_equals($quotation->access_token, (string) $request->query('token', '')),
            404,
        );

        [$amount] = $this->resolvePayable(['quotation_id' => $quotation->id], $quotation->access_token);

        return view('payments.razorpay', [
            'quotation' => $quotation,
            'keyId' => setting('razorpay_key_id'),
            'amount' => $amount,
        ]);
    }

    private function resolvePayable(array $validated, string $accessToken = ''): array
    {
        if (!empty($validated['booking_id'])) {
            abort_unless(auth()->check(), 403);
            $booking = Booking::query()->findOrFail($validated['booking_id']);
            abort_unless(auth()->user()->can('view', $booking), 403);

            if (in_array($booking->status, ['cancelled', 'refunded', 'completed'], true) || (float) $booking->balance_amount <= 0) {
                throw ValidationException::withMessages(['booking_id' => 'This booking does not have a payable balance.']);
            }

            return [(float) $booking->balance_amount, $booking, $booking->quotation];
        }

        $quotation = Quotation::query()
            ->whereKey($validated['quotation_id'])
            ->whereIn('status', ['sent', 'viewed', 'accepted'])
            ->valid()
            ->firstOrFail();

        abort_unless(
            $quotation->access_token && hash_equals($quotation->access_token, $accessToken),
            404,
        );

        $booking = Booking::query()->where('quotation_id', $quotation->id)->first();
        if ($booking && !in_array($booking->status, ['cancelled', 'refunded', 'completed'], true)) {
            return [(float) $booking->balance_amount, $booking, $quotation];
        }

        $paid = (float) $quotation->onlinePayments()->captured()->sum('amount');
        $amount = max(0, (float) $quotation->total_amount - $paid);

        if ($amount <= 0) {
            throw ValidationException::withMessages(['quotation_id' => 'This quotation has already been paid.']);
        }

        return [$amount, null, $quotation];
    }

    private function gatewayPaymentMatches(OnlinePayment $onlinePayment, array $gatewayPayment): bool
    {
        return ($gatewayPayment['id'] ?? null) !== null
            && ($gatewayPayment['order_id'] ?? null) === $onlinePayment->order_id
            && ($gatewayPayment['status'] ?? null) === 'captured'
            && ($gatewayPayment['currency'] ?? null) === $onlinePayment->currency
            && (int) ($gatewayPayment['amount'] ?? -1) === (int) round((float) $onlinePayment->amount * 100);
    }
}
