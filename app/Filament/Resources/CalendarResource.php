<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalendarResource\Pages;
use App\Models\Calendar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Tasks & Workflow';
    protected static ?string $navigationLabel = 'Calendar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required(),
            Forms\Components\DateTimePicker::make('start')
                ->label('Start Time')
                ->required(),
            Forms\Components\DateTimePicker::make('end')
                ->label('End Time')
                ->nullable(),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->nullable(),
            Forms\Components\ColorPicker::make('color')
                ->label('Event Color'),
            Forms\Components\Toggle::make('all_day')
                ->label('All Day Event')
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title'),
                Tables\Columns\TextColumn::make('start')->label('Start Time'),
                Tables\Columns\TextColumn::make('end')->label('End Time'),
                Tables\Columns\IconColumn::make('all_day')
                    ->boolean()
                    ->label('All Day'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

// No changes needed, but ensure the getPages() method is correct
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalendars::route('/'),
            'create' => Pages\CreateCalendar::route('/create'),
            'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }


    // New method to render FullCalendar
    public static function renderFullCalendar()
    {
        return Calendar::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start->toIso8601String(),
                'end' => $event->end ? $event->end->toIso8601String() : null,
                'allDay' => $event->all_day,
                'color' => $event->color ?? '#3788d8',
            ];
        });
    }
}
