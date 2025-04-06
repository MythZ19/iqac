<?php

namespace App\Filament\User\Resources\SchoolDepartmentDetailResource\Pages;

use App\Filament\User\Resources\SchoolDepartmentDetailResource;
use App\Models\SchoolDepartmentDetail;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolDepartmentDetail extends CreateRecord
{
    protected static string $resource = SchoolDepartmentDetailResource::class;

    protected static ?string $title = 'School Details';

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }

    public function mount(): void
    {
        $user = auth()->user();

        $existing = SchoolDepartmentDetail::where('user_id', $user->id)->first();

        if ($existing) {
            $this->redirect(SchoolDepartmentDetailResource::getUrl('edit', ['record' => $existing]));
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
