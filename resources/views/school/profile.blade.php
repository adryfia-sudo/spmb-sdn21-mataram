@extends('layouts.school')

@section('title', 'Profil Sekolah - ' . ($school?->school_name ?? 'SD Negeri 21 Mataram'))

@section('content')

<section class="school-section">

    <div class="container">

        {{-- HEADER --}}

        <div class="mb-5">

            <span class="school-section-label">
                PROFIL SEKOLAH
            </span>

            <h1 class="school-section-title">
                {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}
            </h1>

            <p class="school-section-description mt-3">
                Informasi resmi mengenai identitas dan profil sekolah.
            </p>

        </div>


        <div class="row g-5 align-items-start">

            {{-- LOGO --}}

            <div class="col-lg-4">

                <div class="school-card text-center">

                    @if($school?->logo)

                        <img
                            src="{{ asset('storage/' . $school->logo) }}"
                            alt="{{ $school->school_name }}"
                            style="
                                width: 220px;
                                height: 220px;
                                object-fit: contain;
                                margin-bottom: 25px;
                            "
                        >

                    @endif

                    <h3>
                        {{ $school?->school_name ?? 'SD Negeri 21 Mataram' }}
                    </h3>

                    @if($school?->npsn)

                        <p class="mb-0">
                            NPSN: {{ $school->npsn }}
                        </p>

                    @endif

                </div>

            </div>


            {{-- IDENTITAS SEKOLAH --}}

            <div class="col-lg-8">

                <div class="school-card">

                    <h3 class="mb-4">
                        Identitas Sekolah
                    </h3>


                    @if($school?->npsn)

                        <div class="school-contact-item">

                            <div class="school-contact-label">
                                NPSN
                            </div>

                            <div>
                                {{ $school->npsn }}
                            </div>

                        </div>

                    @endif


                    @if($school?->principal_name)

                        <div class="school-contact-item">

                            <div class="school-contact-label">
                                Kepala Sekolah
                            </div>

                            <div>
                                {{ $school->principal_name }}

                                @if($school->principal_nip)
                                    <br>
                                    <small class="text-muted">
                                        NIP: {{ $school->principal_nip }}
                                    </small>
                                @endif

                            </div>

                        </div>

                    @endif


                    @if($school?->operator_name)

                        <div class="school-contact-item">

                            <div class="school-contact-label">
                                Operator Sekolah
                            </div>

                            <div>
                                {{ $school->operator_name }}
                            </div>

                        </div>

                    @endif


                    @if($school?->address)

                        <div class="school-contact-item">

                            <div class="school-contact-label">
                                Alamat
                            </div>

                            <div>
                                {{ $school->address }}

                                @if($school->village)
                                    <br>{{ $school->village }}
                                @endif

                                @if($school->district)
                                    <br>{{ $school->district }}
                                @endif

                                @if($school->city)
                                    <br>{{ $school->city }}
                                @endif

                                @if($school->province)
                                    <br>{{ $school->province }}
                                @endif

                                @if($school->postal_code)
                                    <br>{{ $school->postal_code }}
                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- KONTAK --}}

        @if(
            $school?->email ||
            $school?->phone ||
            $school?->whatsapp ||
            $school?->website
        )

            <div class="row g-4 mt-4">

                @if($school?->email)

                    <div class="col-md-6">

                        <div class="school-card">

                            <div class="school-card-icon">
                                ✉️
                            </div>

                            <h4>
                                Email
                            </h4>

                            <p>
                                {{ $school->email }}
                            </p>

                        </div>

                    </div>

                @endif


                @if($school?->phone)

                    <div class="col-md-6">

                        <div class="school-card">

                            <div class="school-card-icon">
                                ☎️
                            </div>

                            <h4>
                                Telepon
                            </h4>

                            <p>
                                {{ $school->phone }}
                            </p>

                        </div>

                    </div>

                @endif


                @if($school?->whatsapp)

                    <div class="col-md-6">

                        <div class="school-card">

                            <div class="school-card-icon">
                                💬
                            </div>

                            <h4>
                                WhatsApp
                            </h4>

                            <p>
                                {{ $school->whatsapp }}
                            </p>

                        </div>

                    </div>

                @endif


                @if($school?->website)

                    <div class="col-md-6">

                        <div class="school-card">

                            <div class="school-card-icon">
                                🌐
                            </div>

                            <h4>
                                Website
                            </h4>

                            <p>
                                {{ $school->website }}
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        @endif

    </div>

</section>

@endsection
