<?php

namespace App\Filament\Resources\Tours\Schemas;

use App\Models\Destination;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class TourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tour')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic Info')
                            ->icon('heroicon-o-information-circle')
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from title if left empty.'),
                                TextInput::make('subtitle')
                                    ->maxLength(255),
                                Select::make('destination_id')
                                    ->label('Destination')
                                    ->relationship('destination', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Select a destination'),
                                Select::make('category')
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
                                    ])
                                    ->searchable(),
                                Select::make('difficulty_level')
                                    ->options([
                                        'easy' => 'Easy',
                                        'moderate' => 'Moderate',
                                        'challenging' => 'Challenging',
                                        'extreme' => 'Extreme',
                                    ]),
                                TextInput::make('duration_days')
                                    ->label('Duration (Days)')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1),
                                TextInput::make('duration_nights')
                                    ->label('Duration (Nights)')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),
                                TextInput::make('min_group_size')
                                    ->label('Min Group Size')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1),
                                TextInput::make('max_group_size')
                                    ->label('Max Group Size')
                                    ->numeric()
                                    ->minValue(1),
                            ]),

                        Tab::make('Content')
                            ->icon('heroicon-o-document-text')
                            ->columns(2)
                            ->schema([
                                RichEditor::make('overview')
                                    ->columnSpanFull()
                                    ->extraAttributes(['style' => 'min-height: 300px']),
                                Repeater::make('highlights')
                                    ->schema([
                                        TextInput::make('text')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('e.g. Sunset cruise on Dal Lake'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->columnSpanFull(),
                                Repeater::make('inclusions')
                                    ->schema([
                                        TextInput::make('text')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('e.g. Airport transfers'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->columnSpanFull(),
                                Repeater::make('exclusions')
                                    ->schema([
                                        TextInput::make('text')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('e.g. Airfare'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Itinerary')
                            ->icon('heroicon-o-map')
                            ->schema([
                                Repeater::make('itinerary')
                                    ->schema([
                                        TextInput::make('day')
                                            ->label('Day')
                                            ->required()
                                            ->numeric()
                                            ->minValue(1),
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('e.g. Arrival & Sightseeing'),
                                        Textarea::make('description')
                                            ->rows(3)
                                            ->placeholder('Day-wise details...'),
                                        TextInput::make('meals')
                                            ->placeholder('e.g. Breakfast, Dinner'),
                                        TextInput::make('accommodation')
                                            ->placeholder('e.g. Hotel Grand Palace'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => isset($state['day'], $state['title']) ? "Day {$state['day']}: {$state['title']}" : null)
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->orderColumn('day')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Pricing')
                            ->icon('heroicon-o-currency-rupee')
                            ->columns(2)
                            ->schema([
                                TextInput::make('starting_price')
                                    ->label('Starting Price (₹)')
                                    ->numeric()
                                    ->prefix('₹')
                                    ->helperText('Display price on listing page. Detailed pricing managed in Pricing tab below.'),
                                Select::make('price_type')
                                    ->options([
                                        'per_person' => 'Per Person',
                                        'per_couple' => 'Per Couple',
                                        'per_group' => 'Per Group',
                                        'custom' => 'Custom / On Request',
                                    ])
                                    ->default('per_person')
                                    ->required(),
                            ]),

                        Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('hero_image')
                                    ->label('Hero Image')
                                    ->image()
                                    ->directory('tours/hero')
                                    ->maxSize(2048)
                                    ->columnSpanFull(),
                                FileUpload::make('gallery')
                                    ->label('Gallery Images')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->directory('tours/gallery')
                                    ->maxSize(2048)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->columns(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(70)
                                    ->helperText('Max 70 characters for search engines.'),
                                Textarea::make('meta_description')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->helperText('Max 160 characters for search engines.')
                                    ->columnSpanFull(),
                                FileUpload::make('og_image')
                                    ->label('OG Image (Social Share)')
                                    ->image()
                                    ->directory('tours/seo')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Publishing')
                            ->icon('heroicon-o-eye')
                            ->columns(2)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->helperText('Inactive tours are hidden from the website.'),
                                Toggle::make('is_featured')
                                    ->label('Featured')
                                    ->default(false)
                                    ->helperText('Featured tours appear on the homepage.'),
                                DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->helperText('Leave empty to save as draft. Set future date for scheduled publishing.'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower numbers appear first.'),
                            ]),
                    ]),
            ]);
    }
}
