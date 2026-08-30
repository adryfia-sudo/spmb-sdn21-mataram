<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPath;
use App\Models\RegistrationPeriod;
use App\Models\School;

class InformationController extends Controller
{
    public function profile()
    {
        $school = School::query()->first();

        return view('front.information.profile', compact(
            'school'
        ));
    }

    public function schedule()
    {
        $registrationPeriod = RegistrationPeriod::query()
            ->where('is_active', true)
            ->with('academicYear')
            ->first();

        return view('front.information.schedule', compact(
            'registrationPeriod'
        ));
    }

    public function paths()
    {
        $registrationPaths = RegistrationPath::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('front.information.paths', compact(
            'registrationPaths'
        ));
    }

    public function requirements()
    {
        $registrationPaths = RegistrationPath::query()
            ->where('is_active', true)
            ->with([
                'requirements' => function ($query) {
                    $query
                        ->wherePivot('is_active', true)
                        ->orderBy('name');
                },
            ])
            ->orderBy('name')
            ->get();

        return view('front.information.requirements', compact(
            'registrationPaths'
        ));
    }
}
