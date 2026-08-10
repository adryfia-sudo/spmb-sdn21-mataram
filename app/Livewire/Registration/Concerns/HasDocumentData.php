<?php

namespace App\Livewire\Registration\Concerns;

use App\Models\DocumentType;
use App\Models\Registration;
use App\Services\DocumentUploadService;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;

trait HasDocumentData
{
    use WithFileUploads;

    /*
    |--------------------------------------------------------------------------
    | Dokumen
    |--------------------------------------------------------------------------
    */

    public $document_kk = null;

    public $document_birth_certificate = null;

    public $document_father_ktp = null;

    public $document_mother_ktp = null;

    public $document_guardian_ktp = null;

    public $document_diploma = null;

    public $document_supporting = null;

    /*
    |--------------------------------------------------------------------------
    | Daftar Jenis Dokumen
    |--------------------------------------------------------------------------
    */

    public $documentTypes = [];

    /*
    |--------------------------------------------------------------------------
    | Inisialisasi Data Dokumen
    |--------------------------------------------------------------------------
    */

    public function initializeDocumentData(): void
    {
        $this->documentTypes = DocumentType::query()
            ->orderBy('id')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Validasi Step 7
    |--------------------------------------------------------------------------
    */

    protected function validateStepSeven(): void
    {
        $rules = [

            /*
            |--------------------------------------------------------------------------
            | KK
            |--------------------------------------------------------------------------
            */

            'document_kk' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | Akta Kelahiran
            |--------------------------------------------------------------------------
            */

            'document_birth_certificate' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | KTP Ayah
            |--------------------------------------------------------------------------
            */

            'document_father_ktp' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | KTP Ibu
            |--------------------------------------------------------------------------
            */

            'document_mother_ktp' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | Ijazah
            |--------------------------------------------------------------------------
            |
            | Tidak wajib.
            |
            */

            'document_diploma' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | Dokumen Pendukung
            |--------------------------------------------------------------------------
            |
            | Tidak wajib.
            |
            */

            'document_supporting' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | KTP Wali
        |--------------------------------------------------------------------------
        |
        | Wajib hanya jika calon murid:
        | - memiliki wali
        | - tinggal bersama wali
        |
        */

        if (
            in_array(
                $this->guardian_status,
                ['has_guardian', 'lives_with_guardian'],
                true
            )
        ) {
            $rules['document_guardian_ktp'] = [
                'required',
                'file',
                'mimes:pdf',
                'max:5120',
            ];
        } else {
            $this->document_guardian_ktp = null;
        }

        $this->validate($rules);
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Seluruh Dokumen
    |--------------------------------------------------------------------------
    */

    protected function saveDocuments(Registration $registration): void
    {
        $uploadService = app(DocumentUploadService::class);

        /*
        |--------------------------------------------------------------------------
        | KK
        |--------------------------------------------------------------------------
        */

        if ($this->document_kk instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'Kartu Keluarga',
                $this->document_kk
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Akta Kelahiran
        |--------------------------------------------------------------------------
        */

        if ($this->document_birth_certificate instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'Akta Kelahiran',
                $this->document_birth_certificate
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KTP Ayah
        |--------------------------------------------------------------------------
        */

        if ($this->document_father_ktp instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'KTP Ayah',
                $this->document_father_ktp
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KTP Ibu
        |--------------------------------------------------------------------------
        */

        if ($this->document_mother_ktp instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'KTP Ibu',
                $this->document_mother_ktp
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KTP Wali
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $this->guardian_status,
                ['has_guardian', 'lives_with_guardian'],
                true
            )
            && $this->document_guardian_ktp instanceof UploadedFile
        ) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'KTP Wali',
                $this->document_guardian_ktp
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Ijazah
        |--------------------------------------------------------------------------
        */

        if ($this->document_diploma instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'Ijazah',
                $this->document_diploma
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Dokumen Pendukung
        |--------------------------------------------------------------------------
        */

        if ($this->document_supporting instanceof UploadedFile) {
            $this->uploadDocument(
                $uploadService,
                $registration,
                'Dokumen Pendukung',
                $this->document_supporting
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Satu Dokumen
    |--------------------------------------------------------------------------
    */

    protected function uploadDocument(
        DocumentUploadService $uploadService,
        Registration $registration,
        string $documentTypeName,
        UploadedFile $file
    ): void {
        $documentType = DocumentType::query()
            ->where('name', $documentTypeName)
            ->first();

        if (! $documentType) {
            throw new \RuntimeException(
                "Jenis dokumen '{$documentTypeName}' belum tersedia."
            );
        }

        $uploadService->upload(
            $registration,
            $documentType->id,
            $file
        );
    }
}
