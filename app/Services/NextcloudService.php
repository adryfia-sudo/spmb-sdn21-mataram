<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NextcloudService
{
    protected string $baseUrl;

    protected string $username;

    protected string $password;

    protected string $basePath;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            config('services.nextcloud.webdav_url'),
            '/'
        );

        $this->username = config(
            'services.nextcloud.username'
        );

        $this->password = config(
            'services.nextcloud.password'
        );

        $this->basePath = trim(
            config('services.nextcloud.path', 'spmb'),
            '/'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Membuat folder pendaftaran
    |--------------------------------------------------------------------------
    */

    public function prepareRegistrationFolder(
        string $academicYear,
        ?string $registrationNumber
    ): string {

        $academicYear = trim($academicYear);

        $registrationNumber = trim(
            $registrationNumber ?: 'pending'
        );

        $folder = $academicYear . '/' . $registrationNumber;

        $this->createDirectory(
            $this->basePath
            . '/'
            . $academicYear
        );

        $this->createDirectory(
            $this->basePath
            . '/'
            . $folder
        );

        return $folder;
    }

    /*
    |--------------------------------------------------------------------------
    | Upload file
    |--------------------------------------------------------------------------
    */

    public function upload(
        UploadedFile $file,
        string $folder,
        string $filename
    ): array {

        $folder = trim($folder, '/');

        /*
        |----------------------------------------------------------------------
        | Bersihkan nama file
        |----------------------------------------------------------------------
        */

        $filename = basename($filename);

        /*
        |----------------------------------------------------------------------
        | Path lengkap di Nextcloud
        |----------------------------------------------------------------------
        */

        $remotePath =
            $this->basePath
            . '/'
            . $folder
            . '/'
            . $filename;

        $url = $this->baseUrl . '/' . $remotePath;

        /*
        |----------------------------------------------------------------------
        | Upload menggunakan WebDAV PUT
        |----------------------------------------------------------------------
        */

        $response = Http::withBasicAuth(
                $this->username,
                $this->password
            )
            ->withBody(
                file_get_contents(
                    $file->getRealPath()
                ),
                $file->getMimeType()
                    ?: 'application/octet-stream'
            )
            ->put($url);

        if (! $response->successful()) {
            throw new RuntimeException(
                'Gagal mengupload file ke Nextcloud. HTTP '
                . $response->status()
                . '. '
                . $response->body()
            );
        }

        /*
        |----------------------------------------------------------------------
        | Metadata untuk StudentDocument
        |----------------------------------------------------------------------
        */

        return [
            'original_name' => $file->getClientOriginalName(),

            'file_name' => $filename,

            'file_path' => $remotePath,

            'mime_type' => $file->getMimeType()
                ?: 'application/octet-stream',

            'size' => $file->getSize(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Membuat directory WebDAV
    |--------------------------------------------------------------------------
    */

    protected function createDirectory(
        string $path
    ): void {

        $path = trim($path, '/');

        $url = $this->baseUrl . '/' . $path;

        $response = Http::withBasicAuth(
                $this->username,
                $this->password
            )
            ->send(
                'MKCOL',
                $url
            );

        /*
        |----------------------------------------------------------------------
        | 201 = berhasil dibuat
        | 405 = sudah ada
        | 409 = parent directory belum tersedia
        |----------------------------------------------------------------------
        */

        if (
            ! in_array(
                $response->status(),
                [201, 405],
                true
            )
        ) {
            throw new RuntimeException(
                'Gagal membuat folder Nextcloud. HTTP '
                . $response->status()
                . '. '
                . $response->body()
            );
        }
    }
}
