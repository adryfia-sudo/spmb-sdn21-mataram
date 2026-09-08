@extends('layouts.school')

@section('title', $announcement->title . ' - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')

<section class="school-section">

    <div class="container">

        <article class="mx-auto" style="max-width: 900px;">

            {{-- Judul --}}

            <div class="mb-4">

                <span class="school-section-label">
                    PENGUMUMAN
                </span>

                <h1 class="school-section-title">
                    {{ $announcement->title }}
                </h1>

                @if($announcement->published_at)

                    <p class="text-muted mt-3 mb-0">
                        {{ $announcement->published_at->translatedFormat('d F Y, H:i') }}
                    </p>

                @endif

            </div>


            {{-- Gambar utama --}}

            @if($announcement->image)

                <div class="mb-5">

                    <img
                        src="{{ asset('storage/' . $announcement->image) }}"
                        alt="{{ $announcement->title }}"
                        class="img-fluid rounded-4 shadow-sm w-100"
                    >

                </div>

            @endif


            {{-- Ringkasan --}}

            @if($announcement->excerpt)

                <div class="mb-4">

                    <p class="lead">
                        {{ $announcement->excerpt }}
                    </p>

                </div>

            @endif


            {{-- Isi pengumuman --}}

            <div class="school-section-description">

                {!! $announcement->content !!}

            </div>


            {{-- Lampiran --}}

            @if($announcement->attachment)

                <div class="mt-5 p-4 rounded-4 bg-light">

                    <h2 class="h5 mb-3">
                        Lampiran
                    </h2>

                    @php
                        $attachmentUrl = asset('storage/' . $announcement->attachment);
                        $extension = strtolower(pathinfo($announcement->attachment, PATHINFO_EXTENSION));
                    @endphp

                    @if($extension === 'pdf')

                       <a
    href="{{ route('school.announcements.attachment', $announcement->slug) }}"
    target="_blank"
    rel="noopener noreferrer"
    class="btn btn-primary"
>
    📄 Lihat Lampiran PDF
</a>

                    @else

                        <img
                            src="{{ $attachmentUrl }}"
                            alt="Lampiran {{ $announcement->title }}"
                            class="img-fluid rounded-4 shadow-sm"
                        >

                    @endif

                </div>

            @endif


            {{-- Kembali --}}

            <div class="mt-5">

                <a
                    href="{{ route('school.announcements.index') }}"
                    class="btn btn-primary"
                >
                    ← Kembali ke Pengumuman
                </a>

            </div>

        </article>

    </div>

</section>

@endsection
