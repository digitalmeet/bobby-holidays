<?php

namespace App\Observers;

use App\Models\Enquiry;
use App\Models\User;
use Filament\Notifications\Notification;

class EnquiryObserver
{
    public function created(Enquiry $enquiry): void
    {
        // Notify all sales + super_admin users about new enquiry
        $recipients = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['super_admin', 'sales']);
        })->get();

        Notification::make()
            ->title('New Enquiry Received')
            ->body("{$enquiry->name} ({$enquiry->phone}) — Source: {$enquiry->source}")
            ->icon('heroicon-o-chat-bubble-left-right')
            ->info()
            ->sendToDatabase($recipients);
    }
}
