<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Quotations\QuotationResource;
use App\Mail\QuotationSent;
use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditQuotation extends EditRecord
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('copy_public_link')
                ->label('Copy Link')
                ->icon('heroicon-o-link')
                ->color('gray')
                ->action(function () {
                    $url = url("/quote/{$this->record->public_id}");
                    Notification::make()
                        ->title('Public link copied')
                        ->body($url)
                        ->success()
                        ->send();
                }),

            Action::make('mark_sent')
                ->label('Mark as Sent')
                ->icon('heroicon-o-paper-airplane')
                ->color('info')
                ->visible(fn () => $this->record->status === 'draft')
                ->requiresConfirmation()
                ->modalDescription('This will mark the quotation as sent to the client.')
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'sent',
                        'sent_at' => now(),
                    ]);

                    $this->record->histories()->create([
                        'changed_by' => auth()->id(),
                        'event' => 'sent',
                        'old_status' => $oldStatus,
                        'new_status' => 'sent',
                        'created_at' => now(),
                    ]);

                    // Send email to client
                    $emailSent = false;
                    if ($this->record->client_email) {
                        try {
                            \Illuminate\Support\Facades\Mail::to($this->record->client_email)
                                ->send(new QuotationSent($this->record));
                            $emailSent = true;
                        } catch (\Throwable $e) {
                            \Log::warning('Quotation email failed: ' . $e->getMessage());
                        }
                    }

                    $this->refreshFormData(['status']);

                    if ($emailSent) {
                        Notification::make()->title('Quotation sent & email delivered.')->success()->send();
                    } elseif ($this->record->client_email) {
                        Notification::make()->title('Quotation marked as sent.')->body('Email delivery failed. Share the link manually.')->warning()->send();
                    } else {
                        Notification::make()->title('Quotation marked as sent.')->body('No email on file. Share the link manually.')->info()->send();
                    }
                }),

            Action::make('mark_accepted')
                ->label('Accept')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => in_array($this->record->status, ['sent', 'viewed']))
                ->requiresConfirmation()
                ->modalDescription('Mark this quotation as accepted by the client?')
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'accepted',
                        'accepted_at' => now(),
                    ]);

                    $this->record->histories()->create([
                        'changed_by' => auth()->id(),
                        'event' => 'accepted',
                        'old_status' => $oldStatus,
                        'new_status' => 'accepted',
                        'created_at' => now(),
                    ]);

                    // Update linked enquiry status
                    if ($this->record->enquiry_id) {
                        $this->record->enquiry->update(['status' => 'converted']);
                    }

                    $this->refreshFormData(['status']);
                    Notification::make()->title('Quotation accepted!')->success()->send();
                }),

            Action::make('mark_rejected')
                ->label('Reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => in_array($this->record->status, ['sent', 'viewed']))
                ->form([
                    Textarea::make('rejection_reason')
                        ->label('Reason for Rejection')
                        ->rows(3)
                        ->placeholder('Why was this quotation rejected?'),
                ])
                ->action(function (array $data) {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'rejected',
                        'rejected_at' => now(),
                        'rejection_reason' => $data['rejection_reason'] ?? null,
                    ]);

                    $this->record->histories()->create([
                        'changed_by' => auth()->id(),
                        'event' => 'rejected',
                        'old_status' => $oldStatus,
                        'new_status' => 'rejected',
                        'notes' => $data['rejection_reason'] ?? null,
                        'created_at' => now(),
                    ]);

                    $this->refreshFormData(['status', 'rejection_reason']);
                    Notification::make()->title('Quotation rejected.')->warning()->send();
                }),

            Action::make('create_revision')
                ->label('Create Revision')
                ->icon('heroicon-o-document-duplicate')
                ->color('warning')
                ->visible(fn () => in_array($this->record->status, ['sent', 'viewed', 'rejected']))
                ->requiresConfirmation()
                ->modalDescription('This will create a new version of this quotation and mark this one as revised.')
                ->action(function () {
                    $oldRecord = $this->record;

                    // Create new version
                    $newQuotation = $oldRecord->replicate(['public_id', 'access_token', 'sent_at', 'viewed_at', 'view_count', 'accepted_at', 'rejected_at', 'rejection_reason']);
                    $newQuotation->version = $oldRecord->version + 1;
                    $newQuotation->parent_quotation_id = $oldRecord->id;
                    $newQuotation->status = 'draft';
                    $newQuotation->save();

                    // Copy items
                    foreach ($oldRecord->items as $item) {
                        $newItem = $item->replicate();
                        $newItem->quotation_id = $newQuotation->id;
                        $newItem->save();
                    }

                    // Copy sections
                    foreach ($oldRecord->sections as $section) {
                        $newSection = $section->replicate();
                        $newSection->quotation_id = $newQuotation->id;
                        $newSection->save();
                    }

                    // Mark old as revised
                    $oldRecord->update(['status' => 'revised']);
                    $oldRecord->histories()->create([
                        'changed_by' => auth()->id(),
                        'event' => 'revised',
                        'old_status' => $oldRecord->status,
                        'new_status' => 'revised',
                        'notes' => "New version v{$newQuotation->version} created.",
                        'created_at' => now(),
                    ]);

                    Notification::make()->title("Revision v{$newQuotation->version} created.")->success()->send();

                    // Redirect to new version
                    $this->redirect(QuotationResource::getUrl('edit', ['record' => $newQuotation]));
                }),

            Action::make('convert_to_booking')
                ->label('Create Booking')
                ->icon('heroicon-o-ticket')
                ->color('success')
                ->visible(fn () => $this->record->status === 'accepted')
                ->requiresConfirmation()
                ->modalDescription('Create a confirmed booking from this accepted quotation?')
                ->url(fn () => BookingResource::getUrl('create', ['quotation_id' => $this->record->id])),

            Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->url(fn () => route('quotation.pdf', $this->record->public_id))
                ->openUrlInNewTab(),

            DeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Recalculate totals from items
        $items = $this->record->items()->where('is_included_in_total', true)->get();
        $subtotal = $items->sum('total_cost');

        if ($subtotal != $this->record->subtotal_amount) {
            $oldTotal = $this->record->total_amount;
            $this->record->update([
                'subtotal_amount' => $subtotal,
                'total_amount' => $subtotal - $this->record->discount_amount + $this->record->tax_amount,
            ]);

            if ($oldTotal != $this->record->total_amount) {
                $this->record->histories()->create([
                    'changed_by' => auth()->id(),
                    'event' => 'total_changed',
                    'old_total' => $oldTotal,
                    'new_total' => $this->record->total_amount,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
