<?php

namespace App\Filament\Resources\Registrations\Schemas;

use App\Models\AcademicYear;
use App\Models\RegistrationPath;
use App\Models\RegistrationPeriod;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Data Pendaftaran')
                    ->schema([

                        Select::make('academic_year_id')
                            ->label('Tahun Ajaran')
                            ->relationship('academicYear', 'name')
                            ->required(),

                        Select::make('registration_period_id')
                            ->label('Periode Pendaftaran')
                            ->relationship('registrationPeriod', 'name')
                            ->required(),

                        Select::make('registration_path_id')
                            ->label('Jalur Pendaftaran')
                            ->relationship('registrationPath', 'name')
                            ->required(),

                    ])
                    ->columns(3),

                Section::make('Data Calon Siswa')
                    ->schema([

                        TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required(),

                        TextInput::make('nik')
                            ->label('NIK')
                            ->length(16)
                            ->required(),

                        TextInput::make('nisn')
                            ->label('NISN'),

                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->required(),

                        TextInput::make('birth_place')
                            ->label('Tempat Lahir')
                            ->required(),

                        DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->required(),

                        Select::make('religion')
                            ->label('Agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                            ])
                            ->required(),

                        TextInput::make('phone')
                            ->label('No HP / WhatsApp')
                            ->required(),

                        TextInput::make('email')
                            ->label('Email'),

                    ])
                    ->columns(2),
            ]);
    }
}
