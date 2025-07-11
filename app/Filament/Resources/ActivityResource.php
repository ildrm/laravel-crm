<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Activities';
    protected static ?string $navigationGroup = 'Tasks & Workflow';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('contact_id')
                    ->relationship(
                        name: 'contact',
                        modifyQueryUsing: fn (Builder $query) => $query->select(['id', 'first_name', 'last_name'])->orderBy('first_name'),
                        titleAttribute: fn ($record) => trim($record?->first_name . ' ' . $record?->last_name)
                    )
                    ->searchable(['first_name', 'last_name'])
                    ->preload()
                    ->nullable(),
                
                Select::make('deal_id')
                    ->relationship(
                        name: 'deal',
                        modifyQueryUsing: fn (Builder $query) => $query->select(['id', 'title']),
                        titleAttribute: 'title'
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
    
                Select::make('type')
                    ->options([
                        'task' => 'Task',
                        'call' => 'Call',
                        'event' => 'Event',
                    ])
                    ->required(),
    
                Forms\Components\Textarea::make('description')
                    ->nullable(),
    
                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->nullable(),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contact_id')->label('Contact ID'),
                Tables\Columns\TextColumn::make('type')->label('Type'),
                Tables\Columns\TextColumn::make('scheduled_at')->label('Scheduled At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
