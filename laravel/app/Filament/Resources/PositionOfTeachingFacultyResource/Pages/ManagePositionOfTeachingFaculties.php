<?php

namespace App\Filament\Resources\PositionOfTeachingFacultyResource\Pages;

use App\Filament\Resources\PositionOfTeachingFacultyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePositionOfTeachingFaculties extends ManageRecords
{
    protected static string $resource = PositionOfTeachingFacultyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
