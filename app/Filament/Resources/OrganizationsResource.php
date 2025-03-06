<?php

namespace App\Filament\Resources;

use App\Models\Role; // Import the Role model
use Filament\Resources\Resource;
use App\Filament\Resources\OrganizationsResource\Pages;

use Filament\Resources\Pages\Page;

class OrganizationsResource extends Resource

{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Organizations';
    protected static string $view = 'filament.resources.calendar.pages.organizations'; // Update to the new calendar view

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
