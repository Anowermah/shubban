<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function madrasas()
    {
        return view('institutions.madrasas');
    }

    public function mosques()
    {
        return view('institutions.mosques');
    }

    public function orphanages()
    {
        return view('institutions.orphanages');
    }

    public function libraries()
    {
        return view('institutions.libraries');
    }
}
