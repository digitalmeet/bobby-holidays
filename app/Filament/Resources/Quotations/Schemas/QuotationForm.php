<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Enquiry;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Quotation')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Client & Trip')
                            ->icon('heroicon-o-user')
                            ->schema([
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
                                        Select::make('enquiry_id')
                                            ->label('Linked Enquiry')
                                            ->options(fn () => Enquiry::latest()
                                                ->limit(50)
                                                ->get()
                                                ->mapWithKeys(fn ($e) => [$e->id => "{$e->name} — {$e->phone} ({$e->created_at->format('d M')})"]))
                                            ->searchable()
                                            ->placeholder('None'),
                                    ]),

                                Section::make('Trip Details')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('e.g. Kashmir Delight — 5N/6D')
                                            ->columnSpanFull(),
                                        DatePicker::make('travel_date')
                                            ->label('Travel Date'),
                                        DatePicker::make('return_date')
                                            ->label('Return Date'),
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
                            ]),

                        Tab::make('Pricing')
                            ->icon('heroicon-o-currency-rupee')
                            ->schema([
                                Section::make('Amounts')
                                    ->description('These are auto-calculated from items. You can override manually.')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        TextInput::make('subtotal_amount')
                                            ->label('Subtotal (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0),
                                        TextInput::make('discount_amount')
                                            ->label('Discount (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0),
                                        TextInput::make('tax_amount')
                                            ->label('Tax / GST (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0),
                                        TextInput::make('total_amount')
                                            ->label('Total Amount (₹)')
                                            ->numeric()
                                            ->prefix('₹')
                                            ->default(0),
                                        TextInput::make('currency')
                                            ->default('INR')
                                            ->maxLength(3)
                                            ->required(),
                                    ]),
                            ]),

                        Tab::make('Status & Delivery')
                            ->icon('heroicon-o-paper-airplane')
                            ->schema([
                                Section::make('Quotation Status')
                                    ->columns(2)
                                    ->compact()
                                    ->schema([
                                        Select::make('status')
                                            ->options([
                                                'draft' => 'Draft',
                                                'sent' => 'Sent',
                                                'viewed' => 'Viewed',
                                                'accepted' => 'Accepted',
                                                'rejected' => 'Rejected',
                                                'expired' => 'Expired',
                                                'revised' => 'Revised',
                                            ])
                                            ->default('draft')
                                            ->required(),
                                        DatePicker::make('validity_date')
                                            ->label('Valid Until')
                                            ->helperText('Quote expires after this date.'),
                                        Select::make('prepared_by')
                                            ->label('Prepared By')
                                            ->options(fn () => User::whereHas('roles', function ($q) {
                                                $q->whereIn('name', ['super_admin', 'sales']);
                                            })->pluck('name', 'id'))
                                            ->default(fn () => auth()->id())
                                            ->searchable(),
                                        TextInput::make('version')
                                            ->numeric()
                                            ->default(1)
                                            ->disabled()
                                            ->dehydrated(),
                                    ]),

                                Section::make('Public Link')
                                    ->columns(2)
                                    ->compact()
                                    ->visibleOn('edit')
                                    ->schema([
                                        Placeholder::make('public_url')
                                            ->label('Shareable Link')
                                            ->content(fn ($record) => $record ? url("/quote/{$record->public_id}") : '—')
                                            ->columnSpanFull(),
                                        Placeholder::make('view_count_display')
                                            ->label('View Count')
                                            ->content(fn ($record) => $record?->view_count ?? 0),
                                        Placeholder::make('viewed_at_display')
                                            ->label('Last Viewed')
                                            ->content(fn ($record) => $record?->viewed_at?->format('d M Y, h:i A') ?? 'Not yet viewed'),
                                    ]),
                            ]),

                        Tab::make('Message & Terms')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                RichEditor::make('personalised_message')
                                    ->label('Personalised Message')
                                    ->placeholder('Dear [client], thank you for choosing UniWorld Holidays...')
                                    ->helperText('Shown at the top of the quotation.')
                                    ->extraAttributes(['style' => 'min-height: 200px'])
                                    ->columnSpanFull(),
                                RichEditor::make('terms_and_conditions')
                                    ->label('Terms & Conditions')
                                    ->placeholder('Payment terms, cancellation policy, etc.')
                                    ->helperText('Shown at the bottom of the quotation.')
                                    ->extraAttributes(['style' => 'min-height: 250px'])
                                    ->columnSpanFull(),
                                Textarea::make('internal_notes')
                                    ->label('Internal Notes')
                                    ->rows(3)
                                    ->placeholder('Private notes — not visible to client.')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Rejection')
                            ->icon('heroicon-o-x-circle')
                            ->visible(fn ($record) => $record && $record->status === 'rejected')
                            ->schema([
                                Placeholder::make('rejected_at_display')
                                    ->label('Rejected At')
                                    ->content(fn ($record) => $record?->rejected_at?->format('d M Y, h:i A') ?? '—'),
                                Textarea::make('rejection_reason')
                                    ->label('Rejection Reason')
                                    ->rows(3)
                                    ->disabled()
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
