<div class="text-center py-5">

    <div class="mb-4">
        <div
            class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle"
            style="width: 80px; height: 80px; font-size: 40px;">
            ✓
        </div>
    </div>

    <h2 class="text-success mb-3">
        Pendaftaran Berhasil
    </h2>

    <p class="text-muted">
        Data pendaftaran murid baru telah berhasil disimpan.
    </p>

    @if ($registration)

        <div class="card mt-4 mx-auto" style="max-width: 500px;">

            <div class="card-body">

                <h5 class="card-title">
                    Nomor Pendaftaran
                </h5>

                <div class="fs-3 fw-bold text-primary my-3">
                    {{ $registration->registration_number }}
                </div>

                <hr>

                <p class="mb-1">
                    <strong>Nama:</strong>
                    {{ $registration->full_name }}
                </p>

                <p class="mb-1">
                    <strong>Jalur:</strong>
                    {{ $registration->registrationPath?->name }}
                </p>

                <p class="mb-0">
                    <strong>Status:</strong>
                    {{ $registration->status }}
                </p>

            </div>

        </div>

    @endif

    <div class="mt-4">

        <a
            href="{{ url('/') }}"
            class="btn btn-primary">

            Kembali ke Beranda

        </a>

    </div>

</div>
