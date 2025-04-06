<?php

namespace App\Filament\Resources\Annex2Resource\Pages;

use App\Filament\Resources\Annex2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAnnex2s extends ManageRecords
{
    protected static string $resource = Annex2Resource::class;

    protected static ?string $title = 'Annex 2';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
