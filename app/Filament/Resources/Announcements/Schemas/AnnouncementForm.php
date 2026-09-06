<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('title')
    ->label('Judul')
    ->required()
    ->maxLength(255)
    ->live(onBlur: true)
    ->afterStateUpdated(function (Set $set, ?string $state): void {
        $set('slug', Str::slug($state ?? ''));
    }),

               TextInput::make('slug')
    ->label('Slug')
    ->required()
    ->maxLength(255)
    ->unique(ignoreRecord: true)
    ->readOnly(),

                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Isi Pengumuman')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->directory('announcements')
                    ->maxSize(5120)
                    ->helperText('Maksimal 5 MB.'),

                FileUpload::make('attachment')
                    ->label('Lampiran')
                    ->disk('public')
                    ->directory('announcements/attachments')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ])
                    ->maxSize(10240)
                    ->helperText('Bisa berupa gambar atau PDF. Maksimal 10 MB.'),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi'),
            ]);
    }
}
