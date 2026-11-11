<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function publicIndex(Request $request)
    {
        $search = $request->query('search');

        $query = Activity::where('status', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $activities = $query->latest()->paginate(12)->withQueryString();

        return view('activities.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        if (!$activity->status) {
            abort(404);
        }

        return view('activities.show', compact('activity'));
    }
}
