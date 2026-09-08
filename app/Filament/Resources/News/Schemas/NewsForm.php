<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Otomatis dibuat dari judul berita.')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->directory('news')
                    ->maxSize(5120)
                    ->helperText('Maksimal 5 MB.'),

                Textarea::make('excerpt')
                    ->label('Ringkasan / Preview')
                    ->rows(4)
                    ->helperText(
                        'Ringkasan singkat yang akan digunakan sebagai preview berita.'
                    )
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->required()
                    ->columnSpanFull(),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->seconds(false)
                    ->default(now())
                    ->helperText(
                        'Berita hanya akan tampil setelah tanggal publikasi tercapai.'
                    ),

                Toggle::make('is_active')
                    ->label('Berita Aktif')
                    ->default(true)
                    ->helperText(
                        'Nonaktifkan jika berita tidak ingin ditampilkan di website.'
                    ),
            ]);
    }
}
