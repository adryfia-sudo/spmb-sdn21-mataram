<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\Region;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationExcelExportService
{
    public function download($query): StreamedResponse
    {
        $registrations = $query
            ->with([
                'academicYear',
                'registrationPath',
                'registrationPeriod',
                'address',
            ])
            ->orderBy('registration_number')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Ambil nama wilayah berdasarkan kode
        |--------------------------------------------------------------------------
        */

        $regionCodes = $registrations
            ->flatMap(function ($registration) {
                $address = $registration->address;

                return [
                    $address?->province,
                    $address?->city,
                    $address?->district,
                    $address?->village,
                ];
            })
            ->filter()
            ->unique()
            ->values();

        $regions = Region::query()
            ->whereIn('code', $regionCodes)
            ->pluck('name', 'code');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pendaftaran');

        /*
        |--------------------------------------------------------------------------
        | Judul
        |--------------------------------------------------------------------------
        */

        $sheet->mergeCells('A1:T1');

        $sheet->setCellValue(
            'A1',
            'DATA PENDAFTARAN MURID BARU - SD NEGERI 21 MATARAM'
        );

        $sheet->mergeCells('A2:T2');

        $sheet->setCellValue(
            'A2',
            'Sistem Penerimaan Murid Baru'
        );

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        $headers = [
            'No',
            'No. Pendaftaran',
            'Nama Lengkap',
            'NIK',
            'NISN',
            'L/P',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jalur',
            'Tahun Ajaran',
            'Provinsi',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kelurahan/Desa',
	    'Alamat',
	    'Dusun/Lingkungan',
	    'RT',
	    'RW',
	    'Kode Pos',
            'Status',
        ];

        $column = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue(
                $column . '4',
                $header
            );

            $column++;
        }

        /*
        |--------------------------------------------------------------------------
        | Data
        |--------------------------------------------------------------------------
        */

        $row = 5;
        $number = 1;

        foreach ($registrations as $registration) {

            $address = $registration->address;

            $province = $regions[$address?->province] ?? '';
            $city = $regions[$address?->city] ?? '';
            $district = $regions[$address?->district] ?? '';
            $village = $regions[$address?->village] ?? '';

            $sheet->setCellValue(
                "A{$row}",
                $number
            );

            $sheet->setCellValueExplicit(
                "B{$row}",
                $registration->registration_number ?? '',
                \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );

            $sheet->setCellValue(
                "C{$row}",
                $registration->full_name ?? ''
            );

            $sheet->setCellValueExplicit(
                "D{$row}",
                $registration->nik ?? '',
                \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );

            $sheet->setCellValueExplicit(
                "E{$row}",
                $registration->nisn ?? '',
                \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );

            $sheet->setCellValue(
                "F{$row}",
                $registration->gender ?? ''
            );

            $sheet->setCellValue(
                "G{$row}",
                $registration->birth_place ?? ''
            );

            $sheet->setCellValue(
                "H{$row}",
                $registration->birth_date
                    ? $registration->birth_date->format('d-m-Y')
                    : ''
            );

            $sheet->setCellValue(
                "I{$row}",
                $registration->registrationPath?->name ?? ''
            );

            $sheet->setCellValue(
                "J{$row}",
                $registration->academicYear?->name ?? ''
            );

            $sheet->setCellValue(
                "K{$row}",
                 $regions[$registration->address?->province] ?? ''
            );

            $sheet->setCellValue(
                "L{$row}",
                 $regions[$registration->address?->city] ?? ''
            );

            $sheet->setCellValue(
                "M{$row}",
                $regions[$registration->address?->district] ?? ''
            );

            $sheet->setCellValue(
                "N{$row}",
                $regions[$registration->address?->village] ?? ''
            );

            $sheet->setCellValue(
                "O{$row}",
                $registration->address?->address ?? ''
            );
$sheet->setCellValue(
    "P{$row}",
    $registration->address?->hamlet ?? ''
);

$sheet->setCellValue(
    "Q{$row}",
    $registration->address?->rt ?? ''
);
$sheet->setCellValue(
    "R{$row}",
    $registration->address?->rw ?? ''
);

$sheet->setCellValue(
    "S{$row}",
    $registration->address?->postal_code ?? ''
);
$sheet->setCellValue(
    "T{$row}",
    $registration->status ?? ''
);

            $row++;
            $number++;
        }

        /*
        |--------------------------------------------------------------------------
        | Styling
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle('A1:T1')->getFont()->setBold(true);
        $sheet->getStyle('A1:T1')->getFont()->setSize(14);

        $sheet->getStyle('A2:T2')->getFont()->setBold(true);

        $sheet->getStyle('A4:T4')->getFont()->setBold(true);

        $sheet->getStyle('A4:T4')
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $sheet->freezePane('A5');

        /*
        |--------------------------------------------------------------------------
        | Auto width
        |--------------------------------------------------------------------------
        */

        foreach (range('A', 'T') as $column) {
            $sheet
                ->getColumnDimension($column)
                ->setAutoSize(true);
        }

        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        $filename =
            'SPMB_SDN21_Mataram_' .
            now()->format('Y-m-d_H-i-s') .
            '.xlsx';

        return response()->streamDownload(
            function () use ($spreadsheet) {

                $writer = new Xlsx($spreadsheet);

                $writer->save('php://output');
            },
            $filename,
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        );
    }
}
