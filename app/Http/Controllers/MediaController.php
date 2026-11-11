<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Archive;

class MediaController extends Controller
{
    public function photos()
    {
        $photos = Photo::where('status', true)
                      ->latest()
                      ->paginate(12);

        return view('gallery.photos', compact('photos'));
    }

    public function videos()
    {
        $videos = Video::where('status', true)
                      ->latest()
                      ->paginate(12);

        return view('gallery.videos', compact('videos'));
    }

    public function archives()
    {
        $archives = Archive::where('status', true)
                         ->latest()
                         ->paginate(12);

        return view('gallery.archives', compact('archives'));
    }

    public function showArchive(Archive $archive)
    {
        $photos = $archive->photos()
                         ->where('status', true)
                         ->latest()
                         ->paginate(12);

        return view('gallery.archive-show', compact('archive', 'photos'));
    }
}
