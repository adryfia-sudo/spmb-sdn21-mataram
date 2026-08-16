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
    {{-- PROGRESS STEP 1 - 8 --}}
    {{-- ========================================================= --}}

    @if($step <= 8)

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


        {{-- ===================================================== --}}
        {{-- ISI STEP 1 - 8 --}}
        {{-- ===================================================== --}}

        @includeIf('livewire.registration.steps.step-' . $step)


        {{-- ===================================================== --}}
        {{-- NAVIGASI STEP 1 - 7 --}}
        {{-- ===================================================== --}}

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

    @endif


    {{-- ========================================================= --}}
    {{-- STEP 9 - PENDAFTARAN BERHASIL --}}
    {{-- ========================================================= --}}

    @if($step === 9)

        <div class="card border-success shadow-sm">

            <div class="card-body text-center py-5">

                {{-- Icon --}}
                <div class="mb-4">

                    <span
                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white"
                        style="width: 70px; height: 70px; font-size: 35px;">

                        ✓

                    </span>

                </div>


                {{-- Judul --}}
                <h3 class="text-success fw-bold mb-3">
                    Pendaftaran Berhasil
                </h3>


                <p class="text-muted mb-4">
                    Pendaftaran peserta didik berhasil disimpan.
                </p>


                {{-- Pesan sukses --}}
                @if(session('registration_success'))

                    <div class="alert alert-success">
                        {{ session('registration_success') }}
                    </div>

                @endif


                {{-- Nomor pendaftaran --}}
                @if($registration)

                    <div class="alert alert-info mb-4">

                        <div class="small text-muted mb-1">
                            Nomor Pendaftaran
                        </div>

                        <div class="fs-3 fw-bold">
                            {{ $registration->registration_number }}
                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TOMBOL BUKTI PENDAFTARAN --}}
                    {{-- ================================================= --}}

                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                        {{-- Preview --}}
                        <a
                            href="{{ route('registration.proof.preview', $registration) }}"
                            target="_blank"
                            class="btn btn-primary">

                            👁️ Preview Bukti Pendaftaran

                        </a>


                        {{-- Download --}}
                        <a
                            href="{{ route('registration.proof.download', $registration) }}"
                            class="btn btn-success">

                            ⬇️ Download Bukti Pendaftaran

                        </a>

                    </div>


                    <div class="mt-3 text-muted small">

                        Silakan simpan atau cetak bukti pendaftaran ini.

                    </div>

                @else

                    <div class="alert alert-warning">

                        Data pendaftaran tidak ditemukan.

                    </div>

                @endif

            </div>

        </div>

    @endif

</div>
