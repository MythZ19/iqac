<?php

namespace App\Filament\Resources\SchoolDepartmentDetailResource\Pages;

use App\Filament\Resources\SchoolDepartmentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSchoolDepartmentDetails extends ManageRecords
{
    protected static string $resource = SchoolDepartmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
