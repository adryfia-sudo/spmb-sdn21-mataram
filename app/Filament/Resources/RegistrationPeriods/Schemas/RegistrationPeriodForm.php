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
                            ->placeholder('Contoh: Pendaftaran SPMB Tahun 2026/2027')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->native(false),

                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Periode Aktif')
                            ->default(false)
                            ->helperText(
                                'Aktifkan periode yang sedang digunakan untuk pendaftaran.'
                            ),
                    ])
                    ->columns(2),
            ]);
    }
}
