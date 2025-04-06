<?php

namespace App\Filament\User\Resources\GuestLecturerDetailResource\Pages;

use App\Filament\User\Resources\GuestLecturerDetailResource;
use App\Models\GuestLecturerDetail;
use Filament\Resources\Pages\CreateRecord;

class CreateGuestLecturerDetail extends CreateRecord
{
    protected static string $resource = GuestLecturerDetailResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }

    public function mount(): void
    {
        $user = auth()->user();

        $existing = GuestLecturerDetail::where('user_id', $user->id)->first();

        if ($existing) {
            $this->redirect(GuestLecturerDetailResource::getUrl('edit', ['record' => $existing]));
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
