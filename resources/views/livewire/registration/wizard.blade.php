<div class="container py-4">

    {{-- ========================================================= --}}
    {{-- JUDUL --}}
    {{-- ========================================================= --}}

    <div class="mb-4">
        <h2 class="mb-1">
            Pendaftaran Murid Baru
        </h2>

        <p class="text-muted mb-0">
            SPMB SD Negeri 21 Mataram
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- PROGRESS --}}
    {{-- ========================================================= --}}

    <div class="progress mb-4" style="height: 24px;">

        <div
            class="progress-bar"
            role="progressbar"
            style="width: {{ ($step / 8) * 100 }}%;"
            aria-valuenow="{{ $step }}"
            aria-valuemin="1"
            aria-valuemax="8">

            Langkah {{ $step }} dari 8

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ISI STEP --}}
    {{-- ========================================================= --}}

    @includeIf('livewire.registration.steps.step-' . $step)


    {{-- ========================================================= --}}
    {{-- NAVIGASI STEP 1 - 7 --}}
    {{-- ========================================================= --}}

    @if($step < 8)

        <div class="mt-4 d-flex justify-content-between">

            {{-- Tombol Kembali --}}
            <button
                type="button"
                class="btn btn-secondary"
                wire:click="previousStep"
                @disabled($step == 1)>

                ← Kembali

            </button>


            {{-- Tombol Lanjut --}}
            <button
                type="button"
                class="btn btn-primary"
                wire:click="nextStep"
                wire:loading.attr="disabled">

                <span wire:loading.remove>
                    Lanjut
                </span>

                <span wire:loading>
                    Memproses...
                </span>

            </button>

        </div>

    @endif

</div>
@if($step === 9)

    <div class="card border-success">

        <div class="card-body text-center py-5">

            <div class="mb-4">
                <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white"
                    style="width: 70px; height: 70px; font-size: 35px;">
                    ✓
                </span>
            </div>

            <h3 class="text-success fw-bold mb-3">
                Pendaftaran Berhasil
            </h3>

            <p class="text-muted mb-4">
                Pendaftaran peserta didik berhasil disimpan.
            </p>

            @if(session('registration_success'))
                <div class="alert alert-success">
                    {{ session('registration_success') }}
                </div>
            @endif

            @if($registration)
                <div class="alert alert-info">

                    <strong>Nomor Pendaftaran</strong>

                    <div class="fs-4 fw-bold mt-2">
                        {{ $registration->registration_number }}
                    </div>

                </div>
            @endif

        </div>

    </div>

@endif
