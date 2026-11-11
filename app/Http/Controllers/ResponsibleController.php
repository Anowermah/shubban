<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponsibleController extends Controller
{
    public function index($level)
    {
        $title = '';
        switch ($level) {
            case 'central':
                $title = 'কেন্দ্রীয় দায়িত্বশীলবৃন্দ';
                break;
            case 'district':
                $title = 'জেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            case 'upazila':
                $title = 'উপজেলা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            case 'thana':
                $title = 'থানা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            case 'branch':
                $title = 'শাখা দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            case 'union':
                $title = 'ইউনিয়ন দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            case 'ward':
                $title = 'ওয়ার্ড দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ';
                break;
            default:
                abort(404);
        }

        if ($level === 'central') {
            $managers = Committee::where('is_active', true)
                ->orderBy('order')
                ->get();
            $members = $managers;

            return view('responsible.central', compact('managers', 'members', 'title'));
        }
        
        try {
            $query = Management::where('level', $level);
            if (\Illuminate\Support\Facades\Schema::hasColumn('managements', 'status')) {
                $query->where('status', 1);
            } elseif (\Illuminate\Support\Facades\Schema::hasColumn('managements', 'is_active')) {
                $query->where('is_active', 1);
            }
            $responsiblePersons = $query->orderBy('order')->get();
        } catch (\Throwable $e) {
            $responsiblePersons = collect();
        }
        $managers = $responsiblePersons;

        return view('responsible.' . $level, compact('responsiblePersons', 'managers', 'title', 'level'));
    }

    public function central()
    {
        $managers = Committee::where('is_active', true)
            ->orderBy('order')
            ->get();
        $members = $managers;

        return view('responsible.central', [
            'managers' => $managers,
            'members' => $managers,
            'title' => 'কেন্দ্রীয় দায়িত্বশীলবৃন্দ'
        ]);
    }

    public function district()
    {
        return $this->index('district');
    }

    public function upazila()
    {
        return $this->index('upazila');
    }

    public function thana()
    {
        return $this->index('thana');
    }

    public function branch()
    {
        return $this->index('branch');
    }
}
