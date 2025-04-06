<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestLecturerDetailResource\Pages;
use App\Filament\Resources\GuestLecturerDetailResource\RelationManagers;
use App\Models\GuestLecturerDetail;
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

class GuestLecturerDetailResource extends Resource
{
    protected static ?string $model = GuestLecturerDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('name')->required(),
                TextInput::make('research_degrees')->nullable(),
                TextInput::make('subject_specialization')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('research_degrees'),
                TextColumn::make('subject_specialization'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGuestLecturerDetails::route('/'),
        ];
    }
}
