<?php

namespace App\Filament\User\Resources\SchoolDepartmentDetailResource\Pages;

use App\Filament\User\Resources\SchoolDepartmentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolDepartmentDetail extends EditRecord
{
    protected static string $resource = SchoolDepartmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
