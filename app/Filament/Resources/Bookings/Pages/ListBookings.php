<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Exports\BookingExporter;
use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(BookingExporter::class)->label('Export'),
            CreateAction::make(),
        ];
    }
}
