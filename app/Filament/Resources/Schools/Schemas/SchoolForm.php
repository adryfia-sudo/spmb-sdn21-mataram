<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Profil Sekolah')

                    ->schema([

                        TextInput::make('school_name')
                            ->label('Nama Sekolah')
                            ->required(),

                        TextInput::make('npsn')
                            ->required()
                            ->maxLength(8),

                        TextInput::make('principal_name')
                            ->label('Kepala Sekolah'),

                        TextInput::make('principal_nip')
                            ->label('NIP Kepala Sekolah'),

                        TextInput::make('operator_name')
                            ->label('Operator'),

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone'),

                        TextInput::make('whatsapp'),

                        TextInput::make('website'),

                        FileUpload::make('logo')
                            ->image()
                            ->directory('school-logo'),

                        Textarea::make('address')
                            ->columnSpanFull(),

                        TextInput::make('village'),

                        TextInput::make('district'),

                        TextInput::make('city'),

                        TextInput::make('province'),

                        TextInput::make('postal_code'),

                        TextInput::make('latitude')
                            ->numeric(),

                        TextInput::make('longitude')
                            ->numeric(),

                    ])
                    ->columns(2)

            ]);
    }
}
