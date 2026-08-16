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
            ->with([
                'registrationPaths' => function ($query) {
                    $query->where(
                        'registration_paths.id',
                        $this->registration_path_id
                    );
                },
            ])
            ->orderBy('id')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Dokumen yang dikonfigurasi untuk jalur aktif
    |--------------------------------------------------------------------------
    */

    protected function getConfiguredDocumentTypes()
    {
        if (! $this->registration_path_id) {
            return collect();
        }

        return collect($this->documentTypes)
            ->filter(function ($documentType) {
                $pivot = $documentType->registrationPaths
                    ->firstWhere(
                        'id',
                        $this->registration_path_id
                    )?->pivot;

                return $pivot
                    && (bool) $pivot->is_active
                    && (bool) $pivot->show_in_upload;
            })
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | Mapping Jenis Dokumen ke Property Livewire
    |--------------------------------------------------------------------------
    */

    protected function getDocumentProperty(string $documentTypeName): ?string
    {
        return match ($documentTypeName) {
            'Kartu Keluarga' => 'document_kk',
            'Akta Kelahiran' => 'document_birth_certificate',
            'KTP Ayah' => 'document_father_ktp',
            'KTP Ibu' => 'document_mother_ktp',
            'KTP Wali' => 'document_guardian_ktp',
            'Ijazah' => 'document_diploma',
            'Dokumen Pendukung' => 'document_supporting',
            default => null,
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Validasi Step 7
    |--------------------------------------------------------------------------
    */

    protected function validateStepSeven(): void
    {
        $rules = [];

        $configuredDocuments = $this->getConfiguredDocumentTypes();

        /*
        |--------------------------------------------------------------------------
        | Tidak ada persyaratan
        |--------------------------------------------------------------------------
        |
        | Jika Admin belum mengatur dokumen untuk jalur tersebut,
        | maka Step 7 tidak memiliki dokumen yang wajib divalidasi.
        |
        */

        if ($configuredDocuments->isEmpty()) {
            return;
        }

        foreach ($configuredDocuments as $documentType) {

            $documentProperty = $this->getDocumentProperty(
                $documentType->name
            );

            if (! $documentProperty) {
                continue;
            }

            $pivot = $documentType->registrationPaths
                ->firstWhere(
                    'id',
                    $this->registration_path_id
                )?->pivot;

            if (! $pivot) {
                continue;
            }

            $isRequired = (bool) $pivot->is_required;

            /*
            |--------------------------------------------------------------------------
            | KTP Wali
            |--------------------------------------------------------------------------
            |
            | KTP Wali hanya diproses jika calon murid memang
            | memiliki atau tinggal bersama wali.
            |
            */

            if ($documentType->name === 'KTP Wali') {

                $guardianRequired = in_array(
                    $this->guardian_status,
                    [
                        'has_guardian',
                        'lives_with_guardian',
                    ],
                    true
                );

                if (! $guardianRequired) {
                    $this->document_guardian_ktp = null;

                    continue;
                }
            }

            $rules[$documentProperty] = [
                $isRequired ? 'required' : 'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if (! empty($rules)) {
            $this->validate($rules);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Seluruh Dokumen
    |--------------------------------------------------------------------------
    */

    protected function saveDocuments(Registration $registration): void
    {
        $uploadService = app(DocumentUploadService::class);

        $configuredDocuments = $this->getConfiguredDocumentTypes();

        /*
        |--------------------------------------------------------------------------
        | Simpan hanya dokumen yang dikonfigurasi Admin
        |--------------------------------------------------------------------------
        */

        foreach ($configuredDocuments as $documentType) {

            $documentProperty = $this->getDocumentProperty(
                $documentType->name
            );

            if (! $documentProperty) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | KTP Wali
            |--------------------------------------------------------------------------
            */

            if ($documentType->name === 'KTP Wali') {

                $guardianRequired = in_array(
                    $this->guardian_status,
                    [
                        'has_guardian',
                        'lives_with_guardian',
                    ],
                    true
                );

                if (! $guardianRequired) {
                    continue;
                }
            }

            $file = $this->{$documentProperty};

            if (! $file instanceof UploadedFile) {
                continue;
            }

            $uploadService->upload(
                $registration,
                $documentType->id,
                $file
            );
        }
    }
}
