<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Annex2Resource\Pages;
use App\Filament\Resources\Annex2Resource\RelationManagers;
use App\Models\Annex2;
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

class Annex2Resource extends Resource
{
    protected static ?string $model = Annex2::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Annex 2';

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

                TextInput::make('title_of_paper')->required(),
                TextInput::make('author_names')->required(),
                TextInput::make('department')->required(),
                TextInput::make('journal_name')->required(),
                TextInput::make('year_of_publication')->numeric()->required(),
                TextInput::make('issn_number')->required(),
                TextInput::make('ugc_recognition_link')->required()->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('title_of_paper')->searchable(),
                TextColumn::make('author_names')->label('Authors'),
                TextColumn::make('journal_name'),
                TextColumn::make('year_of_publication'),
            ])
            ->defaultSort('year_of_publication', 'desc')
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
            'index' => Pages\ManageAnnex2s::route('/'),
        ];
    }
}
