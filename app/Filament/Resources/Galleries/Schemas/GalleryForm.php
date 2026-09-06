<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Galeri')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->nullable(),

                Toggle::make('is_active')
                    ->label('Galeri Aktif')
                    ->default(true),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->seconds(false)
                    ->nullable(),

                FileUpload::make('photos')
                    ->label('Foto Galeri')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('gallery')
                    ->maxFiles(100)
                    ->maxSize(10240)
                    ->columnSpanFull()
                    ->dehydrated(true),
            ]);
    }
}
