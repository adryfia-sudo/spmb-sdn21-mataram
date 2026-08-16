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

    @php
        /*
        |--------------------------------------------------------------------------
        | Dokumen yang dikonfigurasi untuk jalur pendaftaran
        |--------------------------------------------------------------------------
        */

        $configuredDocuments = collect($documentTypes ?? [])
            ->filter(function ($documentType) {
                $pivot = $documentType->registrationPaths
                    ->firstWhere('id', $this->registration_path_id);

                return $pivot 
                    && (bool) $pivot->pivot->is_active
                    && (bool) $pivot->pivot->show_in_upload;
            });
    @endphp

    @forelse($configuredDocuments as $documentType)

        @php
            $pivot = $documentType->registrationPaths
                ->firstWhere('id', $this->registration_path_id)?->pivot;

            $isRequired = (bool) ($pivot?->is_required ?? false);

            $documentProperty = match ($documentType->name) {
                'Kartu Keluarga' => 'document_kk',
                'Akta Kelahiran' => 'document_birth_certificate',
                'KTP Ayah' => 'document_father_ktp',
                'KTP Ibu' => 'document_mother_ktp',
                'KTP Wali' => 'document_guardian_ktp',
                'Ijazah' => 'document_diploma',
                'Dokumen Pendukung' => 'document_supporting',
                default => null,
            };

            $isGuardianDocument =
                $documentType->name === 'KTP Wali';

            $guardianRequired =
                in_array(
                    $guardian_status,
                    ['has_guardian', 'lives_with_guardian'],
                    true
                );

            $showDocument =
                $documentProperty !== null &&
                (
                    ! $isGuardianDocument ||
                    $guardianRequired
                );
        @endphp

        @if($showDocument)

            <div class="mb-4">

                <label class="form-label fw-bold">

                    {{ $documentType->name }}

                    @if($isRequired || $isGuardianDocument)
                        <span class="text-danger">*</span>
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

                @if($isGuardianDocument && $guardianRequired)
                    <div class="form-text">
                        Wajib karena calon murid memiliki/tinggal bersama wali.
                    </div>
                @elseif($isRequired)
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
                        ✓ {{ $this->{$documentProperty}->getClientOriginalName() }}
                    </div>
                @endif

            </div>

        @endif

    @empty

        <div class="alert alert-warning">
            <strong>Belum ada persyaratan dokumen.</strong>
            <br>
            Dokumen untuk jalur pendaftaran ini belum dikonfigurasi oleh administrator.
            Pendaftaran tetap dapat dilanjutkan.
        </div>

    @endforelse

</div>
