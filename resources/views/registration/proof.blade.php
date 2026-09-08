<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>
        {{ $template?->document_title ?? 'BUKTI PENDAFTARAN' }}
    </title>

    <style>
        @page {
            margin: 15mm 18mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
            margin: 0;
            padding: 0;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .header {
            width: 100%;
            border-bottom: 3px solid #222;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: middle;
            padding: 0;
        }

        .logo-left,
        .logo-right {
            width: 18%;
            text-align: center;
        }

        .header-center {
            width: 64%;
            text-align: center;
        }

        .logo-left img,
        .logo-right img {
            width: 75px;
            height: 75px;
            object-fit: contain;
        }

        .institution {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .address {
            font-size: 9px;
            line-height: 1.4;
        }

        /* =========================================================
           JUDUL
        ========================================================= */

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 12px 0 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 10px;
            margin-bottom: 12px;
        }

        /* =========================================================
           NOMOR PENDAFTARAN
        ========================================================= */

        .registration-number {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0 18px;
        }

        /* =========================================================
           SECTION
        ========================================================= */

        .section {
            background: #eeeeee;
            border: 1px solid #d5d5d5;
            font-weight: bold;
            padding: 7px;
            margin-top: 12px;
            margin-bottom: 6px;
        }

        /* =========================================================
           DATA PESERTA
        ========================================================= */

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 5px 4px;
            vertical-align: top;
        }

        .label {
            width: 35%;
            font-weight: bold;
        }

        /* =========================================================
           PERSYARATAN
        ========================================================= */

        .documents {
            margin-top: 5px;
        }

        .documents ol {
            margin-top: 3px;
            margin-bottom: 0;
            padding-left: 25px;
        }

        .documents li {
            padding: 3px 0;
        }

        .document-note {
            font-size: 9px;
            color: #555;
            margin-top: 2px;
        }

        /* =========================================================
           CATATAN
        ========================================================= */

        .notes {
            margin-top: 18px;
            font-size: 9px;
            line-height: 1.5;
        }

        /* =========================================================
           FOOTER / TANDA TANGAN
        ========================================================= */

        .footer {
            margin-top: 25px;
            width: 100%;
        }

        .verification {
            width: 45%;
            margin-left: auto;
            text-align: center;
            font-size: 10px;
        }

        .signature-space {
            height: 55px;
        }

        /* =========================================================
           PRINT
        ========================================================= */

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

   @php
    $governmentLogo = null;
    $schoolLogo = null;

    /*
    |--------------------------------------------------------------------------
    | Logo Pemerintah
    |--------------------------------------------------------------------------
    */

    if ($template?->logo_government) {
        $governmentLogoPath = storage_path(
            'app/public/' . $template->logo_government
        );

        if (is_file($governmentLogoPath)) {
            $extension = strtolower(
                pathinfo($governmentLogoPath, PATHINFO_EXTENSION)
            );

            $mime = match ($extension) {
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp',
                default => null,
            };

            if ($mime) {
                $governmentLogo =
                    'data:' . $mime . ';base64,' .
                    base64_encode(
                        file_get_contents($governmentLogoPath)
                    );
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Logo Sekolah
    |--------------------------------------------------------------------------
    */

    if ($template?->logo_school) {
        $schoolLogoPath = storage_path(
            'app/public/' . $template->logo_school
        );

        if (is_file($schoolLogoPath)) {
            $extension = strtolower(
                pathinfo($schoolLogoPath, PATHINFO_EXTENSION)
            );

            $mime = match ($extension) {
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp',
                default => null,
            };

            if ($mime) {
                $schoolLogo =
                    'data:' . $mime . ';base64,' .
                    base64_encode(
                        file_get_contents($schoolLogoPath)
                    );
            }
        }
    }

    @endphp


   <div class="header">

    <table class="header-table">
        <tr>

            {{-- LOGO PEMERINTAH KOTA --}}
            <td class="logo-left">
                @if($governmentLogo)
                    <img
                        src="{{ $governmentLogo }}"
                        alt="Logo Pemerintah Kota Mataram"
                    >
                @endif
            </td>

            {{-- IDENTITAS SEKOLAH --}}
            <td class="header-center">

                @if($template?->institution_name)
                    <div class="institution">
                        {{ $template->institution_name }}
                    </div>
                @endif

                @if($template?->school_name)
                    <div class="school-name">
                        {{ $template->school_name }}
                    </div>
                @endif

                @if($template?->address)
                    <div class="address">
                        {{ $template->address }}
                    </div>
                @endif

                @if($template?->phone || $template?->email)
                    <div class="address">

                        @if($template?->phone)
                            Telp. {{ $template->phone }}
                        @endif

                        @if($template?->phone && $template?->email)
                            &nbsp; | &nbsp;
                        @endif

                        @if($template?->email)
                            {{ $template->email }}
                        @endif

                    </div>
                @endif

            </td>

            {{-- LOGO SEKOLAH --}}
            <td class="logo-right">
                @if($schoolLogo)
                    <img
                        src="{{ $schoolLogo }}"
                        alt="Logo SDN 21 Mataram"
                    >
                @endif
            </td>

        </tr>
    </table>

</div>


    {{-- =========================================================
         JUDUL
    ========================================================== --}}

    <div class="title">
        {{ $template?->document_title ?? 'BUKTI PENDAFTARAN' }}
    </div>

    @if($template?->document_subtitle)

        <div class="subtitle">
            {{ $template->document_subtitle }}
        </div>

    @endif


    {{-- =========================================================
         NOMOR PENDAFTARAN
    ========================================================== --}}

    <div class="registration-number">
        {{ $registration->registration_number }}
    </div>


    {{-- =========================================================
         DATA PESERTA DIDIK
    ========================================================== --}}

    <div class="section">
        DATA PESERTA DIDIK
    </div>

    <table class="data-table">

        <tr>
            <td class="label">
                Nama Lengkap
            </td>
            <td>
                : {{ $registration->full_name }}
            </td>
        </tr>

        <tr>
            <td class="label">
                NIK
            </td>
            <td>
                : {{ $registration->nik }}
            </td>
        </tr>

        <tr>
            <td class="label">
                NISN
            </td>
            <td>
                : {{ $registration->nisn ?: '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Jenis Kelamin
            </td>
            <td>
                : {{ $registration->gender === 'L'
                    ? 'Laki-laki'
                    : 'Perempuan' }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Tempat, Tanggal Lahir
            </td>
            <td>
                :
                {{ $registration->birth_place }},
                {{ optional($registration->birth_date)
                    ->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Jalur Pendaftaran
            </td>
            <td>
                : {{ $registration->registrationPath?->name }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Tahun Pelajaran
            </td>
            <td>
                : {{ $registration->academicYear?->name }}
            </td>
        </tr>

    </table>


{{-- =========================================================
     PERSYARATAN WAJIB
========================================================== --}}

@php
    $requiredRequirements = $registration->registrationPath?->requirements
        ?->filter(function ($requirement) use ($registration) {

            /*
             * Semua persyaratan yang ditampilkan harus:
             * - aktif
             * - dikonfigurasi tampil di bukti pendaftaran
             */
            if (
                ! (bool) $requirement->pivot->is_active ||
                ! (bool) $requirement->pivot->show_in_proof
            ) {
                return false;
            }

            /*
             * KTP Wali adalah pengecualian.
             *
             * KTP Wali ditampilkan jika peserta memiliki
             * data wali pada Step 6, walaupun is_required = 0.
             */
            if (
                mb_strtolower(trim($requirement->name)) === 'ktp wali'
            ) {
                return $registration->guardian !== null;
            }

            /*
             * Persyaratan lainnya hanya ditampilkan
             * jika ditandai sebagai wajib.
             */
            return (bool) $requirement->pivot->is_required;
        })
        ?? collect();
@endphp

@if($requiredRequirements->isNotEmpty())

    <div class="section">
        PERSYARATAN WAJIB YANG HARUS DIBAWA KE SEKOLAH
    </div>

    <div class="documents">

        <ol style="margin-top: 5px; padding-left: 25px;">

            @foreach($requiredRequirements as $requirement)

                <li style="padding: 4px 0;">

                    <strong>
                        {{ $requirement->name }}
                    </strong>

                    @if($requirement->pivot->notes)
                        <br>

                        <span style="font-size: 10px;">
                            {{ $requirement->pivot->notes }}
                        </span>
                    @endif

                </li>

            @endforeach

        </ol>

    </div>

@endif


    {{-- =========================================================
         CATATAN
    ========================================================== --}}

    @if($template?->notes)

        <div class="notes">

            <strong>Catatan:</strong>

            <br>

            {!! nl2br(e($template->notes)) !!}

        </div>

    @endif


    {{-- =========================================================
         VERIFIKATOR
    ========================================================== --}}

    <div class="footer">

        <div class="verification">

            {{ $template?->city ?? 'Mataram' }},
            {{ now()->translatedFormat('d F Y') }}

            <br><br>

            {{ $template?->verification_title ?? 'VERIFIKATOR' }}

            <div class="signature-space"></div>

            <strong>
                {{ $template?->verification_name
                    ?? '........................................' }}
            </strong>

            @if($template?->verification_nip)

                <br>

                NIP. {{ $template->verification_nip }}

            @endif

            @if($template?->verification_position)

                <br>

                {{ $template->verification_position }}

            @endif

        </div>

    </div>

</body>
</html>
