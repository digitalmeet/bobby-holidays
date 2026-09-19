<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingBalanceService
{
    public function recalculate(?int $bookingId): void
    {
        if (!$bookingId) {
            return;
        }

        DB::transaction(function () use ($bookingId): void {
            $booking = Booking::query()->lockForUpdate()->find($bookingId);
            if (!$booking) {
                return;
            }

            $paid = (float) $booking->payments()->where('status', 'received')->sum('amount');
            $balance = max(0, (float) $booking->total_amount - $paid);
            $status = $booking->status;

            if (!in_array($status, ['completed', 'cancelled', 'refunded'], true)) {
                $status = $paid <= 0
                    ? 'confirmed'
                    : ($balance <= 0 ? 'fully_paid' : 'partial_paid');
            }

            $booking->updateQuietly([
                'paid_amount' => $paid,
                'balance_amount' => $balance,
                'status' => $status,
            ]);
        }, 3);
    }
}
