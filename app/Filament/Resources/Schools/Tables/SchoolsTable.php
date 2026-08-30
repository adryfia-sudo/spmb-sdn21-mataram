<?php

namespace App\Filament\Resources\Schools\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('school_name')
                    ->label('Sekolah')
                    ->searchable(),

                TextColumn::make('npsn'),

                TextColumn::make('city'),

                TextColumn::make('phone'),

            ])

            ->recordActions([

                EditAction::make(),

            ])

            ->toolbarActions([

                DeleteBulkAction::make(),

            ]);
    }
}
