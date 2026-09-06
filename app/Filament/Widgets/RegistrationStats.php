<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RegistrationStats extends StatsOverviewWidget
{

public static function canView(): bool
{
    return auth()->user()?->is_active === true
        && in_array(auth()->user()?->role, [
            'super_admin',
            'admin',
            'panitia',
        ], true);
}

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Pendaftar',
                Registration::query()->count()
            ),

            Stat::make(
                'Belum Verifikasi',
                Registration::query()
                    ->where('status', 'pending')
                    ->count()
            ),

            Stat::make(
                'Verifikasi',
                Registration::query()
                    ->where('status', 'verified')
                    ->count()
            ),

            Stat::make(
                'Diterima',
                Registration::query()
                    ->where('status', 'accepted')
                    ->count()
            ),

            Stat::make(
                'Tidak Diterima',
                Registration::query()
                    ->where('status', 'rejected')
                    ->count()
            ),
        ];
    }
}
