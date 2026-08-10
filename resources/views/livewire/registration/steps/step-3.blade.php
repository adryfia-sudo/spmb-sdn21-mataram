<div class="card shadow-sm">

    <div class="card-header">
        <h4 class="mb-0">
            Alamat Tempat Tinggal
        </h4>
    </div>

    <div class="card-body">

        {{-- Alamat lengkap --}}
        <div class="mb-3">

            <label class="form-label">
                Alamat Lengkap
            </label>

            <textarea
                class="form-control"
                rows="3"
                wire:model="address"
                placeholder="Contoh: Jl. Pendidikan No. 10">
            </textarea>

            @error('address')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Provinsi --}}
        <div class="mb-3">

            <label class="form-label">
                Provinsi
            </label>

            <input
                type="text"
                class="form-control"
                value="Nusa Tenggara Barat"
                readonly>

            <input
                type="hidden"
                wire:model="province"
                value="52">

        </div>


        {{-- Kabupaten/Kota --}}
        <div class="mb-3">

            <label class="form-label">
                Kabupaten/Kota
            </label>

            <select
                class="form-select"
                wire:model.live="city">

                <option value="">
                    -- Pilih Kabupaten/Kota --
                </option>

                @foreach($cities as $cityItem)

                    <option value="{{ $cityItem->code }}">
                        {{ $cityItem->name }}
                    </option>

                @endforeach

            </select>

            @error('city')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Kecamatan --}}
        <div class="mb-3">

            <label class="form-label">
                Kecamatan
            </label>

            <select
                class="form-select"
                wire:model.live="district"
                @disabled(empty($districts))>

                <option value="">
                    -- Pilih Kecamatan --
                </option>

                @foreach($districts as $districtItem)

                    <option value="{{ $districtItem->code }}">
                        {{ $districtItem->name }}
                    </option>

                @endforeach

            </select>

            @error('district')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Kelurahan/Desa --}}
        <div class="mb-3">

            <label class="form-label">
                Kelurahan/Desa
            </label>

            <select
                class="form-select"
                wire:model.live="village"
                @disabled(empty($villages))>

                <option value="">
                    -- Pilih Kelurahan/Desa --
                </option>

                @foreach($villages as $villageItem)

                    <option value="{{ $villageItem->code }}">
                        {{ $villageItem->name }}
                    </option>

                @endforeach

            </select>

            @error('village')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="row">

            {{-- Dusun/Lingkungan --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Dusun/Lingkungan
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model="hamlet"
                    placeholder="Dusun/Lingkungan">

                @error('hamlet')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Kode Pos --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Kode Pos
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model="postal_code"
                    maxlength="10"
                    placeholder="Kode Pos">

                @error('postal_code')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <div class="row">

            {{-- RT --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    RT
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model="rt"
                    maxlength="5"
                    placeholder="RT">

                @error('rt')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- RW --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    RW
                </label>

                <input
                    type="text"
                    class="form-control"
                    wire:model="rw"
                    maxlength="5"
                    placeholder="RW">

                @error('rw')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>
