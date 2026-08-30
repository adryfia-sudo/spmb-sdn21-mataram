@extends('layouts.front')

@section('title', 'Persyaratan Pendaftaran')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">
        Persyaratan Pendaftaran
    </h1>

    @forelse($registrationPaths as $path)

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body p-4">

                <h3>
                    {{ $path->name }}
                </h3>

                @if($path->description)
                    <p class="text-muted">
                        {{ $path->description }}
                    </p>
                @endif

                <hr>

                @if($path->requirements->count())

                    <div class="list-group">

                        @foreach($path->requirements as $requirement)

                            <div class="list-group-item">

                                <div class="d-flex justify-content-between">

                                    <strong>
                                        {{ $requirement->name }}
                                    </strong>

                                    @if($requirement->pivot->is_required)
                                        <span class="badge bg-danger">
                                            Wajib
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Opsional
                                        </span>
                                    @endif

                                </div>

                                @if($requirement->description)

                                    <div class="text-muted mt-2">
                                        {{ $requirement->description }}
                                    </div>

                                @endif

                                @if($requirement->pivot->notes)

                                    <div class="small text-muted mt-2">
                                        Catatan:
                                        {{ $requirement->pivot->notes }}
                                    </div>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="alert alert-info mb-0">
                        Persyaratan untuk jalur ini belum tersedia.
                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="alert alert-warning">
            Belum ada jalur pendaftaran yang aktif.
        </div>

    @endforelse

</div>

@endsection
