<?php

namespace App\Filament\Resources;

use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\CreateRole;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\EditRole;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\Pages\ListRoles;
use App\Filament\Resources\RolesResource\Pages;
use App\Models\Role;
use Filament\Resources\Resource;

class RolesResource extends Resource

{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $navigationGroup = 'Management';

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }

}
