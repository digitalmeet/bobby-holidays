<?php

namespace App\Filament\Resources\Enquiries\Pages;

use App\Filament\Exports\EnquiryExporter;
use App\Filament\Resources\Enquiries\EnquiryResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListEnquiries extends ListRecords
{
    protected static string $resource = EnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(EnquiryExporter::class)->label('Export'),
            CreateAction::make(),
        ];
    }
}
