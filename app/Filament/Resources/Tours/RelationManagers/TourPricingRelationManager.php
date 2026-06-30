<?php

namespace App\Filament\Resources\Tours\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TourPricingRelationManager extends RelationManager
{
    protected static string $relationship = 'pricing';

    protected static ?string $title = 'Pricing';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. Peak Season, Off Season, Early Bird')
                    ->columnSpanFull(),
                TextInput::make('price_per_person')
                    ->label('Price Per Person (₹)')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->minValue(0),
                TextInput::make('child_price')
                    ->label('Child Price (₹)')
                    ->numeric()
                    ->prefix('₹')
                    ->minValue(0)
                    ->placeholder('Optional'),
                TextInput::make('infant_price')
                    ->label('Infant Price (₹)')
                    ->numeric()
                    ->prefix('₹')
                    ->minValue(0)
                    ->placeholder('Optional'),
                TextInput::make('currency')
                    ->default('INR')
                    ->maxLength(3)
                    ->required(),
                DatePicker::make('valid_from')
                    ->label('Valid From'),
                DatePicker::make('valid_until')
                    ->label('Valid Until'),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
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
                TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price_per_person')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('child_price')
                    ->money('INR')
                    ->placeholder('—'),
                TextColumn::make('infant_price')
                    ->money('INR')
                    ->placeholder('—'),
                TextColumn::make('valid_from')
                    ->date()
                    ->placeholder('Always'),
                TextColumn::make('valid_until')
                    ->date()
                    ->placeholder('No expiry'),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make(),
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
