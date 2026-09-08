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
                    <div class="text-muted mt-1">
                        {{ $path->description }}
                    </div>
                @endif

            </label>

        </div>

    @endforeach

    @error('registration_path_id')
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
    @enderror

</div>
