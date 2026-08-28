<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cek Status Pendaftaran - SPMB SD Negeri 21 Mataram</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 26px;
            color: #111827;
        }

        .header p {
            margin: 0;
            color: #6b7280;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .button {
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 13px 18px;
            background: #2563eb;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .alert {
            border-radius: 8px;
            padding: 13px 15px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .result {
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 25px;
        }

        .result h2 {
            margin: 0 0 20px;
            font-size: 20px;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 13px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .data-label {
            color: #6b7280;
        }

        .data-value {
            font-weight: 600;
            text-align: right;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-verified {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-accepted {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-default {
            background: #e5e7eb;
            color: #374151;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #2563eb;
            text-decoration: none;
        }

        .back:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .card {
                padding: 22px;
            }

            .header h1 {
                font-size: 22px;
            }

            .data-row {
                flex-direction: column;
                gap: 5px;
            }

            .data-value {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">
            <h1>Cek Status Pendaftaran</h1>

            <p>
                SPMB SD Negeri 21 Mataram
            </p>

            <p>
                Masukkan nomor pendaftaran untuk melihat status pendaftaran Anda.
            </p>
        </div>

        @if (session('status_error'))
            <div class="alert alert-error">
                {{ session('status_error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form
            action="{{ route('registration.status.check') }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label for="registration_number">
                    Nomor Pendaftaran
                </label>

                <input
                    type="text"
                    id="registration_number"
                    name="registration_number"
                    value="{{ old('registration_number') }}"
                    placeholder="Contoh: SPMB-2026-0001"
                    autocomplete="off"
                    required
                >
            </div>

            <button type="submit" class="button">
                Cek Status Pendaftaran
            </button>
        </form>

        @isset($registration)

            <div class="result">

                <h2>Hasil Pendaftaran</h2>

                <div class="data-row">
                    <span class="data-label">
                        Nomor Pendaftaran
                    </span>

                    <span class="data-value">
                        {{ $registration->registration_number }}
                    </span>
                </div>

                <div class="data-row">
                    <span class="data-label">
                        Nama
                    </span>

                    <span class="data-value">
                        {{ $registration->full_name }}
                    </span>
                </div>

                <div class="data-row">
                    <span class="data-label">
                        Jalur Pendaftaran
                    </span>

                    <span class="data-value">
                        {{ $registration->registrationPath?->name ?? '-' }}
                    </span>
                </div>

                <div class="data-row">
                    <span class="data-label">
                        Status
                    </span>

                    <span class="data-value">

                        @php
                            $status = $registration->status;

                            $statusLabel = match ($status) {
                                'pending' => 'Belum Verifikasi',
                                'verified' => 'Terverifikasi',
                                'accepted' => 'Diterima',
                                'rejected' => 'Tidak Diterima',
                                default => ucfirst($status),
                            };

                            $statusClass = match ($status) {
                                'pending' => 'status-pending',
                                'verified' => 'status-verified',
                                'accepted' => 'status-accepted',
                                'rejected' => 'status-rejected',
                                default => 'status-default',
                            };
                        @endphp

                        <span class="status {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>

                    </span>
                </div>

            </div>

        @endisset

        <a
            href="{{ route('home') }}"
            class="back"
        >
            ← Kembali ke Halaman Utama
        </a>

    </div>

</div>

</body>
</html>
