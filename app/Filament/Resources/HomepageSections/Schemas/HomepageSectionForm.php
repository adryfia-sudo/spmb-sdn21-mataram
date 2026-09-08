<?php

namespace App\Filament\Resources\HomepageSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HomepageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Kode Section')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)
                    ->helperText(
                        'Contoh: hero, sambutan, informasi, berita, pengumuman, galeri, kontak.'
                    ),

                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->label('Subjudul')
                    ->maxLength(255),

                RichEditor::make('content')
                    ->label('Isi')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
		    ->disk('public')
                    ->directory('homepage')
                    ->imageEditor()
                    ->maxSize(2048),

                Toggle::make('is_active')
                    ->label('Tampilkan di Beranda')
                    ->default(true),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->minValue(0),
            ]);
    }
}
