<?php

namespace App\Filament\Resources\Destinations\Schemas;

use App\Models\Destination;
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
use Illuminate\Support\Str;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Destination')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Details')
                            ->icon('heroicon-o-information-circle')
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from name.'),
                                Select::make('country')
                                    ->options(fn () => collect(array_unique(array_filter(array_merge(
                                        ['India', 'United Arab Emirates', 'Indonesia', 'Maldives', 'Singapore', 'Thailand', 'Sri Lanka', 'Vietnam', 'United Kingdom', 'United States'],
                                        Destination::query()->whereNotNull('country')->pluck('country')->all(),
                                    ))))->mapWithKeys(fn (string $country) => [$country => $country])->all())
                                    ->searchable()
                                    ->live()
                                    ->placeholder('Select country'),
                                Select::make('state')
                                    ->options(fn (callable $get) => static::statesFor($get('country')))
                                    ->searchable()
                                    ->live()
                                    ->placeholder('Select or search state'),
                                Select::make('city')
                                    ->options(fn (callable $get) => static::citiesFor($get('country'), $get('state')))
                                    ->searchable()
                                    ->placeholder('Select or search city'),
                                Select::make('continent')
                                    ->options([
                                        'Domestic' => 'Domestic',
                                        'Asia' => 'Asia',
                                        'Europe' => 'Europe',
                                        'Africa' => 'Africa',
                                        'Americas' => 'Americas',
                                        'Oceania' => 'Oceania',
                                        'Middle East' => 'Middle East',
                                    ]),
                                Textarea::make('short_description')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                RichEditor::make('description')
                                    ->columnSpanFull()
                                    ->extraAttributes(['style' => 'min-height: 300px']),
                                Repeater::make('highlights')
                                    ->schema([
                                        TextInput::make('highlight')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['highlight'] ?? null)
                                    ->defaultItems(0)
                                    ->collapsible()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('hero_image')
                                    ->image()
                                    ->directory('destinations/hero')
                                    ->maxSize(2048)
                                    ->columnSpanFull(),
                                FileUpload::make('gallery')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->directory('destinations/gallery')
                                    ->maxSize(2048)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->columns(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(70)
                                    ->helperText('Max 70 characters.'),
                                FileUpload::make('og_image')
                                    ->label('OG Image')
                                    ->image()
                                    ->directory('destinations/seo'),
                                Textarea::make('meta_description')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->helperText('Max 160 characters.')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Publishing')
                            ->icon('heroicon-o-eye')
                            ->columns(2)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                                Toggle::make('is_featured')
                                    ->label('Featured')
                                    ->default(false),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    private const LOCATION_DATA = [
        'India' => [
            'Gujarat' => ['Ahmedabad', 'Vadodara', 'Surat'],
            'Goa' => ['Panaji', 'Calangute', 'Margao'],
            'Himachal Pradesh' => ['Shimla', 'Manali', 'Dharamshala'],
            'Jammu and Kashmir' => ['Srinagar', 'Gulmarg', 'Pahalgam'],
            'Kerala' => ['Kochi', 'Munnar', 'Alleppey'],
            'Rajasthan' => ['Jaipur', 'Udaipur', 'Jaisalmer'],
        ],
        'United Arab Emirates' => ['Dubai' => ['Dubai'], 'Abu Dhabi' => ['Abu Dhabi']],
        'Indonesia' => ['Bali' => ['Denpasar', 'Ubud', 'Kuta']],
        'Maldives' => ['Kaafu Atoll' => ['Malé']],
        'Singapore' => ['Singapore' => ['Singapore']],
        'Thailand' => ['Bangkok' => ['Bangkok'], 'Phuket' => ['Phuket']],
    ];

    private static function statesFor(?string $country): array
    {
        $stored = Destination::query()->where('country', $country)->whereNotNull('state')->pluck('state')->all();
        $states = array_unique(array_merge(array_keys(self::LOCATION_DATA[$country] ?? []), $stored));

        return collect($states)->sort()->mapWithKeys(fn (string $state) => [$state => $state])->all();
    }

    private static function citiesFor(?string $country, ?string $state): array
    {
        $stored = Destination::query()->where('country', $country)->when($state, fn ($query) => $query->where('state', $state))->whereNotNull('city')->pluck('city')->all();
        $cities = array_unique(array_merge(self::LOCATION_DATA[$country][$state] ?? [], $stored));

        return collect($cities)->sort()->mapWithKeys(fn (string $city) => [$city => $city])->all();
    }
}
