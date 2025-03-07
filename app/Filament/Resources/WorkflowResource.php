<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowResource\Pages;
use App\Models\Workflow;
use Filament\Resources\Resource;

class WorkflowResource extends Resource
{
    protected static ?string $model = Workflow::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflows::route('/'),
            'create' => Pages\CreateWorkflow::route('/create'),
            'edit' => Pages\EditWorkflow::route('/{record}/edit'),
        ];
    }
}
