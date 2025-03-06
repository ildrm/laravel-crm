<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Models\Form;
use App\Models\FormField;
use Filament\Forms;
use Filament\Forms\Form as FilamentForm;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $navigationIcon = 'heroicon-c-table-cells';
    protected static ?string $navigationGroup = 'Communication';

    public static function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(Form::class, 'name'),
                
                Forms\Components\Builder::make('fields')
                    ->blocks([
                        Forms\Components\Builder\Block::make('text')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\TextInput::make('maxLength')->numeric(),
                                Forms\Components\TextInput::make('placeholder'),
                            ]),
                        
                        Forms\Components\Builder\Block::make('number')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\TextInput::make('minValue')->numeric(),
                                Forms\Components\TextInput::make('maxValue')->numeric(),
                            ]),
                            
                        Forms\Components\Builder\Block::make('select')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\KeyValue::make('options')->required(),
                                Forms\Components\Toggle::make('multiple'),
                            ]),
                            
                        Forms\Components\Builder\Block::make('checkbox')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                            ]),
                            
                        Forms\Components\Builder\Block::make('radio')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\KeyValue::make('options')->required(),
                            ]),
                            
                        Forms\Components\Builder\Block::make('textarea')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\TextInput::make('rows')->numeric(),
                            ]),
                            
                        Forms\Components\Builder\Block::make('datetime')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\Toggle::make('enableTime'),
                            ]),
                            
                        Forms\Components\Builder\Block::make('file')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\TextInput::make('maxSize')->numeric(),
                                Forms\Components\TagsInput::make('acceptedFileTypes'),
                            ]),
                            
                        Forms\Components\Builder\Block::make('richtext')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                                Forms\Components\Toggle::make('enableToolbar'),
                            ]),
                            
                        Forms\Components\Builder\Block::make('markdown')
                            ->schema([
                                Forms\Components\TextInput::make('label')->required(),
                            ]),
                    ])
                    ->reorderable()
                    ->collapsible()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
