<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Quotation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    public function mount(): void
    {
        parent::mount();

        $quotationId = request()->query('quotation_id');

        if ($quotationId && $quotation = Quotation::query()->accepted()->valid()->find($quotationId)) {
            abort_unless(auth()->user()->can('view', $quotation), 403);

            $this->form->fill([
                'quotation_id' => $quotation->id,
                'enquiry_id' => $quotation->enquiry_id,
                'tour_id' => $quotation->enquiry?->tour_id,
                'client_name' => $quotation->client_name,
                'client_email' => $quotation->client_email,
                'client_phone' => $quotation->client_phone,
                'travel_date' => $quotation->travel_date,
                'return_date' => $quotation->return_date,
                'adults' => $quotation->adults,
                'children' => $quotation->children,
                'infants' => $quotation->infants,
                'total_amount' => $quotation->total_amount,
                'currency' => $quotation->currency,
                'status' => 'confirmed',
                'assigned_to' => auth()->id(),
            ]);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['quotation_id'])) {
            $quotation = Quotation::query()
                ->accepted()
                ->valid()
                ->find($data['quotation_id']);

            if (!$quotation || $quotation->bookings()->exists()) {
                throw ValidationException::withMessages([
                    'data.quotation_id' => 'The quotation is not eligible or already has a booking.',
                ]);
            }

            $data['enquiry_id'] = $quotation->enquiry_id;
            $data['client_name'] = $quotation->client_name;
            $data['client_email'] = $quotation->client_email;
            $data['client_phone'] = $quotation->client_phone;
            $data['total_amount'] = $quotation->total_amount;
            $data['currency'] = $quotation->currency;
        }

        $data['paid_amount'] = 0;
        $data['balance_amount'] = $data['total_amount'] ?? 0;
        $data['status'] = 'confirmed';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function afterCreate(): void
    {
        $this->record->statusHistories()->create([
            'changed_by' => auth()->id(),
            'old_status' => null,
            'new_status' => 'confirmed',
            'notes' => 'Booking created.',
            'created_at' => now(),
        ]);
    }
}
