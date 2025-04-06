<?php

namespace App\Filament\User\Resources\PositionOfTeachingFacultyResource\Pages;

use App\Filament\User\Resources\PositionOfTeachingFacultyResource;
use App\Models\PositionOfTeachingFaculty;
use Filament\Resources\Pages\CreateRecord;

class CreatePositionOfTeachingFaculty extends CreateRecord
{
    protected static string $resource = PositionOfTeachingFacultyResource::class;

    protected static ?string $title = 'Position of Teaching Faculty';

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }

    public function mount(): void
    {
        $user = auth()->user();

        $existing = PositionOfTeachingFaculty::where('user_id', $user->id)->first();

        if ($existing) {
            $this->redirect(PositionOfTeachingFacultyResource::getUrl('edit', ['record' => $existing]));
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
