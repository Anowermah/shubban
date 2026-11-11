<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    public function index()
    {
        return view('education.hadith.index');
    }
}
