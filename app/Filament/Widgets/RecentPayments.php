<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Payment;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentPayments extends TableWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Recent Payments';

    protected int|string|array $columnSpan = 1;

    protected static bool $isLazy = true;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Payment::query()
                    ->where('status', 'received')
                    ->with('booking')
                    ->latest('payment_date')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('booking.client_name')
                    ->label('Client')
                    ->description(fn (Payment $record) => $record->booking?->booking_ref),
                TextColumn::make('amount')
                    ->money('INR')
                    ->weight('bold'),
                TextColumn::make('method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'bank_transfer' => 'info',
                        'upi' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('payment_date')
                    ->date('d M'),
            ])
            ->recordUrl(fn (Payment $record) => $record->booking_id ? BookingResource::getUrl('edit', ['record' => $record->booking_id]) : null)
            ->emptyStateHeading('No payments recorded');
    }
}
