<?php

namespace App\Filament\Resources\Quotations\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuotationItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Quotation Items';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'accommodation' => '🏨 Accommodation',
                        'flight' => '✈️ Flight',
                        'transfer' => '🚗 Transfer',
                        'activity' => '🎯 Activity',
                        'meal' => '🍽️ Meal',
                        'visa' => '📋 Visa',
                        'insurance' => '🛡️ Insurance',
                        'other' => '📦 Other',
                    ])
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. Hotel Taj Palace — Deluxe Room')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->rows(2)
                    ->placeholder('Additional details...')
                    ->columnSpanFull(),
                TextInput::make('nights')
                    ->label('Nights')
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('For accommodation items'),
                TextInput::make('unit_cost')
                    ->label('Unit Cost (₹)')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->minValue(0)
                    ->default(0)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                        $set('total_cost', round((float) $state * (float) $get('quantity'), 2))),
                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(0.01)
                    ->default(1)
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                        $set('total_cost', round((float) $get('unit_cost') * (float) $state, 2))),
                TextInput::make('total_cost')
                    ->label('Total (₹)')
                    ->numeric()
                    ->prefix('₹')
                    ->default(0)
                    ->disabled()
                    ->dehydrated(),
                Select::make('section_id')
                    ->label('Section')
                    ->relationship('section', 'title')
                    ->placeholder('No section (ungrouped)')
                    ->createOptionForm([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(2),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
                Toggle::make('is_included_in_total')
                    ->label('Include in Total')
                    ->default(true)
                    ->helperText('Uncheck for informational items.'),
                Toggle::make('is_optional')
                    ->label('Optional Item')
                    ->default(false)
                    ->helperText('Client can choose to exclude.'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'accommodation' => '🏨 Hotel',
                        'flight' => '✈️ Flight',
                        'transfer' => '🚗 Transfer',
                        'activity' => '🎯 Activity',
                        'meal' => '🍽️ Meal',
                        'visa' => '📋 Visa',
                        'insurance' => '🛡️ Insurance',
                        'other' => '📦 Other',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'accommodation' => 'info',
                        'flight' => 'warning',
                        'transfer' => 'success',
                        'activity' => 'primary',
                        'meal' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40)
                    ->description(fn ($record) => $record->nights ? "{$record->nights} night(s)" : null),
                TextColumn::make('unit_cost')
                    ->money('INR')
                    ->label('Unit'),
                TextColumn::make('quantity')
                    ->label('Qty'),
                TextColumn::make('total_cost')
                    ->money('INR')
                    ->label('Total')
                    ->weight('bold'),
                IconColumn::make('is_included_in_total')
                    ->label('Incl.')
                    ->boolean(),
                IconColumn::make('is_optional')
                    ->label('Opt.')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Item'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
