<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\RegistrationProofTemplate;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationProofController extends Controller
{
    public function preview(Registration $registration)
    {
        $registration->load([
            'registrationPath.requirements',
            'academicYear',
            'registrationPeriod',
            'address',
            'father',
            'mother',
            'guardian',
            'documents.documentType',
        ]);

        $template = RegistrationProofTemplate::query()
            ->where('is_active', true)
            ->first();

        return view('registration.proof', [
            'registration' => $registration,
            'template' => $template,
        ]);
    }

    public function download(Registration $registration)
    {
        $registration->load([
            'registrationPath.requirements',
            'academicYear',
            'registrationPeriod',
            'address',
            'father',
            'mother',
            'guardian',
            'documents.documentType',
        ]);

        $template = RegistrationProofTemplate::query()
            ->where('is_active', true)
            ->first();

        $pdf = Pdf::loadView('registration.proof', [
            'registration' => $registration,
            'template' => $template,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'Bukti-Pendaftaran-' .
            $registration->registration_number .
            '.pdf'
        );
    }
}
