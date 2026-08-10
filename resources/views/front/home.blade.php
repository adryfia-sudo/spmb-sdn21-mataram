@extends('layouts.front')

@section('title', 'SPMB ' . ($school?->school_name ?? 'SD Negeri 21 Mataram'))

@section('content')

<section class="hero">
    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Sistem Penerimaan Murid Baru
        </h1>

        <h2 class="fw-light">
            {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}
        </h2>

        @if($academicYear)
            <p class="lead mt-4">
                Tahun Pelajaran {{ $academicYear->name }}
            </p>
        @endif

        @if($registrationPeriod)

            @if($registrationPeriod->is_active)
                <span class="badge bg-success fs-6 mb-3">
                    Pendaftaran Dibuka
                </span>
            @else
                <span class="badge bg-danger fs-6 mb-3">
                    Pendaftaran Ditutup
                </span>
            @endif

        @endif

        <div class="mt-3">

            <a href="{{ route('registration.create') }}"
                class="btn btn-warning btn-lg">
                Daftar Sekarang
            </a>

        </div>

    </div>
</section>

<section class="container py-5">

{{-- Statistik --}}

<div class="row g-4 mb-5">

    <div class="col-md-6">
        <div class="card text-center shadow-sm h-100">
            <div class="card-body">
                <h2>{{ $totalRegistered }}</h2>
                <p class="mb-0">Sudah Mendaftar</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center shadow-sm h-100">
            <div class="card-body">
                <h2>{{ $totalPaths }}</h2>
                <p class="mb-0">Jalur Pendaftaran</p>
            </div>
        </div>
    </div>

</div>
    {{-- Jalur Pendaftaran --}}

    <h2 class="mb-4">Jalur Pendaftaran</h2>

    <div class="row">

        @foreach($registrationPaths as $path)

            <div class="col-md-6 mb-4">

                <div class="card shadow h-100">

                    <div class="card-body">

                        <h4>{{ $path->name }}</h4>

                        <p class="text-muted">
                            {{ $path->description }}
                        </p>

                        <hr>
                                               
                        <a href="{{ route('registration.create') }}"
                            class="btn btn-primary">
                            Daftar Jalur Ini
                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>

@endsection
