<div class="card-header">
    <h4 class="mb-0">
        Upload Dokumen
    </h4>
</div>

<div class="card-body">

    <div class="alert alert-info">
        <strong>Format file:</strong> PDF
        <br>
        <strong>Maksimal:</strong> 5 MB per dokumen
    </div>


    {{-- KK --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            Kartu Keluarga
            <span class="text-danger">*</span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_kk"
            accept="application/pdf">

        <div class="form-text">
            Wajib — format PDF, maksimal 5 MB.
        </div>

        @error('document_kk')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_kk)
            <div class="text-success small mt-2">
                ✓ {{ $document_kk->getClientOriginalName() }}
            </div>
        @endif

    </div>


    {{-- Akta --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            Akta Kelahiran
            <span class="text-danger">*</span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_birth_certificate"
            accept="application/pdf">

        <div class="form-text">
            Wajib — format PDF, maksimal 5 MB.
        </div>

        @error('document_birth_certificate')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_birth_certificate)
            <div class="text-success small mt-2">
                ✓ {{ $document_birth_certificate->getClientOriginalName() }}
            </div>
        @endif

    </div>


    {{-- KTP Ayah --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            KTP Ayah
            <span class="text-danger">*</span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_father_ktp"
            accept="application/pdf">

        <div class="form-text">
            Wajib — format PDF, maksimal 5 MB.
        </div>

        @error('document_father_ktp')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_father_ktp)
            <div class="text-success small mt-2">
                ✓ {{ $document_father_ktp->getClientOriginalName() }}
            </div>
        @endif

    </div>


    {{-- KTP Ibu --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            KTP Ibu
            <span class="text-danger">*</span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_mother_ktp"
            accept="application/pdf">

        <div class="form-text">
            Wajib — format PDF, maksimal 5 MB.
        </div>

        @error('document_mother_ktp')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_mother_ktp)
            <div class="text-success small mt-2">
                ✓ {{ $document_mother_ktp->getClientOriginalName() }}
            </div>
        @endif

    </div>


    {{-- KTP Wali --}}
    @if(in_array($guardian_status, ['has_guardian', 'lives_with_guardian'], true))

        <div class="mb-4">

            <label class="form-label fw-bold">
                KTP Wali
                <span class="text-danger">*</span>
            </label>

            <input
                type="file"
                class="form-control"
                wire:model="document_guardian_ktp"
                accept="application/pdf">

            <div class="form-text">
                Wajib karena calon murid memiliki/tinggal bersama wali.
            </div>

            @error('document_guardian_ktp')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

            @if($document_guardian_ktp)
                <div class="text-success small mt-2">
                    ✓ {{ $document_guardian_ktp->getClientOriginalName() }}
                </div>
            @endif

        </div>

    @endif


    {{-- Ijazah --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            Ijazah
            <span class="text-muted">
                (Opsional)
            </span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_diploma"
            accept="application/pdf">

        <div class="form-text">
            Tidak wajib. Upload jika memiliki ijazah.
        </div>

        @error('document_diploma')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_diploma)
            <div class="text-success small mt-2">
                ✓ {{ $document_diploma->getClientOriginalName() }}
            </div>
        @endif

    </div>


    {{-- Dokumen Pendukung --}}
    <div class="mb-4">

        <label class="form-label fw-bold">
            Dokumen Pendukung
            <span class="text-muted">
                (Opsional)
            </span>
        </label>

        <input
            type="file"
            class="form-control"
            wire:model="document_supporting"
            accept="application/pdf">

        <div class="form-text">
            Dokumen tambahan jika diperlukan.
        </div>

        @error('document_supporting')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

        @if($document_supporting)
            <div class="text-success small mt-2">
                ✓ {{ $document_supporting->getClientOriginalName() }}
            </div>
        @endif

    </div>

</div>
