<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Education';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('institution')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('degree')
                            ->required()
                            ->placeholder('e.g. Bachelor / Associate')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('major')
                            ->required()
                            ->placeholder('e.g. Computer Science')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('start_date')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->disabled(fn (Forms\Get $get) => $get('is_current'))
                            ->dehydrated(fn (Forms\Get $get) => !$get('is_current')),
                        Forms\Components\Toggle::make('is_current')
                            ->label('I am currently studying here')
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $state ? $set('end_date', null) : null),
                        Forms\Components\RichEditor::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('institution')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('degree')
                    ->searchable(),
                Tables\Columns\TextColumn::make('major')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->placeholder('Present')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_current')
                    ->boolean()
                    ->label('Current'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
