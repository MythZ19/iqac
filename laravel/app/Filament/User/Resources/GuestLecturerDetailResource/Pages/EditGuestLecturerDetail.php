<?php

namespace App\Filament\User\Resources\GuestLecturerDetailResource\Pages;

use App\Filament\User\Resources\GuestLecturerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuestLecturerDetail extends EditRecord
{
    protected static string $resource = GuestLecturerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
