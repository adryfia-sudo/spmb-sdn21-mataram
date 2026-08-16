<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>
        {{ $template?->document_title ?? 'BUKTI PENDAFTARAN' }}
    </title>

    <style>
        @page {
            margin: 20mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #222;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
        }

        .institution {
            font-size: 14px;
            font-weight: bold;
        }

        .address {
            font-size: 10px;
            margin-top: 5px;
        }

        .title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            margin: 20px 0 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }

        .registration-number {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 7px 5px;
            vertical-align: top;
        }

        .label {
            width: 35%;
            font-weight: bold;
        }

        .section {
            background: #f1f1f1;
            font-weight: bold;
            padding: 8px;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .documents {
            margin-top: 10px;
        }

        .document-row {
            border-bottom: 1px solid #ddd;
            padding: 6px 0;
        }

        .footer {
            margin-top: 40px;
        }

        .verification {
            width: 45%;
            margin-left: auto;
            text-align: center;
        }

        .signature-space {
            height: 60px;
        }

        .notes {
            margin-top: 25px;
            font-size: 10px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}

    <div class="header">

        @if($template?->school_name)
            <div class="school-name">
                {{ $template->school_name }}
            </div>
        @endif

        @if($template?->institution_name)
            <div class="institution">
                {{ $template->institution_name }}
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

    </div>


    {{-- TITLE --}}

    <div class="title">
        {{ $template?->document_title ?? 'BUKTI PENDAFTARAN' }}
    </div>

    @if($template?->document_subtitle)
        <div class="subtitle">
            {{ $template->document_subtitle }}
        </div>
    @endif


    {{-- NOMOR PENDAFTARAN --}}

    <div class="registration-number">
        {{ $registration->registration_number }}
    </div>


    {{-- DATA PENDAFTAR --}}

    <div class="section">
        DATA PESERTA DIDIK
    </div>

    <table>

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
                : {{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
            </td>
        </tr>

        <tr>
            <td class="label">
                Tempat, Tanggal Lahir
            </td>
            <td>
                :
                {{ $registration->birth_place }},
                {{ optional($registration->birth_date)->translatedFormat('d F Y') }}
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

        <tr>
            <td class="label">
                Status
            </td>
            <td>
                : {{ ucfirst($registration->status) }}
            </td>
        </tr>

    </table>


    {{-- DOKUMEN --}}

    @php
        $proofDocuments = $registration->documents
            ->filter(function ($document) use ($registration) {

                $pivot = $document->documentType
                    ?->registrationPaths
                    ?->firstWhere('id', $registration->registration_path_id)
                    ?->pivot;

                return $pivot
                    && (bool) $pivot->show_in_proof;
            });
    @endphp

    @if($proofDocuments->isNotEmpty())

        <div class="section">
            DOKUMEN YANG DIUNGGAH
        </div>

        <div class="documents">

            @foreach($proofDocuments as $document)

                <div class="document-row">

                    <strong>
                        {{ $document->documentType?->name }}
                    </strong>

                    <br>

                    {{ $document->original_name }}

                </div>

            @endforeach

        </div>

    @endif


    {{-- CATATAN --}}

    @if($template?->notes)

        <div class="notes">

            <strong>Catatan:</strong>

            <br>

            {!! nl2br(e($template->notes)) !!}

        </div>

    @endif


    {{-- VERIFIKATOR --}}

    <div class="footer">

        <div class="verification">

            {{ $template?->city ?? 'Mataram' }},
            {{ now()->translatedFormat('d F Y') }}

            <br><br>

            {{ $template?->verification_title ?? 'VERIFIKATOR' }}

            <div class="signature-space"></div>

            <strong>
                {{ $template?->verification_name ?? '........................................' }}
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
