<?php

namespace App\Filament\Resources;

use App\Models\Role; // Import the Role model
use Filament\Resources\Resource;
use App\Filament\Resources\RoleResource\Pages;

class RoleResource extends Resource

{
    protected static ?string $model = Role::class; // Allow null value
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'User & Access Management';

    protected static ?string $navigationLabel = 'Roles'; // Allow null value

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }


}
