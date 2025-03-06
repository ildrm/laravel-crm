<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ActivityReportResource;
use Filament\Resources\Pages\ListRecords; // Correct import for listing records

class ListActivityReports extends ListRecords
{
    protected static string $resource = ActivityReportResource::class;
}
