<?php

namespace App\Observers;

use App\Models\Quotation;
use App\Models\User;
use Filament\Notifications\Notification;

class QuotationObserver
{
    public function updated(Quotation $quotation): void
    {
        if (!$quotation->isDirty('status')) {
            return;
        }

        $newStatus = $quotation->status;
        $preparedBy = $quotation->preparedBy;

        // Notify the person who prepared the quotation
        $recipients = collect();
        if ($preparedBy) {
            $recipients->push($preparedBy);
        }

        // Also notify super admins
        $admins = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->get();
        $recipients = $recipients->merge($admins)->unique('id');

        if ($recipients->isEmpty()) {
            return;
        }

        match ($newStatus) {
            'viewed' => Notification::make()
                ->title('Quotation Viewed')
                ->body("Client viewed quotation \"{$quotation->title}\" ({$quotation->public_id})")
                ->icon('heroicon-o-eye')
                ->info()
                ->sendToDatabase($recipients),

            'accepted' => Notification::make()
                ->title('🎉 Quotation Accepted!')
                ->body("\"{$quotation->title}\" — ₹" . number_format($quotation->total_amount) . " accepted by {$quotation->client_name}")
                ->icon('heroicon-o-check-circle')
                ->success()
                ->sendToDatabase($recipients),

            'rejected' => Notification::make()
                ->title('Quotation Rejected')
                ->body("\"{$quotation->title}\" was rejected by {$quotation->client_name}." . ($quotation->rejection_reason ? " Reason: {$quotation->rejection_reason}" : ''))
                ->icon('heroicon-o-x-circle')
                ->danger()
                ->sendToDatabase($recipients),

            default => null,
        };
    }
}
