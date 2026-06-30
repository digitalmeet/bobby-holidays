<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Booking')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Booking Details')
                            ->icon('heroicon-o-ticket')
                            ->schema([
                                Section::make('Reference')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        Placeholder::make('booking_ref_display')
                                            ->label('Booking Reference')
                                            ->content(fn ($record) => $record?->booking_ref ?? 'Auto-generated on save')
                                            ->visibleOn('edit'),
                                        Select::make('status')
                                            ->options([
                                                'confirmed' => 'Confirmed',
                                                'partial_paid' => 'Partial Paid',
                                                'fully_paid' => 'Fully Paid',
                                                'completed' => 'Completed',
                                                'cancelled' => 'Cancelled',
                                                'refunded' => 'Refunded',
                                            ])
                                            ->default('confirmed')
                                            ->required(),
                                        Select::make('assigned_to')
                                            ->label('Assigned To')
                                            ->options(fn () => User::whereHas('roles', function ($q) {
                                                $q->whereIn('name', ['super_admin', 'operations', 'sales']);
                                            })->pluck('name', 'id'))
                                            ->searchable()
                                            ->placeholder('Unassigned'),
                                    ]),

                                Section::make('Client Information')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        TextInput::make('client_name')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('client_phone')
                                            ->tel()
                                            ->maxLength(20),
                                        TextInput::make('client_email')
                                            ->email()
                                            ->maxLength(255),
                                        Select::make('tour_id')
                                            ->label('Tour')
                                            ->relationship('tour', 'title')
                                            ->searchable()
                                            ->preload()
                                            ->placeholder('No specific tour'),
                                    ]),

                                Section::make('Travel Dates & Pax')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        DatePicker::make('travel_date'),
                                        DatePicker::make('return_date'),
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
                                    ]),

                                Section::make('Linked Records')
                                    ->columns(2)
                                    ->collapsed()
                                    ->schema([
                                        Select::make('quotation_id')
                                            ->label('From Quotation')
                                            ->relationship('quotation', 'title')
                                            ->searchable()
                                            ->placeholder('None'),
                                        Select::make('enquiry_id')
                                            ->label('From Enquiry')
                                            ->relationship('enquiry', 'name')
                                            ->searchable()
                                            ->placeholder('None'),
                                    ]),
                            ]),

                        Tab::make('Financials')
                            ->icon('heroicon-o-currency-rupee')
                            ->schema([
                                Section::make('Amounts')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        TextInput::make('total_amount')
                                            ->label('Total Amount (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('paid_amount')
                                            ->label('Paid Amount (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0)
                                            ->disabled()
                                            ->dehydrated()
                                            ->helperText('Auto-calculated from payments.'),
                                        TextInput::make('balance_amount')
                                            ->label('Balance (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0)
                                            ->disabled()
                                            ->dehydrated()
                                            ->helperText('Auto-calculated.'),
                                        TextInput::make('currency')
                                            ->default('INR')
                                            ->maxLength(3)
                                            ->required(),
                                    ]),

                                Section::make('GST Details')
                                    ->columns(2)
                                    ->collapsed()
                                    ->schema([
                                        TextInput::make('gst_number')
                                            ->label('GST Number')
                                            ->maxLength(15)
                                            ->placeholder('e.g. 22AAAAA0000A1Z5'),
                                        TextInput::make('gst_amount')
                                            ->label('GST Amount (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0),
                                    ]),
                            ]),

                        Tab::make('Notes & Requests')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                Textarea::make('special_requests')
                                    ->label('Special Requests')
                                    ->rows(4)
                                    ->placeholder('Dietary requirements, room preferences, accessibility needs...')
                                    ->columnSpanFull(),
                                Textarea::make('internal_notes')
                                    ->label('Internal Notes')
                                    ->rows(4)
                                    ->placeholder('Private notes for staff only...')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Cancellation')
                            ->icon('heroicon-o-x-circle')
                            ->visible(fn ($record) => $record && in_array($record->status, ['cancelled', 'refunded']))
                            ->schema([
                                Placeholder::make('cancelled_at_display')
                                    ->label('Cancelled At')
                                    ->content(fn ($record) => $record?->cancelled_at?->format('d M Y, h:i A') ?? '—'),
                                Textarea::make('cancellation_reason')
                                    ->label('Cancellation Reason')
                                    ->rows(3)
                                    ->disabled()
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
