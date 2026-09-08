<?php

namespace App\Filament\Resources\MasterReferences\Pages;

use App\Filament\Resources\MasterReferences\MasterReferenceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMasterReferences extends ListRecords
{
    protected static string $resource = MasterReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
