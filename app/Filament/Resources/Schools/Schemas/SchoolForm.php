<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Profil Sekolah')
                    ->schema([

                        TextInput::make('school_name')
                            ->label('Nama Sekolah')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('npsn')
                            ->label('NPSN')
                            ->required()
                            ->maxLength(8)
                            ->length(8),

                        TextInput::make('principal_name')
                            ->label('Kepala Sekolah')
                            ->maxLength(255),

                        TextInput::make('principal_nip')
                            ->label('NIP Kepala Sekolah')
                            ->maxLength(18),

                        TextInput::make('operator_name')
                            ->label('Operator')
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Telepon')
                            ->maxLength(20),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->maxLength(20),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),

                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->disk('public')
                            ->directory('school-logo')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->nullable(),

                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('village')
                            ->label('Kelurahan/Desa'),

                        TextInput::make('district')
                            ->label('Kecamatan'),

                        TextInput::make('city')
                            ->label('Kota/Kabupaten'),

                        TextInput::make('province')
                            ->label('Provinsi'),

                        TextInput::make('postal_code')
                            ->label('Kode Pos')
                            ->maxLength(10),

                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step(0.0000000001)
                            ->placeholder('-8.5652600687'),

                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step(0.0000000001)
                            ->placeholder('116.0765019298'),

                    ])
                    ->columns(2),

            ]);
    }
}
