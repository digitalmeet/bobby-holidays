<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class RazorpayService
{
    private function client(): PendingRequest
    {
        $keyId = setting('razorpay_key_id');
        $keySecret = setting('razorpay_key_secret');

        if (!$keyId || !$keySecret) {
            throw new RuntimeException('Payment gateway is not configured.');
        }

        return Http::baseUrl('https://api.razorpay.com/v1')
            ->withBasicAuth($keyId, $keySecret)
            ->acceptJson()
            ->asJson()
            ->connectTimeout(5)
            ->timeout(15)
            ->retry(2, 200, throw: false);
    }

    public function createOrder(int $amountInPaise, string $receipt): array
    {
        $response = $this->client()->post('/orders', [
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => $receipt,
            'payment_capture' => 1,
        ]);

        if (!$response->successful() || !$response->json('id')) {
            throw new RuntimeException('The payment provider could not create an order.');
        }

        return $response->json();
    }

    public function fetchPayment(string $paymentId): array
    {
        $response = $this->client()->get('/payments/' . rawurlencode($paymentId));

        if (!$response->successful()) {
            throw new RuntimeException('The payment provider could not verify the payment.');
        }

        return $response->json();
    }

    public function verifySignature(string $orderId, string $paymentId, string $signature): bool
    {
        $secret = (string) setting('razorpay_key_secret');
        $expected = hash_hmac('sha256', "{$orderId}|{$paymentId}", $secret);

        return hash_equals($expected, $signature);
    }
}
