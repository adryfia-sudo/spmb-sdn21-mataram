<?php

namespace App\Filament\Resources\JalurPendaftarans\Pages;

use App\Filament\Resources\JalurPendaftarans\JalurPendaftaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJalurPendaftarans extends ListRecords
{
    protected static string $resource = JalurPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
