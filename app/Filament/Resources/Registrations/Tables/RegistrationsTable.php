<?php

namespace App\Filament\Resources\Registrations\Tables;

use App\Models\Registration;
use App\Models\VerificationLog;
use App\Services\RegistrationExcelExportService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Actions\ViewAction;

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
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'pending' => 'Belum Verifikasi',
                            'verified' => 'Terverifikasi',
                            'accepted' => 'Diterima',
                            'rejected' => 'Tidak Diterima',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'pending' => 'warning',
                            'verified' => 'info',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('created_at')
                    ->label('Tanggal Pendaftaran')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])

            ->filters([
                //
            ])

           ->recordActions([

    /*
    |--------------------------------------------------------------------------
    | LIHAT DATA SISWA
    |--------------------------------------------------------------------------
    */

    ViewAction::make()
        ->label('Lihat Data')
        ->icon('heroicon-o-eye'),

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PENDAFTARAN
    |--------------------------------------------------------------------------
    */

    Action::make('verify')
        ->label('Verifikasi')
        ->icon('heroicon-o-check-circle')
        ->color('success')
        ->requiresConfirmation()
        ->modalHeading('Verifikasi Pendaftaran')
        ->modalDescription(
            fn (Registration $record): string =>
                "Apakah Anda yakin ingin memverifikasi pendaftaran {$record->registration_number} atas nama {$record->full_name}?"
        )
        ->modalSubmitActionLabel('Ya, Verifikasi')
        ->modalCancelActionLabel('Batal')
        ->visible(
            fn (Registration $record): bool =>
                $record->status === 'pending'
        )
        ->action(function (Registration $record): void {

            DB::transaction(function () use ($record) {

                $record->refresh();

                if ($record->status !== 'pending') {
                    return;
                }

                $record->update([
                    'status' => 'verified',
                ]);

                VerificationLog::create([
                    'registration_id' => $record->id,
                    'user_id' => auth()->id(),
                    'status' => 'verified',
                    'notes' => 'Pendaftaran diverifikasi oleh admin.',
                ]);
            });
        }),

    /*
    |--------------------------------------------------------------------------
    | DITERIMA
    |--------------------------------------------------------------------------
    */

    Action::make('accept')
        ->label('Diterima')
        ->icon('heroicon-o-check')
        ->color('success')
        ->requiresConfirmation()
        ->modalHeading('Pendaftaran Diterima')
        ->modalDescription(
            fn (Registration $record): string =>
                "Apakah Anda yakin {$record->full_name} dinyatakan DITERIMA?"
        )
        ->modalSubmitActionLabel('Ya, Diterima')
        ->modalCancelActionLabel('Batal')
        ->visible(
            fn (Registration $record): bool =>
                $record->status === 'verified'
        )
        ->action(function (Registration $record): void {

            DB::transaction(function () use ($record) {

                $record->refresh();

                if ($record->status !== 'verified') {
                    return;
                }

                $record->update([
                    'status' => 'accepted',
                ]);

                VerificationLog::create([
                    'registration_id' => $record->id,
                    'user_id' => auth()->id(),
                    'status' => 'accepted',
                    'notes' => 'Pendaftar dinyatakan diterima oleh admin.',
                ]);
            });
        }),

    /*
    |--------------------------------------------------------------------------
    | TIDAK DITERIMA
    |--------------------------------------------------------------------------
    */

    Action::make('reject')
        ->label('Tidak Diterima')
        ->icon('heroicon-o-x-circle')
        ->color('danger')
        ->requiresConfirmation()
        ->modalHeading('Pendaftaran Tidak Diterima')
        ->modalDescription(
            fn (Registration $record): string =>
                "Apakah Anda yakin {$record->full_name} dinyatakan TIDAK DITERIMA?"
        )
        ->modalSubmitActionLabel('Ya, Tidak Diterima')
        ->modalCancelActionLabel('Batal')
        ->visible(
            fn (Registration $record): bool =>
                $record->status === 'verified'
        )
        ->action(function (Registration $record): void {

            DB::transaction(function () use ($record) {

                $record->refresh();

                if ($record->status !== 'verified') {
                    return;
                }

                $record->update([
                    'status' => 'rejected',
                ]);

                VerificationLog::create([
                    'registration_id' => $record->id,
                    'user_id' => auth()->id(),
                    'status' => 'rejected',
                    'notes' => 'Pendaftar dinyatakan tidak diterima oleh admin.',
                ]);
            });
        }),

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    EditAction::make(),

])

            ->toolbarActions([

                /*
                |--------------------------------------------------------------------------
                | EXPORT EXCEL
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | BULK ACTION
                |--------------------------------------------------------------------------
                */

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
