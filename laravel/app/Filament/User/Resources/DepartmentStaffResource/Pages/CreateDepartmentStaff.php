<?php

namespace App\Filament\User\Resources\DepartmentStaffResource\Pages;

use App\Filament\User\Resources\DepartmentStaffResource;
use App\Models\DepartmentStaff;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartmentStaff extends CreateRecord
{
    protected static string $resource = DepartmentStaffResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }

    public function mount(): void
    {
        $user = auth()->user();

        $existing = DepartmentStaff::where('user_id', $user->id)->first();

        if ($existing) {
            $this->redirect(DepartmentStaffResource::getUrl('edit', ['record' => $existing]));
        }

        parent::mount();
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;

        return $data;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
        ];
    }
}
