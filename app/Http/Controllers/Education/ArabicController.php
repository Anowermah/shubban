<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArabicController extends Controller
{
    public function index()
    {
        return view('education.arabic.index');
    }
}
