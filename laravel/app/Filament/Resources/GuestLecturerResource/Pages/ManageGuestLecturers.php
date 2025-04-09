<?php

namespace App\Filament\Resources\GuestLecturerResource\Pages;

use App\Filament\Resources\GuestLecturerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGuestLecturers extends ManageRecords
{
    protected static string $resource = GuestLecturerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    if(auth()->user()->isHod()) {
                        $data['user_id'] = auth()->id();
                        $data['department_id'] = auth()->user()->department_id;
                    }
                    return $data;
                }),
        ];
    }
}
