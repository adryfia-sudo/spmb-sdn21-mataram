<?php

namespace App\Filament\Resources\RegistrationProofTemplates\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationProofTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Identitas Sekolah')
                    ->schema([
                        TextInput::make('school_name')
                            ->label('Nama Sekolah')
                            ->default('SD Negeri 21 Mataram')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('institution_name')
                            ->label('Instansi / Dinas')
                            ->default('Dinas Pendidikan Kota Mataram')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Alamat Sekolah')
                            ->rows(3)
                            ->maxLength(500),

                        TextInput::make('phone')
                            ->label('Telepon')
                            ->maxLength(50),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('accreditation')
                            ->label('Akreditasi')
                            ->maxLength(50),

                        TextInput::make('accreditation_reference')
                            ->label('Nomor / Referensi Akreditasi')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Logo dan Kop Surat')
                    ->schema([
                        FileUpload::make('logo_government')
                            ->label('Logo Pemerintah Kota Mataram')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('registration-proof/logos')
                            ->visibility('public')
                            ->maxSize(2048),

                        FileUpload::make('logo_school')
                            ->label('Logo Sekolah')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('registration-proof/logos')
                            ->visibility('public')
                            ->maxSize(2048),
                    ])
                    ->columns(2),

                Section::make('Dokumen Bukti Pendaftaran')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Template')
                            ->placeholder('Contoh: Bukti Pendaftaran SPMB 2026/2027')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('Kota')
                            ->default('Mataram')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('document_title')
                            ->label('Judul Dokumen')
                            ->default('BUKTI PENDAFTARAN MURID BARU')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('document_subtitle')
                            ->label('Subjudul')
                            ->default('SISTEM PENERIMAAN MURID BARU')
                            ->maxLength(255),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(4)
                            ->maxLength(1000),
                    ])
                    ->columns(2),

                Section::make('Verifikator')
                    ->schema([
                        TextInput::make('verification_title')
                            ->label('Judul Bagian Verifikasi')
                            ->default('Verifikasi Pendaftaran')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('verification_position')
                            ->label('Jabatan Verifikator')
                            ->placeholder('Contoh: Verifikator SPMB')
                            ->maxLength(255),

                        TextInput::make('verification_name')
                            ->label('Nama Verifikator')
                            ->maxLength(255),

                        TextInput::make('verification_nip')
                            ->label('NIP Verifikator')
                            ->maxLength(50),
                    ])
                    ->columns(2),

                Section::make('Status Template')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Template Aktif')
                            ->default(true)
                            ->helperText(
                                'Aktifkan template yang akan digunakan sebagai bukti pendaftaran.'
                            ),
                    ]),
            ]);
    }
}
