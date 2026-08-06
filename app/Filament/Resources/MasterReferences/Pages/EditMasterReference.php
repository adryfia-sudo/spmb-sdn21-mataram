<?php

namespace App\Filament\Resources\MasterReferences\Pages;

use App\Filament\Resources\MasterReferences\MasterReferenceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMasterReference extends EditRecord
{
    protected static string $resource = MasterReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
