<?php

namespace App\Filament\Resources\RegistrationProofTemplates\Pages;

use App\Filament\Resources\RegistrationProofTemplates\RegistrationProofTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegistrationProofTemplates extends ListRecords
{
    protected static string $resource = RegistrationProofTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
