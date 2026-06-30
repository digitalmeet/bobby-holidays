<?php

namespace App\Filament\Resources\Enquiries\Pages;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Models\Enquiry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateEnquiry extends CreateRecord
{
    protected static string $resource = EnquiryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        // Check for repeat client
        $record = $this->record;
        $existingCount = Enquiry::where('id', '!=', $record->id)
            ->where(function ($q) use ($record) {
                $q->where('phone', $record->phone);
                if ($record->email) {
                    $q->orWhere('email', $record->email);
                }
            })
            ->count();

        if ($existingCount > 0) {
            Notification::make()
                ->title('Repeat Client Detected')
                ->body("{$record->name} has {$existingCount} previous enquiry/enquiries with the same phone/email.")
                ->warning()
                ->persistent()
                ->send();
        }
    }
}
