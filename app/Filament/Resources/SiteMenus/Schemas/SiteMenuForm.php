<?php

namespace App\Filament\Resources\SiteMenus\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteMenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengaturan Menu')
                    ->schema([
                        TextInput::make('label')
                            ->label('Nama Menu')
                            ->placeholder('Contoh: Profil')
                            ->required()
                            ->maxLength(100),

                        Select::make('type')
                            ->label('Jenis Menu')
                            ->options([
                                'internal' => 'Halaman Internal',
                                'external' => 'URL Eksternal',
                            ])
                            ->default('internal')
                            ->required()
                            ->live(),

                        Select::make('route_name')
                            ->label('Halaman / Route')
                            ->options([
                                'home' => 'Beranda',
                                'front.profile' => 'Profil',
                                'front.schedule' => 'Jadwal',
                                'front.paths' => 'Jalur Pendaftaran',
                                'front.requirements' => 'Persyaratan',
                                'registration.status' => 'Cek Status Pendaftaran',
                                'registration.create' => 'Daftar Sekarang',
                            ])
                            ->searchable()
                            ->nullable()
                            ->visible(fn ($get) => $get('type') === 'internal'),

                        TextInput::make('url')
                            ->label('URL Eksternal')
                            ->placeholder('https://contoh.com')
                            ->url()
                            ->nullable()
                            ->visible(fn ($get) => $get('type') === 'external'),

                        Select::make('location')
                            ->label('Lokasi Menu')
                            ->options([
                                'navbar' => 'Navbar Utama',
                                'footer' => 'Footer',
                            ])
                            ->default('navbar')
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText(
                                'Angka lebih kecil akan tampil lebih dahulu.'
                            ),

                        Toggle::make('is_active')
                            ->label('Menu Aktif')
                            ->default(true)
                            ->helperText(
                                'Nonaktifkan jika menu tidak ingin ditampilkan.'
                            ),

                        Toggle::make('open_new_tab')
                            ->label('Buka di Tab Baru')
                            ->default(false)
                            ->helperText(
                                'Biasanya digunakan untuk URL eksternal.'
                            ),
                    ])
                    ->columns(2),
            ]);
    }
}
