<?php

namespace App\Console\Commands;

use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportRegions extends Command
{
    protected $signature = 'regions:import';

    protected $description = 'Import data wilayah NTB dari kodewilayah.web.id';

    private const BASE_URL = 'https://api.kodewilayah.web.id';

    private const PROVINCE_CODE = '52';

    /**
     * Jeda normal antar request dalam detik.
     *
     * Kita sengaja menggunakan jeda agar tidak membebani API.
     */
    private const REQUEST_DELAY = 2;

    public function handle(): int
    {
        $this->info('==============================================');
        $this->info(' IMPORT WILAYAH NUSA TENGGARA BARAT');
        $this->info('==============================================');
        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | 1. Provinsi NTB
        |--------------------------------------------------------------------------
        */

        $this->info('Menyimpan Provinsi...');

        Region::updateOrCreate(
            [
                'code' => self::PROVINCE_CODE,
            ],
            [
                'name' => 'Nusa Tenggara Barat',
                'level' => 'province',
                'parent_code' => null,
            ]
        );

        $this->info('✓ Nusa Tenggara Barat (52)');
        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | 2. Kabupaten / Kota
        |--------------------------------------------------------------------------
        */

        $this->info('Mengambil Kabupaten/Kota NTB...');

        $regencies = $this->getData(
            self::BASE_URL . '/regencies/' . self::PROVINCE_CODE
        );

        if ($regencies === null) {
            $this->error('Gagal mengambil Kabupaten/Kota.');

            return self::FAILURE;
        }

        $this->info(
            'Ditemukan ' . count($regencies) . ' Kabupaten/Kota.'
        );

        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | 3. Proses Kabupaten / Kota
        |--------------------------------------------------------------------------
        */

        foreach ($regencies as $regencyIndex => $regency) {

            $regencyCode = (string) $regency['code'];
            $regencyName = $regency['name'];

            $this->info(
                '[' . ($regencyIndex + 1) . '/' . count($regencies) . '] ' .
                $regencyName .
                ' (' . $regencyCode . ')'
            );

            Region::updateOrCreate(
                [
                    'code' => $regencyCode,
                ],
                [
                    'name' => $regencyName,
                    'level' => 'regency',
                    'parent_code' => self::PROVINCE_CODE,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Ambil Kecamatan
            |--------------------------------------------------------------------------
            */

            $districts = $this->getData(
                self::BASE_URL . '/districts/' . $regencyCode
            );

            if ($districts === null) {

                $this->warn(
                    '  ⚠ Kecamatan gagal diambil. Dilanjutkan.'
                );

                continue;
            }

            $this->line(
                '  Kecamatan: ' . count($districts)
            );

            /*
            |--------------------------------------------------------------------------
            | Proses Kecamatan
            |--------------------------------------------------------------------------
            */

            foreach ($districts as $districtIndex => $district) {

                $districtCode = (string) $district['code'];
                $districtName = $district['name'];

                Region::updateOrCreate(
                    [
                        'code' => $districtCode,
                    ],
                    [
                        'name' => $districtName,
                        'level' => 'district',
                        'parent_code' => $regencyCode,
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Ambil Desa / Kelurahan
                |--------------------------------------------------------------------------
                */

                $villages = $this->getData(
                    self::BASE_URL . '/villages/' . $districtCode
                );

                if ($villages === null) {

                    $this->warn(
                        '    ⚠ Desa/Kelurahan gagal: ' .
                        $districtName
                    );

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Simpan Desa / Kelurahan
                |--------------------------------------------------------------------------
                */

                foreach ($villages as $village) {

                    Region::updateOrCreate(
                        [
                            'code' => (string) $village['code'],
                        ],
                        [
                            'name' => $village['name'],
                            'level' => 'village',
                            'parent_code' => $districtCode,
                        ]
                    );
                }

                $this->line(
                    '    ✓ ' .
                    $districtName .
                    ' → ' .
                    count($villages) .
                    ' desa/kelurahan'
                );
            }

            $this->newLine();

            /*
            |--------------------------------------------------------------------------
            | Jeda antar Kabupaten/Kota
            |--------------------------------------------------------------------------
            */

            sleep(self::REQUEST_DELAY);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Ringkasan
        |--------------------------------------------------------------------------
        */

        $this->newLine();

        $this->info('==============================================');
        $this->info(' IMPORT SELESAI');
        $this->info('==============================================');

        $this->table(
            ['Level', 'Jumlah'],
            [
                [
                    'Provinsi',
                    Region::where('level', 'province')->count(),
                ],
                [
                    'Kabupaten/Kota',
                    Region::where('level', 'regency')->count(),
                ],
                [
                    'Kecamatan',
                    Region::where('level', 'district')->count(),
                ],
                [
                    'Kelurahan/Desa',
                    Region::where('level', 'village')->count(),
                ],
            ]
        );

        return self::SUCCESS;
    }

    /**
     * Mengambil data dari API.
     *
     * Jika mendapatkan HTTP 429:
     * - membaca Retry-After
     * - menunggu sesuai instruksi server
     * - mencoba kembali
     */
    private function getData(string $url): ?array
    {
        $maxAttempts = 5;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {

            try {

                /*
                |--------------------------------------------------------------------------
                | Jeda sebelum request
                |--------------------------------------------------------------------------
                */

                if ($attempt > 1) {
                    sleep(self::REQUEST_DELAY);
                }

                $response = Http::timeout(60)
                    ->acceptJson()
                    ->get($url);

                /*
                |--------------------------------------------------------------------------
                | Berhasil
                |--------------------------------------------------------------------------
                */

                if ($response->successful()) {

                    $json = $response->json();

                    if (
                        isset($json['data']) &&
                        is_array($json['data'])
                    ) {
                        return $json['data'];
                    }

                    $this->error(
                        'Format response API tidak sesuai.'
                    );

                    return null;
                }

                /*
                |--------------------------------------------------------------------------
                | Rate Limit 429
                |--------------------------------------------------------------------------
                */

                if ($response->status() === 429) {

                    $retryAfter = $response->header('Retry-After');

                    $waitSeconds = is_numeric($retryAfter)
                        ? (int) $retryAfter
                        : 72;

                    /*
                    |--------------------------------------------------------------------------
                    | Batas keamanan
                    |--------------------------------------------------------------------------
                    |
                    | Kita tidak ingin PHP menunggu berjam-jam.
                    |
                    */

                    $waitSeconds = min(
                        max($waitSeconds, 5),
                        180
                    );

                    $this->warn(
                        '  ⚠ API rate limit (429).'
                    );

                    $this->warn(
                        '  Menunggu ' .
                        $waitSeconds .
                        ' detik...'
                    );

                    sleep($waitSeconds);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Error HTTP lainnya
                |--------------------------------------------------------------------------
                */

                $this->warn(
                    '  HTTP ' .
                    $response->status() .
                    ' pada: ' .
                    $url
                );

                return null;

            } catch (\Throwable $e) {

                $this->warn(
                    '  Gagal menghubungi API: ' .
                    $e->getMessage()
                );

                if ($attempt < $maxAttempts) {

                    $this->warn(
                        '  Mencoba kembali... (' .
                        $attempt .
                        '/' .
                        $maxAttempts .
                        ')'
                    );

                    sleep(self::REQUEST_DELAY);

                    continue;
                }

                return null;
            }
        }

        return null;
    }
}
