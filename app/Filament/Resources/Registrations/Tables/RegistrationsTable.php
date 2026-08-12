<?php

namespace App\Filament\Resources\Registrations\Tables;

use App\Services\RegistrationExcelExportService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')
                    ->label('Nomor Pendaftaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label('Nama Calon Peserta Didik')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('registrationPath.name')
                    ->label('Jalur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'submitted' => 'Belum Diverifikasi',
                        'verified' => 'Terverifikasi',
                        'accepted' => 'Diterima',
                        'rejected' => 'Ditolak',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'submitted' => 'warning',
                        'verified' => 'success',
                        'accepted' => 'primary',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Pendaftaran')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])

            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                Action::make('exportExcel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($livewire) {
                        return app(
                            RegistrationExcelExportService::class
                        )->download(
                            $livewire->getFilteredTableQuery()
                        );
                    }),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
