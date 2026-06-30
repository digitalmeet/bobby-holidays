<?php

namespace App\Filament\Resources\Enquiries\Tables;

use App\Filament\Resources\Quotations\QuotationResource;
use App\Models\Enquiry;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
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
use Illuminate\Database\Eloquent\Collection;

class EnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Enquiry $record) => $record->phone),
                TextColumn::make('destination.name')
                    ->label('Destination')
                    ->placeholder('—')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('tour.title')
                    ->label('Tour')
                    ->placeholder('—')
                    ->limit(25)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('travel_date')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('Flexible'),
                TextColumn::make('adults')
                    ->label('Pax')
                    ->formatStateUsing(fn (Enquiry $record) => "{$record->adults}A" .
                        ($record->children ? " {$record->children}C" : '') .
                        ($record->infants ? " {$record->infants}I" : ''))
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'quoted' => 'info',
                        'converted' => 'success',
                        'lost' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('source')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('assignedTo.name')
                    ->label('Assigned')
                    ->placeholder('Unassigned')
                    ->toggleable(),
                TextColumn::make('follow_up_at')
                    ->label('Follow-up')
                    ->dateTime('d M, h:i A')
                    ->sortable()
                    ->color(fn (Enquiry $record) => $record->follow_up_at && $record->follow_up_at->isPast() ? 'danger' : null)
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'quoted' => 'Quoted',
                        'converted' => 'Converted',
                        'lost' => 'Lost',
                    ]),
                SelectFilter::make('source')
                    ->options([
                        'website' => 'Website',
                        'whatsapp' => 'WhatsApp',
                        'referral' => 'Referral',
                        'walkin' => 'Walk-in',
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                    ]),
                SelectFilter::make('assigned_to')
                    ->label('Assigned To')
                    ->relationship('assignedTo', 'name'),
                SelectFilter::make('destination_id')
                    ->label('Destination')
                    ->relationship('destination', 'name'),
                Filter::make('follow_ups_due')
                    ->label('Follow-ups Overdue')
                    ->query(fn (Builder $query) => $query->followUpsDue()),
                Filter::make('unassigned')
                    ->label('Unassigned Only')
                    ->query(fn (Builder $query) => $query->whereNull('assigned_to')),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('whatsapp')
                    ->label('WA')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(fn (Enquiry $record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->phone))
                    ->openUrlInNewTab(),
                Action::make('convert_to_quotation')
                    ->label('Quote')
                    ->icon('heroicon-o-document-currency-rupee')
                    ->color('info')
                    ->visible(fn (Enquiry $record) => in_array($record->status, ['new', 'contacted', 'quoted']))
                    ->url(fn (Enquiry $record) => QuotationResource::getUrl('create', ['enquiry_id' => $record->id])),
                Action::make('mark_contacted')
                    ->label('Contacted')
                    ->icon('heroicon-o-phone')
                    ->color('warning')
                    ->visible(fn (Enquiry $record) => $record->status === 'new')
                    ->requiresConfirmation()
                    ->action(function (Enquiry $record) {
                        $record->update([
                            'status' => 'contacted',
                            'last_contacted_at' => now(),
                        ]);
                    }),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_lost')
                        ->label('Mark as Lost')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'lost'])),
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
