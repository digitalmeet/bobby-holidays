<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('public_id')
                    ->label('ID')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Public ID copied')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Quotation $record) => $record->client_phone),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(35),
                TextColumn::make('travel_date')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('TBD'),
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'viewed' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'expired' => 'gray',
                        'revised' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('version')
                    ->label('v')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('preparedBy.name')
                    ->label('Prepared By')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('validity_date')
                    ->label('Expires')
                    ->date('d M')
                    ->sortable()
                    ->color(fn (Quotation $record) => $record->validity_date && $record->validity_date->isPast() ? 'danger' : null)
                    ->placeholder('No expiry')
                    ->toggleable(),
                TextColumn::make('view_count')
                    ->label('Views')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'viewed' => 'Viewed',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'expired' => 'Expired',
                        'revised' => 'Revised',
                    ]),
                SelectFilter::make('prepared_by')
                    ->label('Prepared By')
                    ->relationship('preparedBy', 'name'),
                Filter::make('expired')
                    ->label('Expired Quotes')
                    ->query(fn (Builder $query) => $query->whereNotNull('validity_date')->where('validity_date', '<', now())->whereNotIn('status', ['accepted', 'revised'])),
                Filter::make('high_value')
                    ->label('High Value (₹1L+)')
                    ->query(fn (Builder $query) => $query->where('total_amount', '>=', 100000)),
                Filter::make('never_viewed')
                    ->label('Never Viewed')
                    ->query(fn (Builder $query) => $query->where('view_count', 0)->where('status', 'sent')),
                Filter::make('this_month')
                    ->label('Created This Month')
                    ->query(fn (Builder $query) => $query->where('created_at', '>=', now()->startOfMonth())),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('copy_link')
                    ->label('Copy Link')
                    ->icon('heroicon-o-link')
                    ->color('gray')
                    ->action(function (Quotation $record) {
                        Notification::make()
                            ->title('Link copied to clipboard')
                            ->body(url("/quote/{$record->public_id}"))
                            ->success()
                            ->send();
                    }),
                Action::make('mark_sent')
                    ->label('Mark Sent')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->visible(fn (Quotation $record) => $record->status === 'draft')
                    ->requiresConfirmation()
                    ->action(function (Quotation $record) {
                        $record->update([
                            'status' => 'sent',
                            'sent_at' => now(),
                        ]);

                        $record->histories()->create([
                            'changed_by' => auth()->id(),
                            'event' => 'sent',
                            'old_status' => 'draft',
                            'new_status' => 'sent',
                            'created_at' => now(),
                        ]);
                    }),
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
