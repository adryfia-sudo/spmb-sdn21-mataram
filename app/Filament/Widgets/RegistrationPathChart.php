<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use App\Models\RegistrationPath;
use Filament\Widgets\ChartWidget;

class RegistrationPathChart extends ChartWidget
{
    protected ?string $heading = 'Pendaftar Berdasarkan Jalur';

    protected function getData(): array
    {
        $paths = RegistrationPath::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => $paths->map(
                        fn (RegistrationPath $path) => Registration::query()
                            ->where('registration_path_id', $path->id)
                            ->count()
                    )->values()->all(),
                ],
            ],
            'labels' => $paths->pluck('name')->values()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
