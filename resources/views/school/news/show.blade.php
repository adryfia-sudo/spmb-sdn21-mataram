@extends('layouts.school')

@section('title', $news->title . ' - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')

<section class="school-section">

    <div class="container">

        <article class="mx-auto" style="max-width: 900px;">

            {{-- Judul --}}

            <div class="mb-4">

                <span class="school-section-label">
                    BERITA
                </span>

                <h1 class="school-section-title">
                    {{ $news->title }}
                </h1>

                @if($news->published_at)

                    <p class="text-muted mt-3 mb-0">
                        {{ $news->published_at->translatedFormat('d F Y, H:i') }}
                    </p>

                @endif

            </div>


            {{-- Gambar utama --}}

            @if($news->image)

                <div class="mb-5">

                    <img
                        src="{{ asset('storage/' . $news->image) }}"
                        alt="{{ $news->title }}"
                        class="img-fluid rounded-4 shadow-sm w-100"
                    >

                </div>

            @endif


            {{-- Ringkasan --}}

            @if($news->excerpt)

                <div class="mb-4">

                    <p class="lead">
                        {{ $news->excerpt }}
                    </p>

                </div>

            @endif


            {{-- Isi berita --}}

            <div class="school-section-description">

                {!! $news->content !!}

            </div>


            {{-- Kembali --}}

            <div class="mt-5">

                <a
                    href="{{ route('school.home') }}"
                    class="btn btn-primary"
                >
                    ← Kembali ke Beranda
                </a>

            </div>

        </article>

    </div>

</section>

@endsection
