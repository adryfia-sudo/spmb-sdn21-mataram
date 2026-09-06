@extends('layouts.school')

@section('title', 'Galeri - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')
<section class="school-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="school-section-label">GALERI</span>
            <h1 class="school-section-title">Galeri Sekolah</h1>
            <p class="school-section-description">
                Dokumentasi kegiatan dan aktivitas SD Negeri 21 Mataram.
            </p>
        </div>

        <div class="row g-4">
            @forelse($galleries as $gallery)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                        @php
                            $cover = $gallery->photos->first();
                        @endphp

                        @if($cover)
                            <img
                                src="{{ asset('storage/' . $cover->image) }}"
                                alt="{{ $gallery->title }}"
                                class="card-img-top"
                                style="height: 220px; object-fit: cover;"
                            >
                        @endif

                        <div class="card-body p-4 d-flex flex-column">

                            @if($gallery->published_at)
                                <small class="text-muted mb-2">
                                    {{ $gallery->published_at->translatedFormat('d F Y, H:i') }}
                                </small>
                            @endif

                            <h2 class="h5 fw-bold mb-3">
                                {{ $gallery->title }}
                            </h2>

                            @if($gallery->description)
                                <p class="text-muted mb-4">
                                    {{ $gallery->description }}
                                </p>
                            @endif

                            <div class="mt-auto">
                                <a
                                    href="{{ route('school.gallery.show', $gallery->slug) }}"
                                    class="btn btn-primary"
                                >
                                    Lihat Galeri →
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">
                            Belum ada galeri yang diterbitkan.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
