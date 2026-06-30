<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\OnlinePayment;
use App\Models\Payment;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
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
            'booking_id' => 'nullable|exists:bookings,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $keyId = setting('razorpay_key_id');
        $keySecret = setting('razorpay_key_secret');

        if (!$keyId || !$keySecret) {
            return response()->json(['error' => 'Payment gateway not configured.'], 500);
        }

        $amountInPaise = (int) ($validated['amount'] * 100);

        // Create Razorpay order via API
        $orderData = [
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => 'rcpt_' . uniqid(),
        ];

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($orderData),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_USERPWD => "{$keyId}:{$keySecret}",
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            Log::error('Razorpay order creation failed', ['response' => $response]);
            return response()->json(['error' => 'Failed to create payment order.'], 500);
        }

        $order = json_decode($response, true);

        // Store in DB
        $onlinePayment = OnlinePayment::create([
            'booking_id' => $validated['booking_id'] ?? null,
            'quotation_id' => $validated['quotation_id'] ?? null,
            'gateway' => 'razorpay',
            'order_id' => $order['id'],
            'amount' => $validated['amount'],
            'currency' => 'INR',
            'status' => 'created',
            'client_name' => $request->input('client_name'),
            'client_email' => $request->input('client_email'),
            'client_phone' => $request->input('client_phone'),
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

        $keySecret = setting('razorpay_key_secret');

        // Verify signature
        $expectedSignature = hash_hmac('sha256', $validated['razorpay_order_id'] . '|' . $validated['razorpay_payment_id'], $keySecret);

        if ($expectedSignature !== $validated['razorpay_signature']) {
            Log::warning('Razorpay signature verification failed', $validated);
            return response()->json(['error' => 'Payment verification failed.'], 400);
        }

        // Update online payment record
        $onlinePayment = OnlinePayment::where('order_id', $validated['razorpay_order_id'])->first();

        if (!$onlinePayment) {
            return response()->json(['error' => 'Payment record not found.'], 404);
        }

        $onlinePayment->update([
            'payment_id' => $validated['razorpay_payment_id'],
            'signature' => $validated['razorpay_signature'],
            'status' => 'captured',
            'paid_at' => now(),
            'gateway_response' => $validated,
        ]);

        // Auto-record in payments table if linked to booking
        if ($onlinePayment->booking_id) {
            $payment = Payment::create([
                'booking_id' => $onlinePayment->booking_id,
                'amount' => $onlinePayment->amount,
                'currency' => 'INR',
                'method' => 'online',
                'reference_number' => $validated['razorpay_payment_id'],
                'payment_date' => now()->toDateString(),
                'status' => 'received',
                'notes' => 'Online payment via Razorpay',
            ]);

            // Update booking balance
            $booking = $onlinePayment->booking;
            $totalPaid = $booking->payments()->where('status', 'received')->sum('amount');
            $balance = $booking->total_amount - $totalPaid;
            $booking->update([
                'paid_amount' => $totalPaid,
                'balance_amount' => max(0, $balance),
                'status' => $balance <= 0 ? 'fully_paid' : 'partial_paid',
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Payment verified successfully.']);
    }

    /**
     * Show payment page (public — for client to pay from quotation link).
     */
    public function paymentPage(string $publicId)
    {
        if (!$this->isEnabled()) {
            abort(404, 'Online payments are not available.');
        }

        $quotation = Quotation::where('public_id', $publicId)
            ->whereIn('status', ['sent', 'viewed', 'accepted'])
            ->firstOrFail();

        return view('payments.razorpay', [
            'quotation' => $quotation,
            'keyId' => setting('razorpay_key_id'),
            'amount' => $quotation->total_amount,
        ]);
    }
}
