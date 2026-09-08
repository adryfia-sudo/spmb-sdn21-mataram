<?php

namespace App\Filament\Resources\Galleries\Pages;

use App\Filament\Resources\Galleries\GalleryResource;
use App\Models\GalleryPhoto;
use Filament\Resources\Pages\CreateRecord;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected array $galleryPhotos = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->galleryPhotos = $data['photos'] ?? [];

        unset($data['photos']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->galleryPhotos as $index => $photo) {
            GalleryPhoto::create([
                'gallery_id' => $this->record->id,
                'image' => $photo,
                'sort_order' => $index,
            ]);
        }
    }
}
