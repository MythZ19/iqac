<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PositionOfTeachingFacultyResource\Pages;
use App\Models\PositionOfTeachingFaculty;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class PositionOfTeachingFacultyResource extends Resource
{
    protected static ?string $model = PositionOfTeachingFaculty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('designation')->nullable(),
                TextInput::make('degree')->nullable(),
                TextInput::make('university_institute')->label('University / Institute')->nullable(),
                TextInput::make('subject_specialization')->nullable(),
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
            'index' => Pages\CreatePositionOfTeachingFaculty::route('/'),
            'edit' => Pages\EditPositionOfTeachingFaculty::route('/{record}/edit'),
        ];
    }
}
