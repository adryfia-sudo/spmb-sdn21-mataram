<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Data Pendaftaran')
                    ->schema([
                        TextEntry::make('registration_number')
                            ->label('Nomor Pendaftaran')
                            ->copyable(),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge(),

                        TextEntry::make('academicYear.name')
                            ->label('Tahun Ajaran'),

                        TextEntry::make('registrationPeriod.name')
                            ->label('Periode'),

                        TextEntry::make('registrationPath.name')
                            ->label('Jalur Pendaftaran'),
                    ])
                    ->columns(3),

                Section::make('Data Peserta Didik')
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Nama Lengkap'),

                        TextEntry::make('nik')
                            ->label('NIK')
                            ->copyable(),

                        TextEntry::make('nisn')
                            ->label('NISN')
                            ->placeholder('-'),

                        TextEntry::make('gender')
                            ->label('Jenis Kelamin')
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                                default => '-',
                            }),

                        TextEntry::make('birth_place')
                            ->label('Tempat Lahir'),

                        TextEntry::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->date('d/m/Y'),

                        TextEntry::make('religion')
                            ->label('Agama'),

                        TextEntry::make('special_needs')
                            ->label('Kebutuhan Khusus')
                            ->formatStateUsing(
                                fn ($state): string => $state ? 'Ya' : 'Tidak'
                            ),

                        TextEntry::make('previous_school')
                            ->label('Sekolah Sebelumnya')
                            ->placeholder('-'),

                        TextEntry::make('previous_school_type')
                            ->label('Jenis Sekolah Sebelumnya')
                            ->placeholder('-'),

                        TextEntry::make('family_card_number')
                            ->label('Nomor KK')
                            ->copyable(),

                        TextEntry::make('birth_certificate_number')
                            ->label('Nomor Akta Kelahiran')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Data Fisik')
                    ->schema([
                        TextEntry::make('height')
                            ->label('Tinggi Badan')
                            ->suffix(' cm'),

                        TextEntry::make('weight')
                            ->label('Berat Badan')
                            ->suffix(' kg'),

                        TextEntry::make('head_circumference')
                            ->label('Lingkar Kepala')
                            ->suffix(' cm'),
                    ])
                    ->columns(3),

                Section::make('Data Keluarga')
                    ->schema([
                        TextEntry::make('siblings_count')
                            ->label('Jumlah Saudara'),

                        TextEntry::make('child_order')
                            ->label('Anak Ke-'),
                    ])
                    ->columns(2),

                Section::make('Kontak')
                    ->schema([
                        TextEntry::make('phone')
                            ->label('No. HP / WhatsApp')
                            ->copyable(),

                        TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Jarak dan Transportasi')
                    ->schema([
                        TextEntry::make('distance_category')
                            ->label('Kategori Jarak'),

                        TextEntry::make('distance_km')
                            ->label('Jarak')
                            ->suffix(' km')
                            ->placeholder('-'),

                        TextEntry::make('transportation')
                            ->label('Transportasi'),

                        TextEntry::make('travel_time')
                            ->label('Lama Perjalanan')
                            ->suffix(' menit'),
                    ])
                    ->columns(2),

                Section::make('Alamat')
                    ->schema([
                        TextEntry::make('address.address')
                            ->label('Alamat')
                            ->columnSpanFull(),

                        TextEntry::make('address.province')
                            ->label('Provinsi'),

                        TextEntry::make('address.city')
                            ->label('Kota/Kabupaten'),

                        TextEntry::make('address.district')
                            ->label('Kecamatan'),

                        TextEntry::make('address.village')
                            ->label('Kelurahan/Desa'),

                        TextEntry::make('address.hamlet')
                            ->label('Dusun/Lingkungan')
                            ->placeholder('-'),

                        TextEntry::make('address.rt')
                            ->label('RT')
                            ->placeholder('-'),

                        TextEntry::make('address.rw')
                            ->label('RW')
                            ->placeholder('-'),

                        TextEntry::make('address.postal_code')
                            ->label('Kode Pos')
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
