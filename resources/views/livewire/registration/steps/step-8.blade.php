<div>

    {{-- Judul --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            Konfirmasi Data Pendaftaran
        </h4>

        <p class="text-muted mb-0">
            Periksa kembali seluruh data sebelum mengirim pendaftaran.
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- DATA PESERTA DIDIK --}}
    {{-- ========================================================= --}}

    <div class="card mb-4">

        <div class="card-header fw-bold">
            1. Data Peserta Didik
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Nama Lengkap</strong>
                    <div>{{ $full_name ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>NIK</strong>
                    <div>{{ $nik ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>NISN</strong>
                    <div>{{ $nisn ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Jenis Kelamin</strong>
                    <div>
                        @if($gender === 'L')
                            Laki-laki
                        @elseif($gender === 'P')
                            Perempuan
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Tempat Lahir</strong>
                    <div>{{ $birth_place ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Tanggal Lahir</strong>
                    <div>{{ $birth_date ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Agama</strong>
                    <div>{{ $religion ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Kebutuhan Khusus</strong>
                    <div>{{ $special_needs ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Sekolah Sebelumnya</strong>
                    <div>{{ $previous_school ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>No. KK</strong>
                    <div>{{ $family_card_number ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>No. Akta Kelahiran</strong>
                    <div>{{ $birth_certificate_number ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Jumlah Saudara</strong>
                    <div>{{ $siblings_count ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Anak Ke-</strong>
                    <div>{{ $child_order ?? '-' }}</div>
                </div>

            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- ALAMAT --}}
    {{-- ========================================================= --}}

    <div class="card mb-4">

        <div class="card-header fw-bold">
            2. Alamat Tempat Tinggal
        </div>

        <div class="card-body">

            <div class="mb-3">
                <strong>Alamat</strong>
                <div>{{ $address ?: '-' }}</div>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Provinsi</strong>
                    <div>{{ $province ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Kota/Kabupaten</strong>
                    <div>{{ $city ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Kecamatan</strong>
                    <div>{{ $district ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Kelurahan/Desa</strong>
                    <div>{{ $village ?: '-' }}</div>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Dusun/Lingkungan</strong>
                    <div>{{ $hamlet ?: '-' }}</div>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>RT</strong>
                    <div>{{ $rt ?: '-' }}</div>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>RW</strong>
                    <div>{{ $rw ?: '-' }}</div>
                </div>

                <div class="col-md-3 mb-3">
                    <strong>Kode Pos</strong>
                    <div>{{ $postal_code ?: '-' }}</div>
                </div>

            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- AYAH --}}
    {{-- ========================================================= --}}

    <div class="card mb-4">

        <div class="card-header fw-bold">
            3. Data Ayah
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Nama Ayah</strong>
                    <div>{{ $father_full_name ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>NIK Ayah</strong>
                    <div>{{ $father_nik ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Tahun Lahir</strong>
                    <div>{{ $father_birth_year ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Pendidikan</strong>
                    <div>{{ $father_education ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Pekerjaan</strong>
                    <div>{{ $father_job ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Penghasilan</strong>
                    <div>{{ $father_income ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>No. HP / WhatsApp</strong>
                    <div>{{ $father_phone ?: '-' }}</div>
                </div>

            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- IBU --}}
    {{-- ========================================================= --}}

    <div class="card mb-4">

        <div class="card-header fw-bold">
            4. Data Ibu
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Nama Ibu</strong>
                    <div>{{ $mother_full_name ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>NIK Ibu</strong>
                    <div>{{ $mother_nik ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Tahun Lahir</strong>
                    <div>{{ $mother_birth_year ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Pendidikan</strong>
                    <div>{{ $mother_education ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Pekerjaan</strong>
                    <div>{{ $mother_job ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Penghasilan</strong>
                    <div>{{ $mother_income ?: '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>No. HP / WhatsApp</strong>
                    <div>{{ $mother_phone ?: '-' }}</div>
                </div>

            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- WALI --}}
    {{-- ========================================================= --}}

    @if(in_array($guardian_status, ['has_guardian', 'lives_with_guardian'], true))

        <div class="card mb-4">

            <div class="card-header fw-bold">
                5. Data Wali
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Status Wali</strong>

                        <div>
                            @if($guardian_status === 'has_guardian')
                                Memiliki Wali
                            @elseif($guardian_status === 'lives_with_guardian')
                                Tinggal Bersama Wali
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Nama Wali</strong>
                        <div>{{ $guardian_full_name ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Hubungan Keluarga</strong>
                        <div>{{ $guardian_family_relation ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>NIK</strong>
                        <div>{{ $guardian_nik ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Tahun Lahir</strong>
                        <div>{{ $guardian_birth_year ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Pendidikan</strong>
                        <div>{{ $guardian_education ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Pekerjaan</strong>
                        <div>{{ $guardian_job ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Penghasilan</strong>
                        <div>{{ $guardian_income ?: '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>No. HP / WhatsApp</strong>
                        <div>{{ $guardian_phone ?: '-' }}</div>
                    </div>

                    <div class="col-12 mb-3">
                        <strong>Alamat Wali</strong>
                        <div>{{ $guardian_address ?: '-' }}</div>
                    </div>

                </div>

            </div>
        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- DOKUMEN --}}
    {{-- ========================================================= --}}

    <div class="card mb-4">

        <div class="card-header fw-bold">
            6. Dokumen
        </div>

        <div class="card-body">

            <div class="list-group">

                @if($document_kk)
                    <div class="list-group-item">
                        ✓ Kartu Keluarga:
                        <strong>{{ $document_kk->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_birth_certificate)
                    <div class="list-group-item">
                        ✓ Akta Kelahiran:
                        <strong>{{ $document_birth_certificate->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_father_ktp)
                    <div class="list-group-item">
                        ✓ KTP Ayah:
                        <strong>{{ $document_father_ktp->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_mother_ktp)
                    <div class="list-group-item">
                        ✓ KTP Ibu:
                        <strong>{{ $document_mother_ktp->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_guardian_ktp)
                    <div class="list-group-item">
                        ✓ KTP Wali:
                        <strong>{{ $document_guardian_ktp->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_diploma)
                    <div class="list-group-item">
                        ✓ Ijazah:
                        <strong>{{ $document_diploma->getClientOriginalName() }}</strong>
                    </div>
                @endif

                @if($document_supporting)
                    <div class="list-group-item">
                        ✓ Dokumen Pendukung:
                        <strong>{{ $document_supporting->getClientOriginalName() }}</strong>
                    </div>
                @endif

            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- PERNYATAAN --}}
    {{-- ========================================================= --}}

    <div class="card border-warning mb-4">

        <div class="card-body">

            <div class="form-check">

                <input
                    type="checkbox"
                    class="form-check-input"
                    id="confirmation"
                    wire:model="confirmation">

                <label
                    class="form-check-label"
                    for="confirmation">

                    Saya menyatakan bahwa seluruh data yang saya
                    masukkan dalam formulir pendaftaran ini adalah
                    benar dan dapat dipertanggungjawabkan.

                </label>

            </div>

            @error('confirmation')
                <div class="text-danger small mt-2">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TOMBOL --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between">

        <button
            type="button"
            class="btn btn-secondary"
            wire:click="previousStep">

            ← Kembali

        </button>

        <button
            type="button"
            class="btn btn-success"
            wire:click="nextStep"
            wire:loading.attr="disabled">

            <span wire:loading.remove>
                Kirim Pendaftaran
            </span>

            <span wire:loading>
                Menyimpan...
            </span>

        </button>

    </div>

</div>
