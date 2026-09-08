<?php

namespace App\Filament\Resources\RegistrationPeriods\Schemas;

use App\Models\AcademicYear;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationPeriodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Periode Pendaftaran')
                    ->schema([
                        Select::make('academic_year_id')
                            ->label('Tahun Pelajaran')
                            ->options(
                                AcademicYear::query()
                                    ->orderByDesc('start_date')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nama Periode')
                            ->placeholder(
                                'Contoh: Pendaftaran SPMB Tahun 2026/2027'
                            )
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai Pendaftaran')
                            ->required()
                            ->native(false),

                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai Pendaftaran')
                            ->required()
                            ->native(false),

                        DatePicker::make('verification_end_date')
                            ->label('Batas Akhir Verifikasi')
                            ->helperText(
                                'Batas terakhir admin melakukan verifikasi pendaftar.'
                            )
                            ->native(false)
                            ->afterOrEqual('start_date'),

                        DatePicker::make('announcement_date')
                            ->label('Tanggal Pengumuman')
                            ->helperText(
                                'Tanggal mulai hasil SPMB dapat diumumkan.'
                            )
                            ->native(false)
                            ->afterOrEqual('verification_end_date'),

                        Toggle::make('is_active')
                            ->label('Periode Aktif')
                            ->default(false)
                            ->helperText(
                                'Aktifkan periode yang sedang digunakan untuk pendaftaran.'
                            ),
                    ])
                    ->columns(2),

                Section::make('Status Pengumuman')
                    ->schema([
                        TextInput::make('announcement_published_at')
                            ->label('Pengumuman Dilakukan')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(
                                fn ($state): string =>
                                    $state
                                        ? $state->format('d/m/Y H:i')
                                        : 'Belum diumumkan'
                            )
                            ->helperText(
                                'Status ini diisi otomatis ketika admin menekan tombol "Umumkan Hasil".'
                            ),
                    ])
                    ->columns(1),
            ]);
    }
}
