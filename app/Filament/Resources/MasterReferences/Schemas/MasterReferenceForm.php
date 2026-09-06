<?php

namespace App\Filament\Resources\MasterReferences\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MasterReferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'religion' => 'Agama',
                        'education' => 'Pendidikan',
                        'job' => 'Pekerjaan',
                        'income' => 'Penghasilan',
                        'transportation' => 'Transportasi',
                        'residence' => 'Tempat Tinggal',
                        'blood_type' => 'Golongan Darah',
                        'citizenship' => 'Kewarganegaraan',
                        'family_relation' => 'Hubungan Keluarga',
                    ])
                    ->required()
                    ->searchable()
                    ->native(false),

                TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Kode internal untuk data referensi.'),

                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(3)
                    ->maxLength(65535),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
