@extends('layouts.school')

@section('title', $school?->school_name ?? 'Website Sekolah')

@section('content')

@foreach($sections as $section)

    {{-- =====================================================
         HERO
    ====================================================== --}}

@if($section->key === 'hero')

    <section
        class="school-hero"
        @if($section->image)
            style="background-image: url('{{ asset('storage/' . $section->image) }}');"
        @endif
    >
            
            <div class="container">

                <div class="row align-items-center g-5">

                    <div class="col-lg-7">

                        <div class="school-hero-content">

                            <span class="school-hero-badge">
                                WEBSITE RESMI SEKOLAH
                            </span>

                            <h1>
                                {{ $section->title ?: ($school?->school_name ?? 'SD Negeri 21 Mataram') }}
                            </h1>

                            @if($section->subtitle)
                                <p class="school-hero-description mt-3">
                                    {{ $section->subtitle }}
                                </p>
                            @elseif($section->content)
                                <div class="school-hero-description mt-3">
                                    {!! $section->content !!}
                                </div>
                            @endif

                            <div class="school-hero-actions">

                                <a
                                    href="{{ route('school.profile') }}"
                                    class="btn btn-light btn-lg px-4"
                                >
                                    Profil Sekolah
                                </a>

                                <a
                                    href="{{ route('home') }}"
                                    class="btn btn-outline-light btn-lg px-4"
                                >
                                    Portal SPMB
                                </a>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-5">

                        <div class="school-hero-logo-wrapper">

                            @if($school?->logo)

                                <img
                                    src="{{ asset('storage/' . $school->logo) }}"
                                    alt="{{ $school->school_name }}"
                                    class="school-hero-logo"
                                >

                            @else

                                <div class="school-logo-placeholder">
                                    <span>SD</span>
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         SAMBUTAN
    ====================================================== --}}

    @if($section->key === 'sambutan')

        <section class="school-section">

            <div class="container">

                <div class="row align-items-center g-5">

                    <div class="col-lg-5">

                        @if($section->image)

                            <img
                                src="{{ asset('storage/' . $section->image) }}"
                                alt="{{ $section->title }}"
                                class="img-fluid rounded-4 shadow-sm"
                            >

                        @elseif($school?->logo)

                            <img
                                src="{{ asset('storage/' . $school->logo) }}"
                                alt="{{ $school->school_name }}"
                                class="img-fluid rounded-4"
                                style="max-height: 300px; object-fit: contain;"
                            >

                        @endif

                    </div>


                    <div class="col-lg-7">

                        <span class="school-section-label">
                            SAMBUTAN
                        </span>

                        <h2 class="school-section-title">
                            {{ $section->title }}
                        </h2>

                        @if($section->subtitle)

                            <p class="school-section-description mt-3">
                                {{ $section->subtitle }}
                            </p>

                        @endif

                        @if($section->content)

                            <div class="school-section-description mt-3">
                                {!! $section->content !!}
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         INFORMASI
    ====================================================== --}}

    @if($section->key === 'informasi')

        <section class="school-section">

            <div class="container">

                <div class="mb-5">

                    <span class="school-section-label">
                        INFORMASI
                    </span>

                    <h2 class="school-section-title">
                        {{ $section->title }}
                    </h2>

                    @if($section->subtitle)

                        <p class="school-section-description">
                            {{ $section->subtitle }}
                        </p>

                    @endif

                </div>


                <div class="row g-4">

                    <div class="col-md-4">

                        <div class="school-card">

                            <div class="school-card-icon">
                                📚
                            </div>

                            <h4>
                                Profil Sekolah
                            </h4>

                            <p>
                                Kenali lebih dekat
                                {{ $school?->school_name ?? 'sekolah' }},
                                pimpinan, dan identitas sekolah.
                            </p>

                            <a
                                href="{{ route('front.profile') }}"
                                class="text-decoration-none"
                            >
                                Selengkapnya →
                            </a>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="school-card">

                            <div class="school-card-icon">
                                📢
                            </div>

                            <h4>
                                Informasi Sekolah
                            </h4>

                            <p>
                                Informasi dan dokumen resmi
                                yang diterbitkan oleh sekolah.
                            </p>

                            <a
                                href="#"
                                class="text-decoration-none"
                            >
                                Lihat Informasi →
                            </a>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="school-card">

                            <div class="school-card-icon">
                                📝
                            </div>

                            <h4>
                                Layanan SPMB
                            </h4>

                            <p>
                                Akses layanan pendaftaran
                                peserta didik baru.
                            </p>

                            <a
                                href="{{ route('home') }}"
                                class="text-decoration-none"
                            >
                                Buka Portal SPMB →
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         BERITA
    ====================================================== --}}

    @if($section->key === 'berita')

        <section class="school-section bg-white">

            <div class="container">

                <div class="mb-5">

                    <span class="school-section-label">
                        BERITA
                    </span>

                    <h2 class="school-section-title">
                        {{ $section->title }}
                    </h2>

                    @if($section->subtitle)

                        <p class="school-section-description">
                            {{ $section->subtitle }}
                        </p>

                    @endif

                </div>


                <div class="row g-4">

    @forelse($news as $item)

        <div class="col-md-4">

            <a
                href="{{ route('school.news.show', $item->slug) }}"
                class="text-decoration-none text-dark"
            >

                <div class="school-card h-100">

                    @if($item->image)

                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->title }}"
                            class="img-fluid rounded-3 mb-3"
                            style="width: 100%; height: 200px; object-fit: cover;"
                        >

                    @else

                        <div class="school-card-icon">
                            📰
                        </div>

                    @endif

                    <h4>
                        {{ $item->title }}
                    </h4>

                    @if($item->excerpt)

                        <p>
                            {{ $item->excerpt }}
                        </p>

                    @endif

                    <span class="text-decoration-none">
                        Selengkapnya →
                    </span>

                </div>

            </a>

        </div>

    @empty

        <div class="col-12">

            <div class="school-card">

                <p class="mb-0 text-muted">
                    Belum ada berita terbaru.
                </p>

            </div>

        </div>

    @endforelse

