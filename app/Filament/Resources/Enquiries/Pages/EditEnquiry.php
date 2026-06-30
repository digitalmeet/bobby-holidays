<?php

namespace App\Filament\Resources\Enquiries\Pages;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\Quotations\QuotationResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditEnquiry extends EditRecord
{
    protected static string $resource = EnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_quotation')
                ->label('Create Quotation')
                ->icon('heroicon-o-document-currency-rupee')
                ->color('success')
                ->visible(fn () => in_array($this->record->status, ['new', 'contacted', 'quoted']))
                ->url(fn () => QuotationResource::getUrl('create', ['enquiry_id' => $this->record->id])),
            Action::make('mark_contacted')
                ->label('Mark Contacted')
                ->icon('heroicon-o-phone')
                ->color('warning')
                ->visible(fn () => $this->record->status === 'new')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update([
                        'status' => 'contacted',
                        'last_contacted_at' => now(),
                    ]);
                    $this->refreshFormData(['status', 'last_contacted_at']);
                }),
            Action::make('mark_lost')
                ->label('Mark Lost')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => !in_array($this->record->status, ['converted', 'lost']))
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'lost']);
                    $this->refreshFormData(['status']);
                }),
            DeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
