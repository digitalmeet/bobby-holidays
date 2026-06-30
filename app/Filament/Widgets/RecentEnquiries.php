<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Models\Enquiry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentEnquiries extends TableWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Latest Enquiries';

    protected int|string|array $columnSpan = 1;

    protected static bool $isLazy = true;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Enquiry::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->description(fn (Enquiry $record) => $record->phone),
                TextColumn::make('source')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'quoted' => 'info',
                        'converted' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ])
            ->recordUrl(fn (Enquiry $record) => EnquiryResource::getUrl('edit', ['record' => $record]))
            ->emptyStateHeading('No enquiries yet');
    }
}
