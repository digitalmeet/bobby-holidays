<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use App\Models\Enquiry;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;

class CreateQuotation extends CreateRecord
{
    protected static string $resource = QuotationResource::class;

    /**
     * Pre-fill form data from linked enquiry when coming from enquiry page.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['prepared_by'] = $data['prepared_by'] ?? auth()->id();

        return $data;
    }

    /**
     * Mount with enquiry data pre-filled if enquiry_id is provided.
     */
    public function mount(): void
    {
        parent::mount();

        $enquiryId = request()->query('enquiry_id');

        if ($enquiryId && $enquiry = Enquiry::find($enquiryId)) {
            $this->form->fill([
                'enquiry_id' => $enquiry->id,
                'client_name' => $enquiry->name,
                'client_email' => $enquiry->email,
                'client_phone' => $enquiry->phone,
                'travel_date' => $enquiry->travel_date,
                'adults' => $enquiry->adults,
                'children' => $enquiry->children,
                'infants' => $enquiry->infants,
                'title' => $enquiry->tour?->title
                    ?? $enquiry->destination?->name . ' Package'
                    ?? 'Custom Package',
                'prepared_by' => auth()->id(),
                'status' => 'draft',
                'currency' => 'INR',
                'version' => 1,
            ]);

            // Update enquiry status to quoted
            if ($enquiry->status !== 'converted') {
                $enquiry->update(['status' => 'quoted']);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function afterCreate(): void
    {
        // Log history
        $this->record->histories()->create([
            'changed_by' => auth()->id(),
            'event' => 'created',
            'new_status' => 'draft',
            'new_total' => $this->record->total_amount,
            'created_at' => now(),
        ]);
    }
}
