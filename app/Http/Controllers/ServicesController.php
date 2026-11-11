<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function social()
    {
        return view('services.social');
    }

    public function charity()
    {
        return view('services.charity');
    }

    public function medical()
    {
        return view('services.medical');
    }

    public function education()
    {
        return view('services.education');
    }
}
