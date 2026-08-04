<?php

namespace App\Filament\Resources\Requirements\Schemas;

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
                    ->required(),

                Toggle::make('is_required')
                    ->label('Wajib'),

                Toggle::make('is_affirmation')
                    ->label('Jalur Afirmasi'),

                Toggle::make('is_mutation')
                    ->label('Jalur Domisili / Mutasi'),
            ]);
    }
}
