<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function shekor()
    {
        return view('facilities.shekor');
    }

    public function asShifa()
    {
        return view('facilities.as-shifa');
    }

    public function researchCenter()
    {
        return view('facilities.research-center');
    }

    public function maktabah()
    {
        return view('facilities.maktabah');
    }
}
