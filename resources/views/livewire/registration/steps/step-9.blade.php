<div class="card shadow-sm">

    <div class="card-body text-center py-5">

        <div class="mb-4">
            <div class="text-success fs-1">
                ✓
            </div>

            <h3 class="text-success fw-bold">
                Pendaftaran Berhasil
            </h3>

            <p class="text-muted mb-0">
                Data pendaftaran calon peserta didik telah berhasil disimpan.
            </p>
        </div>

        @if($registration)

            <div class="alert alert-primary mx-auto"
                 style="max-width: 500px;">

                <div class="small text-muted mb-1">
                    NOMOR PENDAFTARAN
                </div>

                <div class="fs-2 fw-bold">
                    {{ $registration->registration_number }}
                </div>

                <hr>

                <div class="small">
                    Silakan simpan nomor pendaftaran ini untuk keperluan
                    pengecekan dan administrasi selanjutnya.
                </div>

            </div>

            <div class="mt-4">

                <div>
                    <strong>Nama Peserta Didik</strong>
                </div>

                <div>
                    {{ $registration->full_name }}
                </div>

            </div>

        @else

            <div class="alert alert-warning">
                Nomor pendaftaran belum tersedia.
            </div>

        @endif

    </div>

</div>
