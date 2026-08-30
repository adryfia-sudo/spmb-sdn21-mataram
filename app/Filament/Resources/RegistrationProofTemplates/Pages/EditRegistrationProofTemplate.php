<?php

namespace App\Filament\Resources\RegistrationProofTemplates\Pages;

use App\Filament\Resources\RegistrationProofTemplates\RegistrationProofTemplateResource;
use App\Models\RegistrationProofTemplate;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistrationProofTemplate extends EditRecord
{
    protected static string $resource = RegistrationProofTemplateResource::class;

    protected function afterSave(): void
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

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
