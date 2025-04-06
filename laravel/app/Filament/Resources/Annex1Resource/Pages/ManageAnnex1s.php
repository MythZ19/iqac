<?php

namespace App\Filament\Resources\Annex1Resource\Pages;

use App\Filament\Resources\Annex1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAnnex1s extends ManageRecords
{
    protected static string $resource = Annex1Resource::class;

    protected static ?string $title = 'Annex 1';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
