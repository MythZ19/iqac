<?php

namespace App\Filament\Resources\GuestLecturerDetailResource\Pages;

use App\Filament\Resources\GuestLecturerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGuestLecturerDetails extends ManageRecords
{
    protected static string $resource = GuestLecturerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
