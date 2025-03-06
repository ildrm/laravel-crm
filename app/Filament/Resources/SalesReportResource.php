<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesReportResource\Pages;
use App\Models\SalesReport; // Assuming a SalesReport model exists
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SalesReportResource extends Resource
{
    protected static ?string $model = SalesReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Reports & Analytics';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Define the form fields for the Sales Report
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Define the columns for the Sales Report table
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesReports::route('/'),
            'create' => Pages\CreateSalesReport::route('/create'),
            'edit' => Pages\EditSalesReport::route('/{record}/edit'),
        ];
    }
}
