<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IslamicStudiesController extends Controller
{
    public function index()
    {
        return view('education.islamic-studies.index');
    }
}
