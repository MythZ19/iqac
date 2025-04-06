<?php

namespace App\Filament\Resources\Annex3Resource\Pages;

use App\Filament\Resources\Annex3Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAnnex3s extends ManageRecords
{
    protected static string $resource = Annex3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
