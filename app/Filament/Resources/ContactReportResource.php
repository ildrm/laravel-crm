<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactReportResource\Pages;
use App\Models\ContactReport; // Assuming a ContactReport model exists
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactReportResource extends Resource
{
    protected static ?string $model = ContactReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Reports & Analytics';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Define the form fields for the Contact Report
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Define the columns for the Contact Report table
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactReports::route('/'),
            'create' => Pages\CreateContactReport::route('/create'),
            'edit' => Pages\EditContactReport::route('/{record}/edit'),
        ];
    }
}
