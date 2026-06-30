<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_completed')
                ->label('Mark Completed')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn () => in_array($this->record->status, ['fully_paid', 'confirmed', 'partial_paid']))
                ->requiresConfirmation()
                ->modalDescription('Mark this booking as completed? This means the trip has been successfully concluded.')
                ->action(function () {
                    $oldStatus = $this->record->status;
                    $this->record->update(['status' => 'completed']);

                    $this->record->statusHistories()->create([
                        'changed_by' => auth()->id(),
                        'old_status' => $oldStatus,
                        'new_status' => 'completed',
                        'notes' => 'Trip completed.',
                        'created_at' => now(),
                    ]);

                    $this->refreshFormData(['status']);
                    Notification::make()->title('Booking marked as completed.')->success()->send();
                }),

            Action::make('cancel_booking')
                ->label('Cancel Booking')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => !in_array($this->record->status, ['cancelled', 'refunded', 'completed']))
                ->form([
                    Textarea::make('cancellation_reason')
                        ->label('Cancellation Reason')
                        ->required()
                        ->rows(3)
                        ->placeholder('Why is this booking being cancelled?'),
                ])
                ->action(function (array $data) {
                    $oldStatus = $this->record->status;
                    $this->record->update([
                        'status' => 'cancelled',
                        'cancelled_at' => now(),
                        'cancellation_reason' => $data['cancellation_reason'],
                    ]);

                    $this->record->statusHistories()->create([
                        'changed_by' => auth()->id(),
                        'old_status' => $oldStatus,
                        'new_status' => 'cancelled',
                        'notes' => $data['cancellation_reason'],
                        'created_at' => now(),
                    ]);

                    $this->refreshFormData(['status', 'cancellation_reason', 'cancelled_at']);
                    Notification::make()->title('Booking cancelled.')->warning()->send();
                }),

            Action::make('whatsapp')
                ->label('WhatsApp')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('success')
                ->url(fn () => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $this->record->client_phone) . '?text=' . urlencode("Hi {$this->record->client_name}, regarding your booking {$this->record->booking_ref} with UniWorld Holidays."))
                ->openUrlInNewTab()
                ->visible(fn () => !empty($this->record->client_phone)),

            DeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Recalculate balance
        $totalPaid = $this->record->payments()->where('status', 'received')->sum('amount');
        $balance = $this->record->total_amount - $totalPaid;

        if ($this->record->paid_amount != $totalPaid || $this->record->balance_amount != max(0, $balance)) {
            $this->record->update([
                'paid_amount' => $totalPaid,
                'balance_amount' => max(0, $balance),
            ]);
        }
    }
}
