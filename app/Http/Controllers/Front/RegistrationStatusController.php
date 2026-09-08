<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationStatusController extends Controller
{
    public function index()
    {
        return view('front.registration.status');
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => [
                'required',
                'string',
                'max:50',
            ],
        ], [
            'registration_number.required' =>
                'Nomor pendaftaran wajib diisi.',
        ]);

        $registration = Registration::query()
            ->with('registrationPath')
            ->where(
                'registration_number',
                $validated['registration_number']
            )
            ->first();

        if (! $registration) {
            return back()
                ->withInput()
                ->with('status_error', 'Nomor pendaftaran tidak ditemukan.');
        }

        return view(
            'front.registration.status',
            compact('registration')
        );
    }
}
