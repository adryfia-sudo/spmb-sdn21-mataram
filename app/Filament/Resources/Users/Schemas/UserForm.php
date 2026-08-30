<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->required(
                        fn (string $operation): bool =>
                            $operation === 'create'
                    )
                    ->dehydrated(
                        fn (?string $state): bool =>
                            filled($state)
                    )
                    ->minLength(8)
                    ->maxLength(255),

                Select::make('role')
                    ->label('Hak Akses')
                    ->options(function (): array {
                        $user = auth()->user();

                        if ($user?->role === 'super_admin') {
                            return [
                                'super_admin' => 'Super Administrator',
                                'admin' => 'Administrator',
                                'panitia' => 'Panitia',
                            ];
                        }

                        return [
                            'panitia' => 'Panitia',
                        ];
                    })
                    ->required()
                    ->default('panitia'),

                Toggle::make('is_active')
                    ->label('Akun Aktif')
                    ->default(true),
            ]);
    }
}
