<div class="card-header">
    <h4 class="mb-0">
        Data Wali
    </h4>
</div>

<div class="card-body">

    {{-- Status Wali --}}
    <div class="mb-4">

        <label class="form-label">
            Status Wali <span class="text-danger">*</span>
        </label>

        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                wire:model.live="guardian_status"
                value="none"
                id="guardian_none">

            <label class="form-check-label" for="guardian_none">
                Tidak memiliki wali
            </label>
        </div>

        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                wire:model.live="guardian_status"
                value="has_guardian"
                id="guardian_has">

            <label class="form-check-label" for="guardian_has">
                Memiliki wali
            </label>
        </div>

        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                wire:model.live="guardian_status"
                value="lives_with_guardian"
                id="guardian_lives">

            <label class="form-check-label" for="guardian_lives">
                Tinggal bersama wali
            </label>
        </div>

        @error('guardian_status')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Data Wali --}}
    @if(in_array($guardian_status, ['has_guardian', 'lives_with_guardian']))

        <div class="alert alert-info">
            Silakan lengkapi data wali.
        </div>


        {{-- Nama --}}
        <div class="mb-3">

            <label class="form-label">
                Nama Lengkap Wali <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                class="form-control"
                wire:model="guardian_full_name"
                placeholder="Nama lengkap wali">

            @error('guardian_full_name')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Hubungan --}}
        <div class="mb-3">

            <label class="form-label">
                Hubungan dengan Murid <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                class="form-control"
                wire:model="guardian_family_relation"
                placeholder="Contoh: Kakek, Nenek, Paman, Bibi">

            @error('guardian_family_relation')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- NIK --}}
        <div class="mb-3">

            <label class="form-label">
                NIK Wali
            </label>

            <input
                type="text"
                class="form-control"
                wire:model="guardian_nik"
                maxlength="16"
                inputmode="numeric"
                placeholder="16 digit NIK">

            @error('guardian_nik')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Tahun Lahir --}}
        <div class="mb-3">

            <label class="form-label">
                Tahun Lahir
            </label>

            <input
                type="number"
                class="form-control"
                wire:model="guardian_birth_year"
                placeholder="Contoh: 1975">

            @error('guardian_birth_year')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Pendidikan --}}
        <div class="mb-3">

            <label class="form-label">
                Pendidikan Terakhir
            </label>

            <select
                class="form-select"
                wire:model="guardian_education">

                <option value="">
                    -- Pilih Pendidikan --
                </option>

                <option value="Tidak Sekolah">Tidak Sekolah</option>
                <option value="Putus SD">Putus SD</option>
                <option value="SD">SD / Sederajat</option>
                <option value="Paket A">Paket A</option>
                <option value="Paket B">Paket B</option>
                <option value="Paket C">Paket C</option>
                <option value="SMP">SMP / Sederajat</option>
                <option value="SMA">SMA / Sederajat</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="Nonformal">Nonformal</option>
                <option value="Informal">Informal</option>
                <option value="Lainnya">Lainnya</option>

            </select>

            @error('guardian_education')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Pekerjaan --}}
        <div class="mb-3">

            <label class="form-label">
                Pekerjaan
            </label>

            <select
                class="form-select"
                wire:model="guardian_job">

                <option value="">
                    -- Pilih Pekerjaan --
                </option>

                <option value="Tidak Bekerja">Tidak Bekerja</option>
                <option value="Nelayan">Nelayan</option>
                <option value="Petani">Petani</option>
                <option value="Peternak">Peternak</option>
                <option value="ASN/TNI/POLRI">ASN/TNI/POLRI</option>
                <option value="Karyawan Swasta">Karyawan Swasta</option>
                <option value="Pedagang Kecil">Pedagang Kecil</option>
                <option value="Pedagang Besar">Pedagang Besar</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Buruh">Buruh</option>
                <option value="Pensiunan">Pensiunan</option>
                <option value="Tenaga Kerja Indonesia">
                    Tenaga Kerja Indonesia
                </option>
                <option value="Karyawan BUMN">Karyawan BUMN</option>
                <option value="Lainnya">Lainnya</option>

            </select>

            @error('guardian_job')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Penghasilan --}}
        <div class="mb-3">

            <label class="form-label">
                Penghasilan Per Bulan
            </label>

            <select
                class="form-select"
                wire:model="guardian_income">

                <option value="">
                    -- Pilih Penghasilan --
                </option>

                <option value="Kurang dari Rp. 500.000">
                    Kurang dari Rp. 500.000
                </option>

                <option value="Rp. 500.000 - Rp. 999.999">
                    Rp. 500.000 - Rp. 999.999
                </option>

                <option value="Rp. 1.000.000 - Rp. 1.999.999">
                    Rp. 1.000.000 - Rp. 1.999.999
                </option>

                <option value="Rp. 2.000.000 - Rp. 4.999.999">
                    Rp. 2.000.000 - Rp. 4.999.999
                </option>

                <option value="Rp. 5.000.000 - Rp. 20.000.000">
                    Rp. 5.000.000 - Rp. 20.000.000
                </option>

                <option value=">Rp. 20.000.000">
                    &gt;Rp. 20.000.000
                </option>

                <option value="Tidak Berpenghasilan">
                    Tidak Berpenghasilan
                </option>

            </select>

            @error('guardian_income')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Nomor HP --}}
        <div class="mb-3">

            <label class="form-label">
                Nomor HP / WhatsApp
            </label>

            <input
                type="text"
                class="form-control"
                wire:model="guardian_phone"
                maxlength="20"
                inputmode="tel"
                placeholder="08xxxxxxxxxx">

            @error('guardian_phone')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Alamat --}}
        <div class="mb-3">

            <label class="form-label">
                Alamat Wali
            </label>

            <textarea
                class="form-control"
                rows="3"
                wire:model="guardian_address"
                placeholder="Alamat lengkap wali"></textarea>

            @error('guardian_address')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

    @endif

</div>
