<?php

namespace App\Filament\Resources\Bookings\RelationManagers;

use App\Models\Booking;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Payments';

    protected static ?string $recordTitleAttribute = 'reference_number';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label('Amount (₹)')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->minValue(0.01),
                Select::make('method')
                    ->options([
                        'cash' => 'Cash',
                        'bank_transfer' => 'Bank Transfer',
                        'upi' => 'UPI',
                        'credit_card' => 'Credit Card',
                        'cheque' => 'Cheque',
                        'online' => 'Online',
                    ])
                    ->required(),
                DatePicker::make('payment_date')
                    ->required()
                    ->default(now()),
                TextInput::make('reference_number')
                    ->label('Reference / Transaction No.')
                    ->maxLength(255)
                    ->placeholder('e.g. UTR number, cheque no.'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'received' => 'Received',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->default('received')
                    ->required(),
                TextInput::make('currency')
                    ->default('INR')
                    ->maxLength(3),
                FileUpload::make('receipt_path')
                    ->label('Receipt / Proof')
                    ->directory('payments/receipts')
                    ->acceptedFileTypes(['image/*', 'application/pdf'])
                    ->maxSize(5120)
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->rows(2)
                    ->placeholder('Payment notes...')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('payment_date', 'desc')
            ->columns([
                TextColumn::make('payment_date')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('INR')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'bank_transfer' => 'info',
                        'upi' => 'primary',
                        'credit_card' => 'warning',
                        'cheque' => 'gray',
                        'online' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('reference_number')
                    ->label('Reference')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'received' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('recordedBy.name')
                    ->label('Recorded By')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Record Payment')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['recorded_by'] = auth()->id();
                        return $data;
                    })
                    ->after(function ($record) {
                        $this->updateBookingBalance();
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(function () {
                        $this->updateBookingBalance();
                    }),
                DeleteAction::make()
                    ->after(function () {
                        $this->updateBookingBalance();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Recalculate booking paid_amount and balance after payment changes.
     */
    private function updateBookingBalance(): void
    {
        $booking = $this->getOwnerRecord();
        $totalPaid = $booking->payments()
            ->where('status', 'received')
            ->sum('amount');

        $balance = $booking->total_amount - $totalPaid;

        $oldStatus = $booking->status;
        $newStatus = $oldStatus;

        if ($balance <= 0 && !in_array($oldStatus, ['completed', 'cancelled', 'refunded'])) {
            $newStatus = 'fully_paid';
        } elseif ($totalPaid > 0 && $balance > 0 && !in_array($oldStatus, ['completed', 'cancelled', 'refunded'])) {
            $newStatus = 'partial_paid';
        }

        $booking->update([
            'paid_amount' => $totalPaid,
            'balance_amount' => max(0, $balance),
            'status' => $newStatus,
        ]);

        if ($oldStatus !== $newStatus) {
            $booking->statusHistories()->create([
                'changed_by' => auth()->id(),
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'notes' => 'Auto-updated by payment recording.',
                'created_at' => now(),
            ]);
        }
    }
}
