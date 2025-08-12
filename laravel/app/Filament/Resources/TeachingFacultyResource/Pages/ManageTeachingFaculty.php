<?php

namespace App\Filament\Resources\TeachingFacultyResource\Pages;

use App\Filament\Resources\TeachingFacultyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTeachingFaculty extends ManageRecords
{
    protected static string $resource = TeachingFacultyResource::class;

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
