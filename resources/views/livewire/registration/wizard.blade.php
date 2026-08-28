<div class="container py-4" wire:key="wizard-step-container-{{ $step }}">

    <div class="mb-4">
        <h2 class="mb-1">Pendaftaran Murid Baru</h2>
        <p class="text-muted mb-0">SPMB SD Negeri 21 Mataram</p>
    </div>

    @if($step >= 1 && $step <= 8)
        {{-- Progress Bar --}}
        <div class="progress mb-4" style="height: 24px;">
            <div class="progress-bar" role="progressbar" style="width: {{ ($step / 8) * 100 }}%;" aria-valuenow="{{ $step }}" aria-valuemin="1" aria-valuemax="8">
                Langkah {{ $step }} dari 8
            </div>
        </div>

        {{-- Konten Step Dinamis --}}
        <div id="step-content-container">
            @if($step === 1)
                @include('livewire.registration.steps.step-1')
            @elseif($step === 2)
                @include('livewire.registration.steps.step-2')
            @elseif($step === 3)
                @include('livewire.registration.steps.step-3')
            @elseif($step === 4)
                @include('livewire.registration.steps.step-4')
            @elseif($step === 5)
                @include('livewire.registration.steps.step-5')
            @elseif($step === 6)
                @include('livewire.registration.steps.step-6')
            @elseif($step === 7)
                @include('livewire.registration.steps.step-7')
            @elseif($step === 8)
                @include('livewire.registration.steps.step-8')
            @endif
        </div>

        {{-- Navigasi Tombol (Selalu tampil di bawah step 1-8) --}}
        <div class="mt-4 mb-4 d-flex justify-content-between align-items-center">
            <button
                type="button"
                class="btn btn-secondary"
                wire:click="previousStep"
                @disabled($step === 1)>
                ← Kembali
            </button>

            <button
                type="button"
                class="btn btn-primary"
                wire:click="nextStep"
                wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="nextStep">
                    @if($step === 8) Kirim Pendaftaran @else Lanjut → @endif
                </span>
                <span wire:loading wire:target="nextStep">Memproses...</span>
            </button>
        </div>
    @endif

    {{-- Step 9 (Halaman Selesai) --}}
    @if($step === 9)
        <div class="card border-success shadow-sm">
            <div class="card-body text-center py-5">
                <h3 class="text-success fw-bold mb-3">Pendaftaran Berhasil</h3>
                <p class="text-muted mb-4">Pendaftaran peserta didik berhasil disimpan.</p>
                
                @if($registration)
                    <div class="alert alert-info d-inline-block px-4 py-3 mb-4">
                        <div class="small text-muted mb-1">Nomor Pendaftaran</div>
                        <div class="fs-3 fw-bold">{{ $registration->registration_number }}</div>
                    </div>
                @endif

                <div class="d-flex justify-content-center gap-3 mt-3 flex-wrap">
                    @if($registration)
                        <a href="{{ route('registration.download-pdf', $registration->id) }}" class="btn btn-success btn-lg px-4" target="_blank">
                            <i class="bi bi-download me-2"></i> Download Bukti Pendaftaran
                        </a>
                    @endif

                    <a href="{{ route('registration.check-status') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="bi bi-search me-2"></i> Cek Status Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    @endif

</div>
