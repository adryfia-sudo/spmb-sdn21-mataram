<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Tahun Ajaran')
                ->placeholder('Contoh: 2026/2027')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),

            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required()
                ->after('start_date'),

            Toggle::make('is_active')
                ->label('Tahun Ajaran Aktif')
                ->default(false),

        ]);
    }
}
