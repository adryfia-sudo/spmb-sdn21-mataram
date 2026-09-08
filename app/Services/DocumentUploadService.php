<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\StudentDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class DocumentUploadService
{
    public function __construct(
        protected NextcloudService $nextcloud
    ) {
    }

    public function upload(
        Registration $registration,
        int $documentTypeId,
        UploadedFile $file
    ): StudentDocument {

        $folder = $this->nextcloud
            ->prepareRegistrationFolder(
                $registration->academicYear->name,
                $registration->registration_number
            );

        $metadata = $this->nextcloud
            ->upload(
                $file,
                $folder,
                $file->getClientOriginalName()
            );

        return DB::transaction(function () use (
            $registration,
            $documentTypeId,
            $metadata
        ) {

            return StudentDocument::create([

                'registration_id' => $registration->id,

                'document_type_id' => $documentTypeId,

                'original_name' => $metadata['original_name'],

                'file_name' => $metadata['file_name'],

                'file_path' => $metadata['file_path'],

                'mime_type' => $metadata['mime_type'],

                'size' => $metadata['size'],

                'status' => 'uploaded',

            ]);

        });
    }
}
