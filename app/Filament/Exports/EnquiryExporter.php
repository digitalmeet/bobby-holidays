<?php

namespace App\Filament\Exports;

use App\Models\Enquiry;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class EnquiryExporter extends Exporter
{
    protected static ?string $model = Enquiry::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('name'),
            ExportColumn::make('phone'),
            ExportColumn::make('email'),
            ExportColumn::make('destination.name')->label('Destination'),
            ExportColumn::make('tour.title')->label('Tour'),
            ExportColumn::make('travel_date'),
            ExportColumn::make('adults'),
            ExportColumn::make('children'),
            ExportColumn::make('budget_range'),
            ExportColumn::make('status'),
            ExportColumn::make('source'),
            ExportColumn::make('assignedTo.name')->label('Assigned To'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Enquiries export completed. ' . number_format($export->successful_rows) . ' rows exported.';
    }
}
