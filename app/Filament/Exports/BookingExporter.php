<?php

namespace App\Filament\Exports;

use App\Models\Booking;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BookingExporter extends Exporter
{
    protected static ?string $model = Booking::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('booking_ref'),
            ExportColumn::make('client_name'),
            ExportColumn::make('client_phone'),
            ExportColumn::make('client_email'),
            ExportColumn::make('tour.title')->label('Tour'),
            ExportColumn::make('travel_date'),
            ExportColumn::make('return_date'),
            ExportColumn::make('adults'),
            ExportColumn::make('children'),
            ExportColumn::make('total_amount'),
            ExportColumn::make('paid_amount'),
            ExportColumn::make('balance_amount'),
            ExportColumn::make('status'),
            ExportColumn::make('assignedTo.name')->label('Assigned To'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Bookings export completed. ' . number_format($export->successful_rows) . ' rows exported.';
    }
}
