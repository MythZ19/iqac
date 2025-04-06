<?php

namespace App\Filament\Resources\DepartmentStaffResource\Pages;

use App\Filament\Resources\DepartmentStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDepartmentStaff extends ManageRecords
{
    protected static string $resource = DepartmentStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
