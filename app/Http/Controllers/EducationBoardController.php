<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducationBoardController extends Controller
{
    public function examSchedule()
    {
        return view('education.exam-schedule');
    }

    public function results()
    {
        return view('education.results');
    }

    public function syllabus()
    {
        return view('education.syllabus');
    }
}
