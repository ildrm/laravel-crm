<?php

namespace App\Filament\Resources;

use App\Filament\Pages\ListActivityReports;
use App\Filament\Resources\ActivityReportResource\Pages; // Correct import for activity report pages
use App\Filament\Resources\ActivityReportResource\Pages\CreateActivityReport;

use App\Filament\Resources\ActivityReportResource\Pages\EditActivityReport;
use App\Models\ActivityReport; // Assuming an ActivityReport model exists
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ActivityReportResource extends Resource
{
    protected static ?string $model = ActivityReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Reports & Analytics';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Define the form fields for the Activity Report
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Define the columns for the Activity Report table
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityReports::route('/'),
            'create' => CreateActivityReport::route('/create'),
            'edit' => EditActivityReport::route('/{record}/edit'),
        ];
    }
}
