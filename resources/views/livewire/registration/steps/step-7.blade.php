<div class="card">

<div class="card-header">
    <h4 class="mb-0">
        Dokumen & Persyaratan Verifikasi
    </h4>
</div>

<div class="card-body">

    @php
        /*
        |--------------------------------------------------------------------------
        | Persyaratan untuk jalur pendaftaran aktif
        |--------------------------------------------------------------------------
        */

        $pathRequirements = collect($documentTypes ?? [])
            ->map(function ($documentType) {

                $pivot = $documentType->registrationPaths
                    ->firstWhere(
                        'id',
                        $this->registration_path_id
                    )?->pivot;

                return [
                    'documentType' => $documentType,
                    'pivot' => $pivot,
                ];
            })
            ->filter(function ($item) {
                return $item['pivot']
                    && (bool) $item['pivot']->is_active;
            });


        /*
        |--------------------------------------------------------------------------
        | Dokumen yang harus di-upload
        |--------------------------------------------------------------------------
        */

        $uploadDocuments = $pathRequirements
            ->filter(function ($item) {
                return (bool) $item['pivot']->show_in_upload;
            });


        /*
        |--------------------------------------------------------------------------
        | Persyaratan yang harus dibawa ke sekolah
        |--------------------------------------------------------------------------
        */

        $verificationDocuments = $pathRequirements
            ->filter(function ($item) {
                return (bool) $item['pivot']->is_verification_required;
            });
    @endphp


    {{-- ========================================================= --}}
    {{-- BAGIAN 1 : DOKUMEN UPLOAD --}}
    {{-- ========================================================= --}}

    @if($uploadDocuments->isNotEmpty())

        <div class="alert alert-info mb-4">

            <strong>Dokumen yang perlu di-upload</strong>

            <br>

            Format file:
            <strong>PDF</strong>,
            maksimal
            <strong>5 MB</strong>
            per dokumen.

        </div>


        <h5 class="fw-bold mb-3">
            Dokumen Upload
        </h5>


        @foreach($uploadDocuments as $item)

            @php

                $documentType = $item['documentType'];
                $pivot = $item['pivot'];

                $isRequired = (bool) $pivot->is_required;

                /*
                |--------------------------------------------------------------------------
                | Mapping Document Type → Property Livewire
                |--------------------------------------------------------------------------
                */

                $documentProperty = match ($documentType->name) {

                    'Kartu Keluarga'
                        => 'document_kk',

                    'Akta Kelahiran'
                        => 'document_birth_certificate',

                    'KTP Ayah'
                        => 'document_father_ktp',

                    'KTP Ibu'
                        => 'document_mother_ktp',

                    'KTP Wali'
                        => 'document_guardian_ktp',

                    'Ijazah'
                        => 'document_diploma',

                    'Dokumen Pendukung'
                        => 'document_supporting',

                    default => null,
                };


                /*
                |--------------------------------------------------------------------------
                | KTP Wali
                |--------------------------------------------------------------------------
                */

                $isGuardianDocument =
                    $documentType->name === 'KTP Wali';

                $guardianRequired = in_array(
                    $guardian_status,
                    [
                        'has_guardian',
                        'lives_with_guardian',
                    ],
                    true
                );


                $showDocument =
                    $documentProperty !== null
                    && (
                        ! $isGuardianDocument
                        || $guardianRequired
                    );

            @endphp


            @if($showDocument)

                <div class="mb-4">

                    <label class="form-label fw-bold">

                        {{ $documentType->name }}

                        @if($isRequired)

                            <span class="text-danger">
                                *
                            </span>

                        @else

                            <span class="text-muted">
                                (Opsional)
                            </span>

                        @endif

                    </label>


                    <input
                        type="file"
                        class="form-control"
                        wire:model="{{ $documentProperty }}"
                        accept="application/pdf"
                    >


                    @if($isRequired)

                        <div class="form-text">
                            Wajib — format PDF, maksimal 5 MB.
                        </div>

                    @else

                        <div class="form-text">
                            Tidak wajib — format PDF, maksimal 5 MB.
                        </div>

                    @endif


                    @error($documentProperty)

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror


                    @if($this->{$documentProperty})

                        <div class="text-success small mt-2">

                            ✓
                            {{ $this->{$documentProperty}->getClientOriginalName() }}

                        </div>

                    @endif

                </div>

            @endif

        @endforeach


    @else

        <div class="alert alert-secondary mb-4">

            <strong>
                Tidak ada dokumen yang perlu di-upload.
            </strong>

            <br>

            Silakan periksa persyaratan yang harus dibawa
            ke sekolah pada bagian di bawah.

        </div>

    @endif



    {{-- ========================================================= --}}
    {{-- PEMBATAS --}}
    {{-- ========================================================= --}}

    @if(
        $uploadDocuments->isNotEmpty()
        && $verificationDocuments->isNotEmpty()
    )

        <hr class="my-4">

    @endif



    {{-- ========================================================= --}}
    {{-- BAGIAN 2 : PERSYARATAN VERIFIKASI --}}
    {{-- ========================================================= --}}

    @if($verificationDocuments->isNotEmpty())

        <div class="alert alert-warning mb-4">

            <h5 class="fw-bold mb-2">
                📋 Persyaratan yang Wajib Dibawa ke Sekolah
            </h5>

            <p class="mb-0">

                Dokumen berikut
                <strong>tidak perlu di-upload</strong>.

                Harap membawa dokumen asli
                sesuai ketentuan saat proses verifikasi
                pendaftaran di sekolah.

            </p>

        </div>


        <div class="list-group mb-4">

            @foreach($verificationDocuments as $item)

                @php

                    $documentType = $item['documentType'];
                    $pivot = $item['pivot'];

                    $isRequired =
                        (bool) $pivot->is_required;

                    $isGuardianDocument =
                        $documentType->name === 'KTP Wali';

                    $guardianRequired = in_array(
                        $guardian_status,
                        [
                            'has_guardian',
                            'lives_with_guardian',
                        ],
                        true
                    );

                @endphp


                @if(
                    ! $isGuardianDocument
                    || $guardianRequired
                )

                    <div class="list-group-item">

                        <div class="d-flex align-items-start">

                            <div class="me-3 fs-4">
                                📄
                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-bold">

                                    {{ $documentType->name }}

                                    @if($isRequired)

                                        <span class="text-danger">
                                            *
                                        </span>

                                    @endif

                                </div>


                                @if(!empty($pivot->notes))

                                    <div class="small text-muted mt-1">

                                        {{ $pivot->notes }}

                                    </div>

                                @else

                                    <div class="small text-muted mt-1">

                                        Wajib dibawa saat verifikasi
                                        di sekolah.

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    @elseif($uploadDocuments->isEmpty())

        <div class="alert alert-warning">

            <strong>
                Belum ada persyaratan yang dikonfigurasi.
            </strong>

            <br>

            Administrator belum mengatur dokumen upload
            maupun persyaratan verifikasi untuk jalur
            pendaftaran ini.

        </div>

    @endif


</div>
</div>
