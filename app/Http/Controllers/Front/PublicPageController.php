<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPath;
use App\Models\RegistrationPeriod;
use App\Models\Requirement;
use App\Models\School;

class PublicPageController extends Controller
{
    public function profile()
    {
        $school = School::query()->first();

        return view('front.pages.profile', compact('school'));
    }

    public function schedule()
    {
        $registrationPeriod = RegistrationPeriod::query()
            ->with('academicYear')
            ->where('is_active', true)
            ->latest('id')
            ->first();

        return view(
            'front.pages.schedule',
            compact('registrationPeriod')
        );
    }

    public function paths()
    {
        $registrationPaths = RegistrationPath::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->get();

        return view(
            'front.pages.paths',
            compact('registrationPaths')
        );
    }

    public function requirements()
    {
        $requirements = Requirement::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->get();

        return view(
            'front.pages.requirements',
            compact('requirements')
        );
    }
}
