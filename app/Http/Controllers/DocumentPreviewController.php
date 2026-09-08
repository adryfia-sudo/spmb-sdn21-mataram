<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use App\Services\NextcloudService;
use Illuminate\Http\Response;

class DocumentPreviewController extends Controller
{
    public function __invoke(
        StudentDocument $document,
        NextcloudService $nextcloud
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Pastikan hanya pengguna yang sudah login
        |--------------------------------------------------------------------------
        */

        abort_unless(auth()->check(), 403);

        /*
        |--------------------------------------------------------------------------
        | Hanya user aktif yang boleh melihat dokumen
        |--------------------------------------------------------------------------
        */

        abort_unless(
            auth()->user()->is_active === true,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Ambil file dari Nextcloud
        |--------------------------------------------------------------------------
        */

        $file = $nextcloud->getFile(
            $document->file_path
        );

        /*
        |--------------------------------------------------------------------------
        | Kirim file sebagai inline
        |--------------------------------------------------------------------------
        | Browser akan mencoba menampilkan PDF / gambar
        | bukan langsung mendownload.
        |--------------------------------------------------------------------------
        */

        return response(
            $file->body(),
            200,
            [
                'Content-Type' => $document->mime_type
                    ?: 'application/octet-stream',

                'Content-Disposition' =>
                    'inline; filename="'
                    . addslashes(
                        $document->original_name
                            ?: $document->file_name
                    )
                    . '"',

                'Cache-Control' => 'private, no-store',
            ]
        );
    }
}
