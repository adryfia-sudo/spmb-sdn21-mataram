<?php

namespace App\Services;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegistrationNumberService
{
    /**
     * Format:
     * SPMB260800001
     *
     * SPMB
     * 26 = tahun
     * 08 = bulan
     * 00001 = urutan
     */
    public function generate(): string
    {
        return DB::transaction(function () {

            $prefix = 'SPMB' . Carbon::now()->format('ym');

            $last = Registration::where(
                    'registration_number',
                    'like',
                    $prefix.'%'
                )
                ->lockForUpdate()
                ->orderByDesc('registration_number')
                ->first();

            $number = 1;

            if ($last) {
                $number =
                    (int) substr(
                        $last->registration_number,
                        -5
                    ) + 1;
            }

            return sprintf(
                '%s%05d',
                $prefix,
                $number
            );

        });
    }
}
