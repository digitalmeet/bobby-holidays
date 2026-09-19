<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\User;
use App\Services\BookingBalanceService;
use Filament\Notifications\Notification;

class PaymentObserver
{
    public function saved(Payment $payment): void
    {
        app(BookingBalanceService::class)->recalculate($payment->booking_id);

        if ($payment->wasChanged('booking_id')) {
            app(BookingBalanceService::class)->recalculate((int) $payment->getOriginal('booking_id'));
        }
    }

    public function deleted(Payment $payment): void
    {
        app(BookingBalanceService::class)->recalculate($payment->booking_id);
    }

    public function restored(Payment $payment): void
    {
        app(BookingBalanceService::class)->recalculate($payment->booking_id);
    }

    public function created(Payment $payment): void
    {
        if ($payment->status !== 'received') {
            return;
        }

        $booking = $payment->booking;
        if (!$booking) {
            return;
        }

        // Notify assigned user and super admins
        $recipients = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->get();
        if ($booking->assigned_to) {
            $assignedUser = User::find($booking->assigned_to);
            if ($assignedUser) {
                $recipients->push($assignedUser);
            }
        }

        Notification::make()
            ->title('Payment Received')
            ->body("₹" . number_format($payment->amount) . " received for {$booking->booking_ref} ({$booking->client_name}) via {$payment->method}")
            ->icon('heroicon-o-currency-rupee')
            ->success()
            ->sendToDatabase($recipients->unique('id'));
    }
}
