<?php

namespace App\Filament\Resources\Bookings\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TravellersRelationManager extends RelationManager
{
    protected static string $relationship = 'travellers';

    protected static ?string $title = 'Travellers';

    protected static ?string $recordTitleAttribute = 'first_name';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'adult' => 'Adult',
                        'child' => 'Child',
                        'infant' => 'Infant',
                    ])
                    ->required(),
                Select::make('title')
                    ->options([
                        'Mr' => 'Mr',
                        'Mrs' => 'Mrs',
                        'Ms' => 'Ms',
                        'Master' => 'Master',
                        'Miss' => 'Miss',
                    ]),
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),
                DatePicker::make('date_of_birth')
                    ->label('Date of Birth'),
                TextInput::make('nationality')
                    ->maxLength(100),
                TextInput::make('passport_number')
                    ->label('Passport Number')
                    ->maxLength(20),
                DatePicker::make('passport_expiry')
                    ->label('Passport Expiry'),
                Textarea::make('notes')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'adult' => 'primary',
                        'child' => 'warning',
                        'infant' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('title'),
                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($record) => "{$record->first_name} {$record->last_name}")
                    ->searchable(),
                TextColumn::make('date_of_birth')
                    ->label('DOB')
                    ->date('d M Y')
                    ->placeholder('—'),
                TextColumn::make('passport_number')
                    ->label('Passport')
                    ->placeholder('—'),
                TextColumn::make('passport_expiry')
                    ->label('Passport Exp.')
                    ->date('M Y')
                    ->color(fn ($record) => $record->passport_expiry && $record->passport_expiry->diffInMonths(now()) < 6 ? 'danger' : null)
                    ->placeholder('—'),
                TextColumn::make('nationality')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()->label('Add Traveller'),
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
