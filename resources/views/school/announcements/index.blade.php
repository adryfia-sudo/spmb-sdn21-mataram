@extends('layouts.school')

@section('title', 'Pengumuman - ' . ($school?->school_name ?? 'Website Sekolah'))

@section('content')

<section class="school-section">

    <div class="container">

        <div class="mb-5">

            <span class="school-section-label">
                PENGUMUMAN
            </span>

            <h1 class="school-section-title">
                Pengumuman Sekolah
            </h1>

            <p class="school-section-description">
                Informasi dan pengumuman resmi dari SD Negeri 21 Mataram.
            </p>

        </div>


        @if($announcements->count())

            <div class="row g-4">

                @foreach($announcements as $announcement)

                    <div class="col-md-6 col-lg-4">

                        <article class="h-100">

                            @if($announcement->image)

                                <div class="mb-3">

                                    <img
                                        src="{{ asset('storage/' . $announcement->image) }}"
                                        alt="{{ $announcement->title }}"
                                        class="img-fluid rounded-4 shadow-sm w-100"
                                        style="height: 220px; object-fit: cover;"
                                    >

                                </div>

                            @endif


                            <div>

                                @if($announcement->published_at)

                                    <p class="text-muted small mb-2">
                                        {{ $announcement->published_at->translatedFormat('d F Y, H:i') }}
                                    </p>

                                @endif

                                <h2 class="h4 mb-3">
                                    {{ $announcement->title }}
                                </h2>

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

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        @else

            <div class="py-5 text-center">

                <p class="text-muted mb-0">
                    Belum ada pengumuman terbaru.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection
