@extends('layouts.school')

@section('title', 'Berita - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')
<section class="school-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="school-section-label">BERITA</span>
            <h1 class="school-section-title">Berita Sekolah</h1>
            <p class="school-section-description">
                Informasi dan berita terbaru dari SD Negeri 21 Mataram.
            </p>
        </div>

        <div class="row g-4">
            @forelse($news as $item)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                        @if($item->image)
                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->title }}"
                                class="card-img-top"
                                style="height: 220px; object-fit: cover;"
                            >
                        @endif

                        <div class="card-body p-4 d-flex flex-column">

                            @if($item->published_at)
                                <small class="text-muted mb-2">
                                    {{ $item->published_at->translatedFormat('d F Y, H:i') }}
                                </small>
                            @endif

                            <h2 class="h5 fw-bold mb-3">
                                {{ $item->title }}
                            </h2>

                            @if($item->excerpt)
                                <p class="text-muted mb-4">
                                    {{ $item->excerpt }}
                                </p>
                            @endif

                            <div class="mt-auto">
                                <a
                                    href="{{ route('school.news.show', $item->slug) }}"
                                    class="btn btn-primary"
                                >
                                    Baca Selengkapnya →
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">
                            Belum ada berita yang diterbitkan.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
