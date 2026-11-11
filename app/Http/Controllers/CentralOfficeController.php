<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CentralOfficeController extends Controller
{
    public function committee()
    {
        return view('central.committee');
    }

    public function departments()
    {
        return view('central.departments');
    }

    public function officials()
    {
        return view('central.officials');
    }
}
