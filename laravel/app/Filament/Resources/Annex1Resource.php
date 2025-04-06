<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Annex1Resource\Pages;
use App\Filament\Resources\Annex1Resource\RelationManagers;
use App\Models\Annex1;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Annex1Resource extends Resource
{
    protected static ?string $model = Annex1::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Annex 1';

    protected static ?string $navigationGroup = 'Reports';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->default(auth()->user()->id)
                ->required(),
            TextInput::make('program_name')->required()->maxLength(255),
            TextInput::make('venue')->required()->maxLength(255),
            DatePicker::make('date')->required(),
            TextInput::make('session_type')->required()->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('program_name')->searchable(),
                TextColumn::make('venue')->searchable(),
                TextColumn::make('date')->date(),
                TextColumn::make('session_type')->label('Session Type'),
            ])
            ->defaultSort('date', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAnnex1s::route('/'),
        ];
    }
}
