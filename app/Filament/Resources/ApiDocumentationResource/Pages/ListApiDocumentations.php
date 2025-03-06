<?php

namespace App\Filament\Resources\ApiDocumentationResource\Pages;

use App\Filament\Resources\ApiDocumentationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApiDocumentations extends ListRecords
{
    protected static string $resource = ApiDocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
