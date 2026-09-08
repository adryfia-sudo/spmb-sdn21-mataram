<?php

namespace App\Filament\Resources\RegistrationPaths\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationPathForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Jalur Pendaftaran')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Jalur')
                            ->required()
                            ->maxLength(100),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