</div>


                                    @if($news->count())
                    <div class="text-center mt-5">
                        <a
                            href="{{ route('school.news.index') }}"
                            class="btn btn-primary"
                        >
                            Lihat Semua Berita →
                        </a>
                    </div>
                @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         PENGUMUMAN
    ====================================================== --}}

    @if($section->key === 'pengumuman')

        <section class="school-section">

            <div class="container">

                <div class="mb-5">

                    <span class="school-section-label">
                        PENGUMUMAN
                    </span>

                    <h2 class="school-section-title">
                        {{ $section->title }}
                    </h2>

                    @if($section->subtitle)

                        <p class="school-section-description">
                            {{ $section->subtitle }}
                        </p>

                    @endif

                </div>


                <div class="row g-4">

    @forelse($announcements as $announcement)

        <div class="col-md-6 col-lg-4">

            <article class="school-card h-100">

                @if($announcement->image)

                    <img
                        src="{{ asset('storage/' . $announcement->image) }}"
                        alt="{{ $announcement->title }}"
                        class="img-fluid rounded-4 mb-4 w-100"
                        style="height: 220px; object-fit: cover;"
                    >

                @endif

                @if($announcement->published_at)

                    <p class="text-muted small mb-2">
                        {{ $announcement->published_at->translatedFormat('d F Y, H:i') }}
                    </p>

                @endif

                <h3 class="h4 mb-3">
                    {{ $announcement->title }}
                </h3>

                @if($announcement->excerpt)

                    <p class="text-muted">
                        {{ $announcement->excerpt }}
                    </p>

                @endif

                <a
                    href="{{ route('school.announcements.show', $announcement->slug) }}"
                    class="btn btn-primary mt-2"
                >
                    Baca Pengumuman →
                </a>

            </article>

        </div>

    @empty

        <div class="col-12">

            <div class="school-card">

                <p class="mb-0 text-muted">
                    Belum ada pengumuman terbaru.
                </p>

            </div>

        </div>

    @endforelse

