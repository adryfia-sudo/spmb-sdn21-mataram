@extends('layouts.school')

@section('title', $gallery->title . ' - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')
<section class="school-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="school-section-label">GALERI</span>

            <h1 class="school-section-title">
                {{ $gallery->title }}
            </h1>

            @if($gallery->description)
                <p class="school-section-description">
                    {{ $gallery->description }}
                </p>
            @endif

            @if($gallery->published_at)
                <small class="text-muted">
                    {{ $gallery->published_at->translatedFormat('d F Y, H:i') }}
                </small>
            @endif
        </div>

        <div class="row g-4">
            @forelse($gallery->photos as $photo)
                <div class="col-6 col-md-4 col-lg-3">
                    <a
                        href="{{ asset('storage/' . $photo->image) }}"
                        target="_blank"
                        class="text-decoration-none"
                    >
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <img
                                src="{{ asset('storage/' . $photo->image) }}"
                                alt="{{ $gallery->title }}"
                                class="w-100"
                                style="height: 220px; object-fit: cover;"
                            >
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">
                            Belum ada foto dalam galeri ini.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a
                href="{{ route('school.gallery.index') }}"
                class="btn btn-outline-primary"
            >
                ← Kembali ke Galeri
            </a>
        </div>

    </div>
</section>
@endsection
