<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check ';

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
                    ->required(),
    
                Select::make('deal_id')
                    ->relationship(
                        name: 'deal',
                        modifyQueryUsing: fn (Builder $query) => $query->select(['id', 'title']),
                        titleAttribute: 'title'
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
    
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
    
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->columnSpanFull(),
    
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed'
                    ])
                    ->required()
                    ->default('pending'),
    
                Forms\Components\DateTimePicker::make('due_date')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
