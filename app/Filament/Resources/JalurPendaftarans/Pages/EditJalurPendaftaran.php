<?php

namespace App\Filament\Resources\JalurPendaftarans\Pages;

use App\Filament\Resources\JalurPendaftarans\JalurPendaftaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJalurPendaftaran extends EditRecord
{
    protected static string $resource = JalurPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
