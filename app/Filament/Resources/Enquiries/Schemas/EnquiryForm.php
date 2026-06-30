<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Details')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->compact()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('country')
                            ->maxLength(100),
                    ]),

                Section::make('Travel Requirements')
                    ->icon('heroicon-o-map')
                    ->columns(2)
                    ->compact()
                    ->schema([
                        Select::make('destination_id')
                            ->label('Destination')
                            ->relationship('destination', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Any destination'),
                        Select::make('tour_id')
                            ->label('Interested Tour')
                            ->relationship('tour', 'title')
                            ->searchable()
                            ->preload()
                            ->placeholder('No specific tour'),
                        DatePicker::make('travel_date')
                            ->label('Preferred Travel Date'),
                        Toggle::make('flexible_dates')
                            ->label('Flexible with dates'),
                        TextInput::make('duration_days')
                            ->label('Duration (Days)')
                            ->numeric()
                            ->minValue(1),
                        TextInput::make('budget_range')
                            ->placeholder('e.g. 50,000 - 1,00,000'),
                        TextInput::make('adults')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),
                        TextInput::make('children')
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                        TextInput::make('infants')
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                        Textarea::make('message')
                            ->label('Message / Requirements')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Assignment')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->columns(2)
                    ->compact()
                    ->schema([
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'quoted' => 'Quoted',
                                'converted' => 'Converted',
                                'lost' => 'Lost',
                            ])
                            ->default('new')
                            ->required(),
                        Select::make('source')
                            ->options([
                                'website' => 'Website',
                                'whatsapp' => 'WhatsApp',
                                'referral' => 'Referral',
                                'walkin' => 'Walk-in',
                                'instagram' => 'Instagram',
                                'facebook' => 'Facebook',
                            ])
                            ->default('website')
                            ->required(),
                        Select::make('assigned_to')
                            ->label('Assigned To')
                            ->options(fn () => User::whereHas('roles', function ($q) {
                                $q->whereIn('name', ['super_admin', 'sales']);
                            })->pluck('name', 'id'))
                            ->searchable()
                            ->placeholder('Unassigned'),
                        DateTimePicker::make('follow_up_at')
                            ->label('Follow-up Date'),
                        DateTimePicker::make('last_contacted_at')
                            ->label('Last Contacted'),
                    ]),

                Section::make('Internal Notes')
                    ->icon('heroicon-o-lock-closed')
                    ->collapsed()
                    ->schema([
                        Textarea::make('internal_notes')
                            ->label('')
                            ->rows(4)
                            ->placeholder('Private notes visible only to staff...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Tracking Info')
                    ->icon('heroicon-o-signal')
                    ->collapsed()
                    ->columns(2)
                    ->visibleOn('edit')
                    ->schema([
                        Placeholder::make('ip_address_display')
                            ->label('IP Address')
                            ->content(fn ($record) => $record?->ip_address ?? '—'),
                        Placeholder::make('user_agent_display')
                            ->label('User Agent')
                            ->content(fn ($record) => $record?->user_agent ? str($record->user_agent)->limit(80) : '—'),
                        Placeholder::make('created_at_display')
                            ->label('Submitted At')
                            ->content(fn ($record) => $record?->created_at?->format('d M Y, h:i A') ?? '—'),
                    ]),
            ]);
    }
}
