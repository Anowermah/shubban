<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $year = $request->query('year');

        $query = Notice::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        $notices = $query->latest()->paginate(10)->withQueryString();
        $archives = method_exists(Notice::class, 'getArchives') ? Notice::getArchives() : collect();
        $categories = Notice::whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('notice.index', compact('notices', 'archives', 'categories'));
    }

    public function category($category)
    {
        return redirect()->route('notice.index', ['category' => $category]);
    }

    public function archive($year, $month)
    {
        $notices = Notice::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $archives = method_exists(Notice::class, 'getArchives') ? Notice::getArchives() : collect();
        $categories = Notice::whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('notice.index', compact('notices', 'archives', 'categories'));
    }
}
