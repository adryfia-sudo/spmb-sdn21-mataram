<?php

namespace App\Filament\Resources\RegistrationProofTemplates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrationProofTemplatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Template')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school_name')
                    ->label('Sekolah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('institution_name')
                    ->label('Instansi')
                    ->searchable(),

                TextColumn::make('city')
                    ->label('Kota')
                    ->sortable(),

                IconColumn::make('logo_government')
                    ->label('Logo Pemkot')
                    ->boolean(fn ($state) => filled($state)),

                IconColumn::make('logo_school')
                    ->label('Logo Sekolah')
                    ->boolean(fn ($state) => filled($state)),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
