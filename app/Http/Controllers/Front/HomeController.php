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
        $school = School::first();

        $academicYear = AcademicYear::where('is_active', true)
            ->first();

        $registrationPeriod = RegistrationPeriod::where('is_active', true)
            ->first();

        $registrationPaths = RegistrationPath::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $totalRegistered = Registration::count();

        $totalPaths = $registrationPaths->count();

        return view('front.home', compact(
            'school',
            'academicYear',
            'registrationPeriod',
            'registrationPaths',
            'totalRegistered',
            'totalPaths',
        ));
    }
}
