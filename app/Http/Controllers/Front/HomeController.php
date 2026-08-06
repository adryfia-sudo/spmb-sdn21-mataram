<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\RegistrationPath;
use App\Models\RegistrationPeriod;
use App\Models\School;
use App\Models\Registration;

class HomeController extends Controller
{
    public function index()
    {
        $school = \App\Models\School::first();

        $academicYear = \App\Models\AcademicYear::where('is_active', true)
            ->first();

        $registrationPeriod = \App\Models\RegistrationPeriod::where('is_active', true)
            ->first();

        $registrationPaths = \App\Models\RegistrationPath::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $totalQuota = $registrationPaths->sum('quota');

        $totalRegistered = Registration::count();

        $remainingQuota = max($totalQuota - $totalRegistered, 0);

        $totalPaths = $registrationPaths->count();

        return view('front.home', compact(
            'school',
            'academicYear',
            'registrationPeriod',
            'registrationPaths',
            'totalQuota',
            'totalRegistered',
            'remainingQuota',
            'totalPaths',
        ));
    }
}
