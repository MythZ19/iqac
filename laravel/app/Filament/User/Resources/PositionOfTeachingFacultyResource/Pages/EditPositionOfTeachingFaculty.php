<?php

namespace App\Filament\User\Resources\PositionOfTeachingFacultyResource\Pages;

use App\Filament\User\Resources\PositionOfTeachingFacultyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositionOfTeachingFaculty extends EditRecord
{
    protected static string $resource = PositionOfTeachingFacultyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
