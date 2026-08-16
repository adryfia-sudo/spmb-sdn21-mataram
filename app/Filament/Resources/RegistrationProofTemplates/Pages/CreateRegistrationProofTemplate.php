<?php

namespace App\Filament\Resources\RegistrationProofTemplates\Pages;

use App\Filament\Resources\RegistrationProofTemplates\RegistrationProofTemplateResource;
use App\Models\RegistrationProofTemplate;
use Filament\Resources\Pages\CreateRecord;

class CreateRegistrationProofTemplate extends CreateRecord
{
    protected static string $resource = RegistrationProofTemplateResource::class;

    protected function afterCreate(): void
    {
        $this->ensureOnlyOneActiveTemplate();
    }

    protected function ensureOnlyOneActiveTemplate(): void
    {
        if (! $this->record->is_active) {
            return;
        }

        RegistrationProofTemplate::query()
            ->whereKeyNot($this->record->id)
            ->where('is_active', true)
            ->update([
                'is_active' => false,
            ]);
    }
}
