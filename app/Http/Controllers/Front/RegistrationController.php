<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('front.register.wizard');
    }

    public function store()
    {
        //
    }

    public function success()
    {
        return view('front.register.success');
    }
}
