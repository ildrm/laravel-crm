<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InboxResource\Pages;
use App\Models\Inbox;
use Filament\Resources\Resource;

class InboxResource extends Resource
{
    protected static ?string $model = Inbox::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Inbox';
    protected static ?string $navigationGroup = 'Activities';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInboxes::route('/'),
            'create' => Pages\CreateInbox::route('/create'),
            'edit' => Pages\EditInbox::route('/{record}/edit'),
        ];
    }
}
