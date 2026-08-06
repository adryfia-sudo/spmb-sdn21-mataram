<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

class NextcloudService
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;
    protected string $rootFolder;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('nextcloud.url'), '/');
        $this->username = config('nextcloud.username');
        $this->password = config('nextcloud.password');
        $this->rootFolder = trim(config('nextcloud.folder', 'SPMB'), '/');
    }

    /**
     * WebDAV Endpoint
     */
    protected function endpoint(string $path = ''): string
    {
        $path = ltrim($path, '/');

        return "{$this->baseUrl}/remote.php/dav/files/{$this->username}/{$path}";
    }

    /**
     * HTTP Client
     */
    protected function client()
    {
        return Http::withBasicAuth(
            $this->username,
            $this->password
        );
    }

    /**
     * Mengecek koneksi ke Nextcloud
     */
    public function testConnection(): bool
    {
        try {

            $response = $this->client()
                ->send('PROPFIND', $this->endpoint(), [
                    'headers' => [
                        'Depth' => 0,
                    ],
                ]);

            return $response->successful();

        } catch (\Throwable $e) {

            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Membuat folder jika belum ada
     */
    public function createFolder(string $folder): bool
    {
        $folder = trim($folder, '/');

        $response = $this->client()
            ->send(
                'MKCOL',
                $this->endpoint($folder)
            );

        return in_array(
            $response->status(),
            [201, 405]
        );
    }

    /**
     * Membuat struktur folder:
     *
     * SPMB/
     *      2026/
     *          SPMB260800001/
     */
    public function prepareRegistrationFolder(
        string $academicYear,
        string $registrationNumber
    ): string {

        $root = $this->rootFolder;

        $year = "{$root}/{$academicYear}";

        $folder = "{$year}/{$registrationNumber}";

        $this->createFolder($root);

        $this->createFolder($year);

        $this->createFolder($folder);

        return $folder;
    }

    /**
     * Upload File
     */
    public function upload(
        UploadedFile $file,
        string $folder,
        ?string $fileName = null
    ): array {

        $fileName ??= Str::uuid().'.'.$file->extension();

        $remotePath = trim($folder,'/').'/'.$fileName;

        $response = $this->client()
            ->attach(
                'file',
                fopen(
                    $file->getRealPath(),
                    'r'
                ),
                $fileName
            )
            ->put(
                $this->endpoint($remotePath),
                file_get_contents(
                    $file->getRealPath()
                )
            );

        if (!$response->successful()) {

            throw new RuntimeException(
                'Upload gagal ke Nextcloud'
            );
        }

        return [

            'original_name' => $file->getClientOriginalName(),

            'file_name' => $fileName,

            'file_path' => '/'.$remotePath,

            'mime_type' => $file->getMimeType(),

            'size' => $file->getSize(),

        ];
    }

    /**
     * Download File
     */
    public function download(string $path): Response
    {
        return $this->client()
            ->get(
                $this->endpoint(
                    trim($path,'/')
                )
            );
    }

    /**
     * Hapus File
     */
    public function delete(string $path): bool
    {
        $response = $this->client()
            ->delete(
                $this->endpoint(
                    trim($path,'/')
                )
            );

        return $response->successful();
    }

    /**
     * Rename File
     */
    public function move(
        string $oldPath,
        string $newPath
    ): bool {

        $response = $this->client()
            ->send(
                'MOVE',
                $this->endpoint(
                    trim($oldPath,'/')
                ),
                [
                    'headers' => [
                        'Destination' => $this->endpoint(
                            trim($newPath,'/')
                        ),
                    ],
                ]
            );

        return $response->successful();
    }

    /**
     * Cek apakah file ada
     */
    public function exists(string $path): bool
    {
        $response = $this->client()
            ->send(
                'PROPFIND',
                $this->endpoint(
                    trim($path,'/')
                ),
                [
                    'headers' => [
                        'Depth' => 0,
                    ],
                ]
            );

        return $response->successful();
    }

    /**
     * Mendapatkan URL WebDAV
     */
    public function getPath(string $path): string
    {
        return $this->endpoint(
            trim($path,'/')
        );
    }

    /**
     * Mendapatkan URL yang dapat dibuka dari browser
     */
    public function publicUrl(string $path): string
    {
        return "{$this->baseUrl}/f/".trim($path,'/');
    }
}
