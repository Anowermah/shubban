<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::where('status', true)
                      ->latest()
                      ->paginate(12)
                      ->withQueryString();

        return view('gallery.index', compact('photos'));
    }

    public function photos(Request $request)
    {
        $query = Photo::orderBy('date', 'desc')->where('status', true);

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $photos = $query->paginate(12)->withQueryString();
        
        $categories = Photo::where('status', true)
                         ->whereNotNull('category')
                         ->distinct()
                         ->pluck('category')
                         ->filter();

        return view('gallery.photos', compact('photos', 'categories'));
    }

    public function videos(Request $request)
    {
        $query = Video::orderBy('date', 'desc')->where('status', true);

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $videos = $query->paginate(12)->withQueryString();
        
        $categories = Video::where('status', true)
                         ->whereNotNull('category')
                         ->distinct()
                         ->pluck('category')
                         ->filter();

        return view('gallery.videos', compact('videos', 'categories'));
    }
}
