<?php

namespace App\Filament\User\Resources\DepartmentStaffResource\Pages;

use App\Filament\User\Resources\DepartmentStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentStaff extends EditRecord
{
    protected static string $resource = DepartmentStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
