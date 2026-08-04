<?php

namespace App\Filament\Resources\Requirements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequirementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Dokumen')
                    ->searchable(),

                IconColumn::make('is_required')
                    ->label('Wajib')
                    ->boolean(),

                IconColumn::make('is_affirmation')
                    ->label('Afirmasi')
                    ->boolean(),

                IconColumn::make('is_mutation')
                    ->label('Domisili / Mutasi')
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
