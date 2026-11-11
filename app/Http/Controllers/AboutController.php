<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index');
    }

    public function history()
    {
        return view('about.history');
    }

    public function committee()
    {
        return view('about.committee');
    }

    public function introduction()
    {
        return view('about.introduction');
    }

    public function mission()
    {
        return view('about.mission');
    }

    public function goals()
    {
        return view('about.goals');
    }

    public function activities()
    {
        return view('about.activities');
    }
}