</div>
@if($announcements->count())
    <div class="text-center mt-5">
        <a
            href="{{ route('school.announcements.index') }}"
            class="btn btn-primary"
        >
            Lihat Semua Pengumuman →
        </a>
    </div>
@endif

            </div>

        </section>

    @endif

    {{-- =====================================================
         GALERI
    ====================================================== --}}

    @if($section->key === 'galeri')

        <section class="school-section bg-white">

            <div class="container">

                <div class="mb-5">

                    <span class="school-section-label">
                        GALERI
                    </span>

                    <h2 class="school-section-title">
                        {{ $section->title }}
                    </h2>

                    @if($section->subtitle)

                        <p class="school-section-description">
                            {{ $section->subtitle }}
                        </p>

                    @endif

                </div>


                <div class="row g-4">

                    @forelse($galleries as $gallery)

                        @php
                            $cover = $gallery->photos->first();
                        @endphp

                        <div class="col-md-4">

                            <a
                                href="{{ route('school.gallery.show', $gallery->slug) }}"
                                class="text-decoration-none text-dark"
                            >

                                <div class="school-card h-100">

                                    @if($cover)

                                        <img
                                            src="{{ asset('storage/' . $cover->image) }}"
                                            alt="{{ $gallery->title }}"
                                            class="img-fluid rounded-3 mb-3"
                                            style="width: 100%; height: 220px; object-fit: cover;"
                                        >

                                    @else

                                        <div class="school-card-icon">
                                            🖼️
                                        </div>

                                    @endif

                                    <h4>
                                        {{ $gallery->title }}
                                    </h4>

                                    @if($gallery->description)

                                        <p>
                                            {{ $gallery->description }}
                                        </p>

                                    @endif

                                    <span>
                                        Lihat Galeri →
                                    </span>

                                </div>

                            </a>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="school-card">

                                <p class="mb-0 text-muted">
                                    Belum ada galeri terbaru.
                                </p>

                            </div>

                        </div>

                    @endforelse

                </div>


                @if($galleries->count())

                    <div class="text-center mt-5">

                        <a
                            href="{{ route('school.gallery.index') }}"
                            class="btn btn-primary"
                        >
                            Lihat Semua Galeri →
                        </a>

                    </div>

                @endif

            </div>

        </section>

    @endif

    {{-- =====================================================
         KONTAK
    ====================================================== --}}

    @if($section->key === 'kontak')

        <section class="school-contact-section">

            <div class="container">

                <div class="row g-5 align-items-center">

                    <div class="col-lg-6">

                        <span class="school-section-label">
                            HUBUNGI KAMI
                        </span>

                        <h2 class="school-section-title">
                            {{ $section->title }}
                        </h2>

                        @if($section->subtitle)

                            <p class="school-section-description mt-3">
                                {{ $section->subtitle }}
                            </p>

                        @endif

                        @if($school?->address)

                            <div class="school-contact-item">

                                <div class="school-contact-label">
                                    Alamat
                                </div>

                                <div class="mt-1">
                                    {{ $school->address }}
                                </div>

                            </div>

                        @endif

                        @if($school?->village || $school?->district)

                            <div class="school-contact-item">

                                <div class="school-contact-label">
                                    Wilayah
                                </div>

                                <div class="mt-1">
                                    {{ $school?->village }}
                                    {{ $school?->district }}
                                </div>

                            </div>

                        @endif

                    </div>


                    <div class="col-lg-6">

                        <div class="school-contact-card">

                            @if($school?->phone)

                                <div class="school-contact-item">

                                    <div class="school-contact-label">
                                        Telepon
                                    </div>

                                    <div class="mt-1">
                                        {{ $school->phone }}
                                    </div>

                                </div>

                            @endif


                            @if($school?->email)

                                <div class="school-contact-item">

                                    <div class="school-contact-label">
                                        Email
                                    </div>

                                    <div class="mt-1">
                                        {{ $school->email }}
                                    </div>

                                </div>

                            @endif


                            @if($school?->website)

                                <div class="school-contact-item">

                                    <div class="school-contact-label">
                                        Website
                                    </div>

                                    <div class="mt-1">
                                        {{ $school->website }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif

@endforeach

@endsection
