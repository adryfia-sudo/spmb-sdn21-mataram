<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Region;

class RegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | DATA PENDAFTARAN
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | DATA PESERTA DIDIK
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | DATA FISIK
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | DATA KELUARGA
                |--------------------------------------------------------------------------
                */

                Section::make('Data Keluarga')
                    ->schema([
                        TextEntry::make('siblings_count')
                            ->label('Jumlah Saudara'),

                        TextEntry::make('child_order')
                            ->label('Anak Ke-'),

                        /*
                         * Tambahan:
                         * tipe/status tempat tinggal yang diisi
                         * pada formulir pendaftaran.
                         */
                        TextEntry::make('residence_type')
                            ->label('Status Tempat Tinggal')
                            ->placeholder('-'),
                    ])
                    ->columns(3),

                /*
                |--------------------------------------------------------------------------
                | DATA AYAH
                |--------------------------------------------------------------------------
                */

                Section::make('Data Ayah')
                    ->schema([
                        TextEntry::make('father.full_name')
                            ->label('Nama Ayah')
                            ->placeholder('-'),

                        TextEntry::make('father.nik')
                            ->label('NIK Ayah')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('father.birth_year')
                            ->label('Tahun Lahir')
                            ->placeholder('-'),

                        TextEntry::make('father.education')
                            ->label('Pendidikan')
                            ->placeholder('-'),

                        TextEntry::make('father.job')
                            ->label('Pekerjaan')
                            ->placeholder('-'),

                        TextEntry::make('father.income')
                            ->label('Penghasilan')
                            ->placeholder('-'),

                        TextEntry::make('father.phone')
                            ->label('No. HP')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('father.is_alive')
                            ->label('Status Hidup')
                            ->formatStateUsing(
                                fn ($state): string => $state
                                    ? 'Masih Hidup'
                                    : 'Meninggal'
                            ),

                        TextEntry::make('father.is_guardian')
                            ->label('Sebagai Wali')
                            ->formatStateUsing(
                                fn ($state): string => $state
                                    ? 'Ya'
                                    : 'Tidak'
                            ),
                    ])
                    ->columns(3),

                /*
                |--------------------------------------------------------------------------
                | DATA IBU
                |--------------------------------------------------------------------------
                */

                Section::make('Data Ibu')
                    ->schema([
                        TextEntry::make('mother.full_name')
                            ->label('Nama Ibu')
                            ->placeholder('-'),

                        TextEntry::make('mother.nik')
                            ->label('NIK Ibu')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('mother.birth_year')
                            ->label('Tahun Lahir')
                            ->placeholder('-'),

                        TextEntry::make('mother.education')
                            ->label('Pendidikan')
                            ->placeholder('-'),

                        TextEntry::make('mother.job')
                            ->label('Pekerjaan')
                            ->placeholder('-'),

                        TextEntry::make('mother.income')
                            ->label('Penghasilan')
                            ->placeholder('-'),

                        TextEntry::make('mother.phone')
                            ->label('No. HP')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('mother.is_alive')
                            ->label('Status Hidup')
                            ->formatStateUsing(
                                fn ($state): string => $state
                                    ? 'Masih Hidup'
                                    : 'Meninggal'
                            ),

                        TextEntry::make('mother.is_guardian')
                            ->label('Sebagai Wali')
                            ->formatStateUsing(
                                fn ($state): string => $state
                                    ? 'Ya'
                                    : 'Tidak'
                            ),
                    ])
                    ->columns(3),

                /*
                |--------------------------------------------------------------------------
                | DATA WALI
                |--------------------------------------------------------------------------
                */

                Section::make('Data Wali')
                    ->schema([
                        TextEntry::make('guardian.full_name')
                            ->label('Nama Wali')
                            ->placeholder('-'),

                        TextEntry::make('guardian.family_relation')
                            ->label('Hubungan dengan Peserta Didik')
                            ->placeholder('-'),

                        TextEntry::make('guardian.nik')
                            ->label('NIK Wali')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('guardian.birth_year')
                            ->label('Tahun Lahir')
                            ->placeholder('-'),

                        TextEntry::make('guardian.education')
                            ->label('Pendidikan')
                            ->placeholder('-'),

                        TextEntry::make('guardian.job')
                            ->label('Pekerjaan')
                            ->placeholder('-'),

                        TextEntry::make('guardian.income')
                            ->label('Penghasilan')
                            ->placeholder('-'),

                        TextEntry::make('guardian.phone')
                            ->label('No. HP')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('guardian.address')
                            ->label('Alamat Wali')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                /*
                |--------------------------------------------------------------------------
                | KONTAK
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | JARAK DAN TRANSPORTASI
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | ALAMAT
                |--------------------------------------------------------------------------
                */

                Section::make('Alamat')
                    ->schema([
                        TextEntry::make('address.address')
                            ->label('Alamat')
                            ->columnSpanFull(),

                  TextEntry::make('address.province')
    ->label('Provinsi')
    ->formatStateUsing(
        fn ($state): string =>
            \App\Models\Region::where('code', $state)->value('name') ?? '-'
    ),

TextEntry::make('address.city')
    ->label('Kota/Kabupaten')
    ->formatStateUsing(
        fn ($state): string =>
            \App\Models\Region::where('code', $state)->value('name') ?? '-'
    ),

TextEntry::make('address.district')
    ->label('Kecamatan')
    ->formatStateUsing(
        fn ($state): string =>
            \App\Models\Region::where('code', $state)->value('name') ?? '-'
    ),

TextEntry::make('address.village')
    ->label('Kelurahan/Desa')
    ->formatStateUsing(
        fn ($state): string =>
            \App\Models\Region::where('code', $state)->value('name') ?? '-'
    ),

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

                /*
                |--------------------------------------------------------------------------
                | KOORDINAT
                |--------------------------------------------------------------------------
                */

                Section::make('Koordinat Lokasi')
                    ->schema([
                        TextEntry::make('address.latitude')
                            ->label('Latitude')
                            ->placeholder('-')
                            ->copyable(),

                        TextEntry::make('address.longitude')
                            ->label('Longitude')
                            ->placeholder('-')
                            ->copyable(),
                    ])
                    ->columns(2),

            ]);
    }
}
