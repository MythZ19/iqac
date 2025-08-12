<?php

namespace App\Filament\Resources\SchoolDetailsResource\Pages;

use App\Filament\Resources\SchoolDetailsResource;
use App\Models\SchoolDetails;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSchoolDetails extends ManageRecords
{
    protected static string $resource = SchoolDetailsResource::class;

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
