<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\Department;
use App\Models\Official;
use Illuminate\Http\Request;

class CentralController extends Controller
{
    public function committee()
    {
        $members = Committee::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('central.committee', compact('members'));
    }

    public function departments()
    {
        $departments = Department::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('central.departments', compact('departments'));
    }

    public function officials()
    {
        $officials = Official::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('central.officials', compact('officials'));
    }
}
