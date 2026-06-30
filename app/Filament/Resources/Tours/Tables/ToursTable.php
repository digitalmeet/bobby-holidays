<?php

namespace App\Filament\Resources\Tours\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ToursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('hero_image')
                    ->label('')
                    ->circular()
                    ->size(40),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->description(fn ($record) => $record->destination?->name),
                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'honeymoon' => 'danger',
                        'family' => 'success',
                        'adventure' => 'warning',
                        'pilgrimage' => 'info',
                        'corporate' => 'gray',
                        'luxury' => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),
                TextColumn::make('duration_days')
                    ->label('Duration')
                    ->formatStateUsing(fn ($record) => "{$record->duration_days}D / {$record->duration_nights}N")
                    ->sortable(),
                TextColumn::make('starting_price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('published_at')
                    ->label('Published')
                    ->date()
                    ->sortable()
                    ->placeholder('Draft')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('destination_id')
                    ->label('Destination')
                    ->relationship('destination', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('category')
                    ->options([
                        'honeymoon' => 'Honeymoon',
                        'family' => 'Family',
                        'adventure' => 'Adventure',
                        'pilgrimage' => 'Pilgrimage',
                        'corporate' => 'Corporate',
                        'luxury' => 'Luxury',
                        'budget' => 'Budget',
                        'group' => 'Group Tour',
                        'solo' => 'Solo Travel',
                        'weekend' => 'Weekend Getaway',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active'),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
                Filter::make('published')
                    ->label('Published Only')
                    ->query(fn (Builder $query) => $query->whereNotNull('published_at')->where('published_at', '<=', now())),
                Filter::make('draft')
                    ->label('Drafts Only')
                    ->query(fn (Builder $query) => $query->whereNull('published_at')),
                Filter::make('price_above_50k')
                    ->label('Price ₹50,000+')
                    ->query(fn (Builder $query) => $query->where('starting_price', '>=', 50000)),
                Filter::make('price_below_25k')
                    ->label('Price Below ₹25,000')
                    ->query(fn (Builder $query) => $query->where('starting_price', '<', 25000)->whereNotNull('starting_price')),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                ReplicateAction::make()
                    ->excludeAttributes(['slug', 'published_at'])
                    ->beforeReplicaSaved(function ($replica) {
                        $replica->title = $replica->title . ' (Copy)';
                        $replica->is_active = false;
                        $replica->is_featured = false;
                    }),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
