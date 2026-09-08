<?php

namespace App\Filament\Resources\Requirements\Schemas;

use App\Models\RegistrationPath;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

                Repeater::make('path_requirements')
                    ->label('Pengaturan Persyaratan per Jalur')
                    ->schema([
                        Select::make('registration_path_id')
                            ->label('Jalur Pendaftaran')
                            ->options(
                                fn (): array => RegistrationPath::query()
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                                    ->all()
                            )
                            ->required()
                            ->distinct(),

                        Toggle::make('is_required')
                            ->label('Wajib')
                            ->default(true),

                        Toggle::make('is_verification_required')
                            ->label('Perlu Verifikasi')
                            ->default(true),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),

                        Toggle::make('show_in_upload')
                            ->label('Tampilkan di Upload Dokumen')
                            ->default(true),

                        Toggle::make('show_in_proof')
                            ->label('Tampilkan di Bukti Pendaftaran')
                            ->default(true),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(2)
                            ->maxLength(1000),
                    ])
                    ->columns(2)
                    ->defaultItems(0)
                    ->addActionLabel('Tambah Jalur')
                    ->reorderable(false)
                    ->collapsible()
                    ->itemLabel(
                        fn (array $state): ?string =>
                            isset($state['registration_path_id'])
                                ? RegistrationPath::find(
                                    $state['registration_path_id']
                                )?->name
                                : null
                    )
                    ->helperText(
                        'Satu dokumen dapat digunakan pada beberapa jalur dengan pengaturan yang berbeda.'
                    ),
            ]);
    }
}
