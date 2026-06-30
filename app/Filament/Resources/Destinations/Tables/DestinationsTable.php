<?php

namespace App\Filament\Resources\Destinations\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DestinationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')
                    ->circular()
                    ->size(50),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('country')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('continent')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active'),
                TernaryFilter::make('is_featured'),
                SelectFilter::make('continent')
                    ->options([
                        'Domestic' => 'Domestic',
                        'Asia' => 'Asia',
                        'Europe' => 'Europe',
                        'Africa' => 'Africa',
                        'Americas' => 'Americas',
                        'Oceania' => 'Oceania',
                        'Middle East' => 'Middle East',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make()
                    ->visible(function (User $user) {
                        return $user->hasRole('super_admin') && $user->can('force_delete_destinations');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make()
                        ->visible(function (User $user) {
                            return $user->hasRole('super_admin') && $user->can('force_delete_destinations');
                        }),
                ]),
            ]);
    }
}