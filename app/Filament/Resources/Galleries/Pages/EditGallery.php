<?php

namespace App\Filament\Resources\Galleries\Pages;

use App\Filament\Resources\Galleries\GalleryResource;
use App\Models\GalleryPhoto;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGallery extends EditRecord
{
    protected static string $resource = GalleryResource::class;

    protected array $galleryPhotos = [];

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->galleryPhotos = $data['photos'] ?? [];

        unset($data['photos']);

        return $data;
    }

    protected function afterSave(): void
    {
        $lastSortOrder = GalleryPhoto::query()
            ->where('gallery_id', $this->record->id)
            ->max('sort_order');

        foreach ($this->galleryPhotos as $index => $photo) {
            GalleryPhoto::create([
                'gallery_id' => $this->record->id,
                'image' => $photo,
                'sort_order' => ($lastSortOrder ?? -1) + $index + 1,
            ]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
