<?php
namespace App\Filament\Resources\ResearchProjectResource\Pages;

use App\Filament\Resources\ResearchProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResearchProject extends CreateRecord
{
    protected static string $resource = ResearchProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->isHod()) {
            $data['user_id'] = auth()->id();
            $data['department_id'] = auth()->user()->department_id;
        }

        return $data;
    }
}
