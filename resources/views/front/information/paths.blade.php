@extends('layouts.front')

@section('title', 'Jalur Pendaftaran')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">
        Jalur Pendaftaran
    </h1>

    <div class="row g-4">

        @forelse($registrationPaths as $path)

            <div class="col-md-6">

                <div class="card h-100 shadow-sm border-0">

                    <div class="card-body p-4">

                        <h3>
                            {{ $path->name }}
                        </h3>

                        <hr>

                        <p class="text-muted">
                            {{ $path->description ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <a
                            href="{{ route('registration.create') }}"
                            class="btn btn-primary"
                        >
                            Daftar Jalur Ini
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">
                    Belum ada jalur pendaftaran yang aktif.
                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
