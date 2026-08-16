<?php

namespace App\Filament\Resources\Registrations\Pages;

use App\Filament\Resources\Registrations\RegistrationResource;
use App\Models\AcademicYear;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\VerificationLog;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListRegistrations extends ListRecords
{
    protected static string $resource = RegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('announceResults')
                ->label('Umumkan Hasil')
                ->icon('heroicon-o-megaphone')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Umumkan Hasil SPMB')
                ->modalDescription(
                    'Sistem akan memeriksa seluruh pendaftar pada periode aktif. '
                    . 'Pendaftar yang belum diverifikasi akan dinyatakan Tidak Diterima. '
                    . 'Pendaftar yang sudah diverifikasi harus sudah memiliki keputusan '
                    . 'Diterima atau Tidak Diterima.'
                )
                ->modalSubmitActionLabel('Ya, Umumkan Hasil')
                ->modalCancelActionLabel('Batal')
                ->action(function (): void {

                    /*
                    |--------------------------------------------------------------------------
                    | Tahun Pelajaran Aktif
                    |--------------------------------------------------------------------------
                    */

                    $academicYear = AcademicYear::query()
                        ->where('is_active', true)
                        ->first();

                    if (! $academicYear) {
                        Notification::make()
                            ->title('Pengumuman gagal')
                            ->body(
                                'Tidak ditemukan tahun pelajaran aktif.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Periode Pendaftaran Aktif
                    |--------------------------------------------------------------------------
                    */

                    $period = RegistrationPeriod::query()
                        ->where('is_active', true)
                        ->where(
                            'academic_year_id',
                            $academicYear->id
                        )
                        ->first();

                    if (! $period) {
                        Notification::make()
                            ->title('Pengumuman gagal')
                            ->body(
                                'Tidak ditemukan periode pendaftaran aktif.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Cegah Pengumuman Kedua Kali
                    |--------------------------------------------------------------------------
                    */

                    if ($period->announcement_published_at !== null) {
                        Notification::make()
                            ->title('Pengumuman sudah dilakukan')
                            ->body(
                                'Hasil SPMB untuk periode ini sudah diumumkan pada '
                                . $period->announcement_published_at
                                    ->format('d/m/Y H:i')
                                . '.'
                            )
                            ->warning()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Pastikan Tanggal Pengumuman Sudah Tiba
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $period->announcement_date !== null
                        && now()->startOfDay()->lt(
                            $period->announcement_date->startOfDay()
                        )
                    ) {
                        Notification::make()
                            ->title('Belum waktunya pengumuman')
                            ->body(
                                'Pengumuman baru dapat dilakukan pada '
                                . $period->announcement_date
                                    ->format('d/m/Y')
                                . '.'
                            )
                            ->warning()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Periksa Pendaftar Yang Masih VERIFIED
                    |--------------------------------------------------------------------------
                    |
                    | VERIFIED berarti sudah diverifikasi oleh admin,
                    | tetapi belum ditetapkan Diterima / Tidak Diterima.
                    |
                    */

                    $verifiedCount = Registration::query()
                        ->where(
                            'academic_year_id',
                            $academicYear->id
                        )
                        ->where(
                            'registration_period_id',
                            $period->id
                        )
                        ->where('status', 'verified')
                        ->count();

                    if ($verifiedCount > 0) {
                        Notification::make()
                            ->title('Pengumuman belum dapat dilakukan')
                            ->body(
                                "Masih terdapat {$verifiedCount} pendaftar "
                                . 'yang sudah diverifikasi tetapi belum '
                                . 'ditetapkan menjadi Diterima atau Tidak Diterima.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Proses Pengumuman
                    |--------------------------------------------------------------------------
                    */

                    try {

                        DB::transaction(function () use (
                            $academicYear,
                            $period
                        ) {

                            /*
                            |--------------------------------------------------------------------------
                            | Ambil Pendaftar Yang Belum Diverifikasi
                            |--------------------------------------------------------------------------
                            */

                            $pendingRegistrations =
                                Registration::query()
                                    ->where(
                                        'academic_year_id',
                                        $academicYear->id
                                    )
                                    ->where(
                                        'registration_period_id',
                                        $period->id
                                    )
                                    ->where('status', 'pending')
                                    ->lockForUpdate()
                                    ->get();

                            /*
                            |--------------------------------------------------------------------------
                            | Pending → Rejected
                            |--------------------------------------------------------------------------
                            */

                            foreach (
                                $pendingRegistrations
                                as $registration
                            ) {

                                $registration->update([
                                    'status' => 'rejected',
                                ]);

                                /*
                                |--------------------------------------------------------------------------
                                | Simpan Log Otomatis
                                |--------------------------------------------------------------------------
                                */

                                VerificationLog::create([
                                    'registration_id' =>
                                        $registration->id,

                                    'user_id' =>
                                        auth()->id(),

                                    'status' =>
                                        'rejected',

                                    'notes' =>
                                        'Pendaftar belum diverifikasi '
                                        . 'sampai waktu pengumuman dan '
                                        . 'otomatis dinyatakan Tidak Diterima.',
                                ]);
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | Tandai Pengumuman Sudah Dilakukan
                            |--------------------------------------------------------------------------
                            */

                            $period->update([
                                'announcement_published_at' => now(),
                            ]);
                        });

                    } catch (\Throwable $e) {

                        report($e);

                        Notification::make()
                            ->title('Pengumuman gagal')
                            ->body(
                                'Terjadi kesalahan saat memproses '
                                . 'pengumuman hasil.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Notifikasi Berhasil
                    |--------------------------------------------------------------------------
                    */

                    Notification::make()
                        ->title('Pengumuman berhasil')
                        ->body(
                            'Hasil SPMB berhasil diumumkan. '
                            . 'Pendaftar yang belum diverifikasi '
                            . 'telah dinyatakan Tidak Diterima.'
                        )
                        ->success()
                        ->send();
                }),
        ];
    }
}
