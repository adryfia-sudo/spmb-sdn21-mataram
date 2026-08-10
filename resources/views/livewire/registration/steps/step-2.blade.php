<div class="card shadow-sm">

    <div class="card-header">
        <h4 class="mb-0">Data Peserta Didik</h4>
    </div>

    <div class="card-body">

        <div class="row g-3">

            {{-- NIK --}}
            <div class="col-md-6">
                <label class="form-label">
                    NIK <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    class="form-control @error('nik') is-invalid @enderror"
                    wire:model="nik"
                    maxlength="16"
                    inputmode="numeric"
                >

                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- NISN --}}
            <div class="col-md-6">
                <label class="form-label">
                    NISN
                </label>

                <input
                    type="text"
                    class="form-control @error('nisn') is-invalid @enderror"
                    wire:model="nisn"
                    maxlength="10"
                    inputmode="numeric"
                >

                <small class="text-muted">
                    Kosongkan jika peserta didik belum memiliki NISN.
                </small>

                @error('nisn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Nomor KK --}}
            <div class="col-md-6">
                <label class="form-label">
                    Nomor Kartu Keluarga <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    class="form-control @error('family_card_number') is-invalid @enderror"
                    wire:model="family_card_number"
                    maxlength="16"
                    inputmode="numeric"
                >

                @error('family_card_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Akta Kelahiran --}}
            <div class="col-md-6">
                <label class="form-label">
                    Nomor Akta Kelahiran
                </label>

                <input
                    type="text"
                    class="form-control @error('birth_certificate_number') is-invalid @enderror"
                    wire:model="birth_certificate_number"
                >

                @error('birth_certificate_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div class="col-md-8">
                <label class="form-label">
                    Nama Lengkap <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    class="form-control @error('full_name') is-invalid @enderror"
                    wire:model="full_name"
                >

                @error('full_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="col-md-4">
                <label class="form-label">
                    Jenis Kelamin <span class="text-danger">*</span>
                </label>

                <select
                    class="form-select @error('gender') is-invalid @enderror"
                    wire:model="gender"
                >
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>

                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div class="col-md-6">
                <label class="form-label">
                    Tempat Lahir <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    class="form-control @error('birth_place') is-invalid @enderror"
                    wire:model="birth_place"
                >

                @error('birth_place')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="col-md-6">
                <label class="form-label">
                    Tanggal Lahir <span class="text-danger">*</span>
                </label>

                <input
                    type="date"
                    class="form-control @error('birth_date') is-invalid @enderror"
                    wire:model="birth_date"
                >

                @error('birth_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Agama --}}
            <div class="col-md-6">
                <label class="form-label">
                    Agama <span class="text-danger">*</span>
                </label>

                <select
                    class="form-select @error('religion') is-invalid @enderror"
                    wire:model="religion"
                >
                    <option value="">-- Pilih Agama --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>

                @error('religion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Kebutuhan Khusus --}}
            <div class="col-md-6">
                <label class="form-label">
                    Kebutuhan Khusus
                </label>

                <select
                    class="form-select @error('special_needs') is-invalid @enderror"
                    wire:model="special_needs"
                >
                    <option value="">Tidak ada</option>
                    <option value="A">A - Tunanetra</option>
                    <option value="B">B - Tunarungu</option>
                    <option value="C">C - Tunagrahita</option>
                    <option value="D">D - Tunadaksa</option>
                    <option value="E">E - Tunalaras</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                @error('special_needs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Sekolah Sebelumnya --}}
            <div class="col-md-8">
                <label class="form-label">
                    Asal Sekolah
                </label>

                <input
                    type="text"
                    class="form-control @error('previous_school') is-invalid @enderror"
                    wire:model="previous_school"
                >

                @error('previous_school')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Jenis Sekolah --}}
            <div class="col-md-4">
                <label class="form-label">
                    Jenis Sekolah
                </label>

                <select
                    class="form-select @error('previous_school_type') is-invalid @enderror"
                    wire:model="previous_school_type"
                >
                    <option value="">-- Pilih --</option>
                    <option value="TK">TK</option>
                    <option value="RA">RA</option>
                    <option value="PAUD">PAUD</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                @error('previous_school_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Anak Ke --}}
            <div class="col-md-6">
                <label class="form-label">
                    Anak Ke-
                </label>

                <input
                    type="number"
                    min="1"
                    class="form-control @error('child_order') is-invalid @enderror"
                    wire:model="child_order"
                >

                @error('child_order')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Jumlah Saudara --}}
            <div class="col-md-6">
                <label class="form-label">
                    Jumlah Saudara Kandung
                </label>

                <input
                    type="number"
                    min="0"
                    class="form-control @error('siblings_count') is-invalid @enderror"
                    wire:model="siblings_count"
                >

                @error('siblings_count')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

{{-- ========================================================= --}}
{{-- KONTAK --}}
{{-- ========================================================= --}}

<div class="col-md-6">
    <label class="form-label">
        Nomor HP Orang Tua/Wali <span class="text-danger">*</span>
    </label>

    <input
        type="text"
        class="form-control @error('phone') is-invalid @enderror"
        wire:model="phone"
        maxlength="20"
        inputmode="tel"
        placeholder="Contoh: 081234567890"
    >

    <small class="text-muted">
        Nomor HP yang dapat dihubungi.
    </small>

    @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- ========================================================= --}}
{{-- DATA FISIK --}}
{{-- ========================================================= --}}

<div class="col-12 mt-3">
    <h5 class="border-bottom pb-2">
        Data Fisik Peserta Didik
    </h5>
</div>


{{-- Tinggi Badan --}}
<div class="col-md-4">
    <label class="form-label">
        Tinggi Badan (cm) <span class="text-danger">*</span>
    </label>

    <input
        type="number"
        step="0.1"
        min="30"
        max="250"
        class="form-control @error('height') is-invalid @enderror"
        wire:model="height"
        placeholder="Contoh: 120"
    >

    @error('height')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- Berat Badan --}}
