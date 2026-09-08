@extends('layouts.front')

@section('title', 'Jadwal SPMB')

@section('content')

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-body p-4 p-md-5">

            <h1 class="mb-4">
                Jadwal SPMB
            </h1>

            @if($registrationPeriod)

                <h3>
                    {{ $registrationPeriod->name }}
                </h3>

                @if($registrationPeriod->academicYear)
                    <p class="text-muted">
                        Tahun Pelajaran
                        {{ $registrationPeriod->academicYear->name }}
                    </p>
                @endif

                <hr>

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <strong>Pendaftaran</strong>

                                <div class="mt-2">
                                    {{ $registrationPeriod->start_date?->format('d F Y') }}
                                    -
                                    {{ $registrationPeriod->end_date?->format('d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($registrationPeriod->verification_end_date)

                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body">

                                    <strong>
                                        Batas Verifikasi
                                    </strong>

                                    <div class="mt-2">
                                        {{ $registrationPeriod->verification_end_date->format('d F Y') }}
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endif

                    @if($registrationPeriod->announcement_date)

                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body">

                                    <strong>
                                        Pengumuman
                                    </strong>

                                    <div class="mt-2">
                                        {{ $registrationPeriod->announcement_date->format('d F Y') }}
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endif

                </div>

            @else

                <div class="alert alert-warning">
                    Jadwal SPMB belum tersedia.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
