<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Annex3Resource\Pages;
use App\Filament\Resources\Annex3Resource\RelationManagers;
use App\Models\Annex3;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Annex3Resource extends Resource
{
    protected static ?string $model = Annex3::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Annex 3';

    protected static ?string $navigationGroup = 'Reports';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->default(auth()->user()->id)
                ->required(),

            TextInput::make('name_of_patenter')->required(),
            TextInput::make('patent_number')->required(),
            TextInput::make('title_of_patent')->required(),
            TextInput::make('year')->numeric()->required(),
            Select::make('status')
                ->options([
                    'Award' => 'Award',
                    'Published' => 'Published',
                    'Filed' => 'Filed',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')->label('User')->searchable(),
            TextColumn::make('name_of_patenter'),
            TextColumn::make('patent_number'),
            TextColumn::make('title_of_patent'),
            TextColumn::make('year'),
            TextColumn::make('status'),
        ])
        ->defaultSort('year', 'desc')
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
            'index' => Pages\ManageAnnex3s::route('/'),
        ];
    }
}
