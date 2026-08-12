<?php

namespace App\Filament\Resources\Requirements\Pages;

use App\Filament\Resources\Requirements\RequirementResource;
use App\Models\RegistrationPath;
use Filament\Resources\Pages\CreateRecord;

class CreateRequirement extends CreateRecord
{
    protected static string $resource = RequirementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['registration_paths']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $paths = $this->data['registration_paths'] ?? [];

        if (empty($paths)) {
            return;
        }

        $documentType = $this->record;

        foreach ($paths as $pathId) {
            RegistrationPath::findOrFail($pathId)
                ->requirements()
                ->syncWithoutDetaching([
                    $documentType->id => [
                        'is_required' => (bool) ($this->data['is_required'] ?? false),
                        'is_active' => true,
                    ],
                ]);
        }
    }
}
