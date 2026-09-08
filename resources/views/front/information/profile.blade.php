@extends('layouts.front')

@section('title', 'Profil - ' . ($school?->school_name ?? 'SD Negeri 21 Mataram'))

@section('content')

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-body p-4 p-md-5">

            <h1 class="mb-4">
                Profil Sekolah
            </h1>

            @if($school)

                <div class="row g-4">

                    <div class="col-md-4 text-center">

                        @if($school->logo)
                            <img
                                src="{{ asset('storage/' . $school->logo) }}"
                                alt="{{ $school->school_name }}"
                                class="img-fluid"
                                style="max-height: 180px;"
                            >
                        @endif

                    </div>

                    <div class="col-md-8">

                        <h2>
                            {{ $school->school_name }}
                        </h2>

                        <hr>

                        <p>
                            <strong>NPSN:</strong>
                            {{ $school->npsn ?? '-' }}
                        </p>

                        <p>
                            <strong>Kepala Sekolah:</strong>
                            {{ $school->principal_name ?? '-' }}
                        </p>

                        <p>
                            <strong>Alamat:</strong>
                            {{ $school->address ?? '-' }}
                        </p>

                        <p>
                            <strong>Kelurahan:</strong>
                            {{ $school->village ?? '-' }}
                        </p>

                        <p>
                            <strong>Kecamatan:</strong>
                            {{ $school->district ?? '-' }}
                        </p>

                        <p>
                            <strong>Kota:</strong>
                            {{ $school->city ?? '-' }}
                        </p>

                        <p>
                            <strong>Provinsi:</strong>
                            {{ $school->province ?? '-' }}
                        </p>

                        <p>
                            <strong>Email:</strong>
                            {{ $school->email ?? '-' }}
                        </p>

                        <p>
                            <strong>Telepon:</strong>
                            {{ $school->phone ?? '-' }}
                        </p>

                    </div>

                </div>

            @else

                <div class="alert alert-warning">
                    Data sekolah belum tersedia.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
