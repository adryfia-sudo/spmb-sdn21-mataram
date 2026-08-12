<?php

namespace App\Filament\Resources\Requirements\Schemas;

use App\Models\RegistrationPath;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RequirementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Dokumen')
                    ->required()
                    ->maxLength(255),

                CheckboxList::make('registration_paths')
                    ->label('Jalur Pendaftaran')
                    ->options(
                        fn (): array => RegistrationPath::query()
                            ->where('is_active', true)
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->all()
                    )
                    ->columns(2)
                    ->helperText(
                        'Pilih jalur yang menggunakan dokumen ini sebagai persyaratan.'
                    ),

                Toggle::make('is_required')
                    ->label('Wajib')
                    ->helperText(
                        'Jika aktif, dokumen wajib diunggah untuk jalur yang dipilih.'
                    )
                    ->default(false),

                Toggle::make('is_conditional')
                    ->label('Kondisional')
                    ->helperText(
                        'Dokumen hanya diwajibkan jika kondisi tertentu terpenuhi.'
                    )
                    ->default(false),
            ]);
    }
}
