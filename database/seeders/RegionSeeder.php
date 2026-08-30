<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $sqlFile = database_path('wilayah/wilayah.sql');

        if (! file_exists($sqlFile)) {
            $this->command->error("File tidak ditemukan: {$sqlFile}");
            return;
        }

        $content = file_get_contents($sqlFile);

        /*
         * Kita hanya mengambil:
         *
         * 52      Nusa Tenggara Barat
         * 52.01   Kabupaten Lombok Barat
         * 52.71   Kota Mataram
         *
         * beserta seluruh kecamatan dan desa/kelurahannya.
         */

        preg_match_all(
            "/\('([^']+)','([^']+)'\)/",
            $content,
            $matches,
            PREG_SET_ORDER
        );

        $regions = [];

        foreach ($matches as $match) {
            $code = $match[1];
            $name = $match[2];

            /*
             * Hilangkan titik dari kode wilayah.
             *
             * 52.01.01       -> 520101
             * 52.71.01.1004  -> 5271011004
             */
            $normalizedCode = str_replace('.', '', $code);

            /*
             * Tentukan wilayah yang kita butuhkan.
             */
            $isProvince = $code === '52';

            $isLombokBarat =
                str_starts_with($code, '52.01');

            $isMataram =
                str_starts_with($code, '52.71');

            if (! $isProvince && ! $isLombokBarat && ! $isMataram) {
                continue;
            }

            /*
             * Tentukan level berdasarkan struktur kode.
             */
            if (strlen($normalizedCode) === 2) {
                $level = 'province';
                $parentCode = null;
            } elseif (strlen($normalizedCode) === 4) {
                $level = 'regency';

                $parentCode = substr(
                    $normalizedCode,
                    0,
                    2
                );
            } elseif (strlen($normalizedCode) === 6) {
                $level = 'district';

                $parentCode = substr(
                    $normalizedCode,
                    0,
                    4
                );
            } elseif (strlen($normalizedCode) === 10) {
                $level = 'village';

                $parentCode = substr(
                    $normalizedCode,
                    0,
                    6
                );
            } else {
                continue;
            }

            $regions[] = [
                'code' => $normalizedCode,
                'name' => $name,
                'level' => $level,
                'parent_code' => $parentCode,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        /*
         * Pastikan tidak ada kode yang sama.
         */
        $regions = collect($regions)
            ->unique('code')
            ->values()
            ->all();

        DB::transaction(function () use ($regions) {

            /*
             * Hapus data wilayah lama.
             *
             * Hanya data yang berada di dalam
             * cakupan NTB / Lombok Barat / Mataram.
             */
            Region::query()->delete();

            /*
             * Insert secara bertahap agar ringan
             * untuk PostgreSQL/CasaOS.
             */
            foreach (array_chunk($regions, 500) as $chunk) {
                Region::insert($chunk);
            }
        });

        $this->command->info(
            'Import wilayah selesai: ' . count($regions) . ' data.'
        );

        $this->command->table(
            ['Level', 'Jumlah'],
            [
                [
                    'Province',
                    collect($regions)->where('level', 'province')->count(),
                ],
                [
                    'Regency',
                    collect($regions)->where('level', 'regency')->count(),
                ],
                [
                    'District',
                    collect($regions)->where('level', 'district')->count(),
                ],
                [
                    'Village',
                    collect($regions)->where('level', 'village')->count(),
                ],
            ]
        );
    }
}
