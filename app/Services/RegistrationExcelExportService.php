<?php

namespace App\Services;

use App\Models\Registration;
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
            ])
            ->orderBy('registration_number')
            ->get();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pendaftaran');

        /*
        |--------------------------------------------------------------------------
        | Judul
        |--------------------------------------------------------------------------
        */

        $sheet->mergeCells('A1:K1');

        $sheet->setCellValue(
            'A1',
            'DATA PENDAFTARAN MURID BARU - SD NEGERI 21 MATARAM'
        );

        $sheet->mergeCells('A2:K2');

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
                $registration->full_name
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
                $registration->gender
            );

            $sheet->setCellValue(
                "G{$row}",
                $registration->birth_place
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

        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('A1:K1')->getFont()->setSize(14);

        $sheet->getStyle('A2:K2')->getFont()->setBold(true);

        $sheet->getStyle('A4:K4')->getFont()->setBold(true);

        $sheet->getStyle('A4:K4')
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

        foreach (range('A', 'K') as $column) {
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
