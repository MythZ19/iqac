<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\GuestLecturerDetailResource\Pages;
use App\Models\GuestLecturerDetail;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class GuestLecturerDetailResource extends Resource
{
    protected static ?string $model = GuestLecturerDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('research_degrees')->nullable(),
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
            'index' => Pages\CreateGuestLecturerDetail::route('/'),
            'edit' => Pages\EditGuestLecturerDetail::route('/{record}/edit'),
        ];
    }
}
