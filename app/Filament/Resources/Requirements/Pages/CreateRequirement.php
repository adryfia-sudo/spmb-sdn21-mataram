<?php

namespace App\Filament\Resources\Requirements\Pages;

use App\Filament\Resources\Requirements\RequirementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRequirement extends CreateRecord
{
    protected static string $resource = RequirementResource::class;

    protected array $pathRequirements = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->pathRequirements = $data['path_requirements'] ?? [];

        unset($data['path_requirements']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->registrationPaths()->sync(
            collect($this->pathRequirements)
                ->filter(
                    fn (array $item): bool =>
                        ! empty($item['registration_path_id'])
                )
                ->mapWithKeys(
                    fn (array $item): array => [
                        $item['registration_path_id'] => [
                            'is_required' =>
                                $item['is_required'] ?? false,

                            'is_verification_required' =>
                                $item['is_verification_required'] ?? true,

                            'is_active' =>
                                $item['is_active'] ?? true,

                            'show_in_upload' =>
                                $item['show_in_upload'] ?? true,

                            'show_in_proof' =>
                                $item['show_in_proof'] ?? true,

                            'notes' =>
                                $item['notes'] ?? null,
                        ],
                    ]
                )
                ->all()
        );
    }
}
