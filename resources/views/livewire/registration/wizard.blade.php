<div class="container py-5">
    
    <h2 class="mb-4">
        Pendaftaran Murid Baru
    </h2>

    <div class="alert alert-primary">
        Langkah {{ $step }} dari 8
    </div>

    @if($step == 1)

        <div class="card shadow-sm">

            <div class="card-header">
                <h4>Pilih Jalur Pendaftaran</h4>
            </div>

            <div class="card-body">


                     @foreach($paths as $path)

                    <div class="form-check border rounded p-3 mb-3">

                        <input
                            class="form-check-input"
                            type="radio"
                            wire:model="registration_path_id"
                            value="{{ $path->id }}"
                            id="path{{ $path->id }}">

                        <label
                            class="form-check-label w-100"
                            for="path{{ $path->id }}">

                            <strong>{{ $path->name }}</strong>
 @if($path->description)
                                <div class="text-muted">
                                    {{ $path->description }}
                                </div>
                            @endif

                        </label>

                    </div>

                @endforeach

                @error('registration_path_id')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    @endif
@if($step == 2)

<div class="card shadow-sm">

    <div class="card-header">
        <h4>Data Calon Murid</h4>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model.defer="full_name">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    NIK
                </label>

                <input
                    type="text"
                    maxlength="16"
                    class="form-control"
                    wire:model.defer="nik">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    NISN
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model.defer="nisn">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Nomor KK
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model.defer="family_card_number">
            </div>

        </div>

    </div>

</div>

@endif
    <div class="mt-4 d-flex justify-content-between">

        <button
            type="button"
            wire:click="previousStep"
            class="btn btn-secondary"
            @disabled($step == 1)>
            Kembali
        </button>

        <button
            type="button"
            wire:click="nextStep"
            class="btn btn-primary">

            {{ $step == 8 ? 'Simpan' : 'Lanjut' }}
  </button>

    </div>

</div>