<div class="col-md-4">
    <label class="form-label">
        Berat Badan (kg) <span class="text-danger">*</span>
    </label>

    <input
        type="number"
        step="0.1"
        min="5"
        max="250"
        class="form-control @error('weight') is-invalid @enderror"
        wire:model="weight"
        placeholder="Contoh: 25"
    >

    @error('weight')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- Lingkar Kepala --}}
<div class="col-md-4">
    <label class="form-label">
        Lingkar Kepala (cm) <span class="text-danger">*</span>
    </label>

    <input
        type="number"
        step="0.1"
        min="20"
        max="100"
        class="form-control @error('head_circumference') is-invalid @enderror"
        wire:model="head_circumference"
        placeholder="Contoh: 50"
    >

    @error('head_circumference')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- ========================================================= --}}
{{-- JARAK RUMAH --}}
{{-- ========================================================= --}}

<div class="col-12 mt-3">
    <h5 class="border-bottom pb-2">
        Jarak Rumah ke Sekolah
    </h5>
</div>


{{-- Kategori Jarak --}}
<div class="col-md-6">
    <label class="form-label">
        Jarak Rumah ke Sekolah <span class="text-danger">*</span>
    </label>

    <select
        class="form-select @error('distance_category') is-invalid @enderror"
        wire:model.live="distance_category"
    >
        <option value="">-- Pilih --</option>

        <option value="less_than_1_km">
            Kurang dari 1 KM
        </option>

        <option value="more_than_1_km">
            Lebih dari 1 KM
        </option>
    </select>

    @error('distance_category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- Input jarak hanya jika > 1 KM --}}
@if($distance_category === 'more_than_1_km')

    <div class="col-md-6">
        <label class="form-label">
            Jarak ke Sekolah (KM) <span class="text-danger">*</span>
        </label>

        <input
            type="number"
            step="0.01"
            min="1.01"
            max="100"
            class="form-control @error('distance_km') is-invalid @enderror"
            wire:model="distance_km"
            placeholder="Contoh: 1.5"
        >

        <small class="text-muted">
            Masukkan jarak lebih dari 1 KM. Contoh: 1.5 KM.
        </small>

        @error('distance_km')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

@endif


{{-- ========================================================= --}}
{{-- TRANSPORTASI --}}
{{-- ========================================================= --}}

<div class="col-md-6">
    <label class="form-label">
        Moda Transportasi <span class="text-danger">*</span>
    </label>

    <select
        class="form-select @error('transportation') is-invalid @enderror"
        wire:model="transportation"
    >
        <option value="">-- Pilih Transportasi --</option>

        <option value="jalan_kaki">
            Jalan kaki
        </option>

        <option value="sepeda">
            Sepeda
        </option>

        <option value="sepeda_motor">
            Sepeda motor
        </option>

        <option value="ojek">
            Ojek
        </option>

        <option value="mobil_pribadi">
            Mobil Pribadi
        </option>

        <option value="angkutan_umum">
            Angkutan Umum/bus
        </option>

        <option value="mobil_bus_antar_jemput">
            Mobil/Bus Antar Jemput
        </option>

        <option value="lainnya">
            Lainnya
        </option>
    </select>

    @error('transportation')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


{{-- ========================================================= --}}
{{-- LAMA PERJALANAN --}}
{{-- ========================================================= --}}

<div class="col-md-6">
    <label class="form-label">
        Lama Perjalanan ke Sekolah (menit)
        <span class="text-danger">*</span>
    </label>

    <input
        type="number"
        min="1"
        max="300"
        class="form-control @error('travel_time') is-invalid @enderror"
        wire:model="travel_time"
        placeholder="Contoh: 20"
    >

    <small class="text-muted">
        Masukkan perkiraan waktu perjalanan dalam menit.
    </small>

    @error('travel_time')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
