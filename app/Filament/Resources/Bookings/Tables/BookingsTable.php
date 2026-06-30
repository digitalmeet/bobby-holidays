<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Models\Booking;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('booking_ref')
                    ->label('Ref')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Booking $record) => $record->client_phone),
                TextColumn::make('tour.title')
                    ->label('Tour')
                    ->limit(25)
                    ->placeholder('Custom')
                    ->toggleable(),
                TextColumn::make('travel_date')
                    ->date('d M Y')
                    ->sortable()
                    ->description(fn (Booking $record) => $record->travel_date && $record->travel_date->isFuture()
                        ? $record->travel_date->diffForHumans()
                        : null)
                    ->color(fn (Booking $record) => $record->travel_date && $record->travel_date->diffInDays(now()) <= 7 && $record->travel_date->isFuture() ? 'danger' : null),
                TextColumn::make('adults')
                    ->label('Pax')
                    ->formatStateUsing(fn (Booking $record) => "{$record->adults}A" .
                        ($record->children ? " {$record->children}C" : '') .
                        ($record->infants ? " {$record->infants}I" : '')),
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('balance_amount')
                    ->label('Balance')
                    ->money('INR')
                    ->color(fn (Booking $record) => $record->balance_amount > 0 ? 'danger' : 'success')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'info',
                        'partial_paid' => 'warning',
                        'fully_paid' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('assignedTo.name')
                    ->label('Assigned')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'confirmed' => 'Confirmed',
                        'partial_paid' => 'Partial Paid',
                        'fully_paid' => 'Fully Paid',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ]),
                SelectFilter::make('assigned_to')
                    ->label('Assigned To')
                    ->relationship('assignedTo', 'name'),
                SelectFilter::make('tour_id')
                    ->label('Tour')
                    ->relationship('tour', 'title')
                    ->searchable()
                    ->preload(),
                Filter::make('upcoming')
                    ->label('Upcoming Travel')
                    ->query(fn (Builder $query) => $query->upcoming()),
                Filter::make('has_balance')
                    ->label('Has Balance Due')
                    ->query(fn (Builder $query) => $query->where('balance_amount', '>', 0)),
                Filter::make('travel_this_month')
                    ->label('Travelling This Month')
                    ->query(fn (Builder $query) => $query
                        ->where('travel_date', '>=', now()->startOfMonth())
                        ->where('travel_date', '<=', now()->endOfMonth())),
                Filter::make('created_this_month')
                    ->label('Booked This Month')
                    ->query(fn (Builder $query) => $query->where('created_at', '>=', now()->startOfMonth())),
                Filter::make('high_value')
                    ->label('High Value (₹1L+)')
                    ->query(fn (Builder $query) => $query->where('total_amount', '>=', 100000)),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
