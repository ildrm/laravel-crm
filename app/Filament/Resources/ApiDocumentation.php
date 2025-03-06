<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use App\Models\ApiDocumentation; // Add the model import
use App\Filament\Resources\ApiDocumentationResource\Pages; // Add pages import

class ApiDocumentationResource extends Resource
{
    protected static ?string $model = ApiDocumentation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'API Documentation';
    protected static ?string $navigationGroup = 'Documentation';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApiDocumentations::route('/'),
        ];
    }
}
