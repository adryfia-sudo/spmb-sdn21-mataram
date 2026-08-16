<?php

namespace App\Filament\Resources\Requirements\Pages;

use App\Filament\Resources\Requirements\RequirementResource;
use Filament\Resources\Pages\EditRecord;

class EditRequirement extends EditRecord
{
    protected static string $resource = RequirementResource::class;

    protected array $pathRequirements = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['path_requirements'] = $this->record
            ->registrationPaths()
            ->get()
            ->map(
                fn ($path): array => [
                    'registration_path_id' => $path->id,

                    'is_required' =>
                        (bool) $path->pivot->is_required,

                    'is_verification_required' =>
                        (bool) $path->pivot->is_verification_required,

                    'is_active' =>
                        (bool) $path->pivot->is_active,

                    'show_in_upload' =>
                        (bool) $path->pivot->show_in_upload,

                    'show_in_proof' =>
                        (bool) $path->pivot->show_in_proof,

                    'notes' =>
                        $path->pivot->notes,
                ]
            )
            ->values()
            ->all();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->pathRequirements = $data['path_requirements'] ?? [];

        unset($data['path_requirements']);

        return $data;
    }

    protected function afterSave(): void
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
