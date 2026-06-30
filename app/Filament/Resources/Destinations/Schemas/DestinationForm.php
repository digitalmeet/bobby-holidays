<?php

namespace App\Filament\Resources\Destinations\Schemas;

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
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from name.'),
                                TextInput::make('country')
                                    ->maxLength(255),
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
}
