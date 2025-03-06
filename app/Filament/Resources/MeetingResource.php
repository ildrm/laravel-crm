<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Models\Meeting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Sales & CRM';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('subject')
                ->label('Meeting Subject')
                ->required(),
            Forms\Components\DateTimePicker::make('date_time')
                ->label('Date and Time')
                ->required(),
            Forms\Components\Textarea::make('participants')
                ->label('Participants')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')->label('Meeting Subject'),
                Tables\Columns\TextColumn::make('date_time')->label('Date and Time'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
}
