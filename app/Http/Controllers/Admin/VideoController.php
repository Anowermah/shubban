<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::orderBy('date', 'desc');
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        $videos = $query->paginate(12)->withQueryString();
        
        // Get unique categories
        $categories = Video::select('category')
            ->distinct()
            ->get()
            ->pluck('category')
            ->filter()
            ->values();
        
        return view('admin.videos.index', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'category' => 'nullable|string|max:255',
            'date' => 'required|date',
            'status' => 'boolean'
        ]);

        // Get video ID from URL
        $videoId = $this->getVideoId($request->video_url);
        if (!$videoId) {
            return back()->with('error', 'Invalid YouTube URL');
        }

        // Get thumbnail URL
        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";

        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'thumbnail_url' => $thumbnailUrl,
            'category' => $request->category,
            'date' => $request->date,
            'status' => $request->status ?? true
        ]);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video added successfully');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'category' => 'nullable|string|max:255',
            'date' => 'required|date',
            'status' => 'boolean'
        ]);

        // Get video ID from URL
        $videoId = $this->getVideoId($request->video_url);
        if (!$videoId) {
            return back()->with('error', 'Invalid YouTube URL');
        }

        // Get thumbnail URL
        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'thumbnail_url' => $thumbnailUrl,
            'category' => $request->category,
            'date' => $request->date,
            'status' => $request->status ?? true
        ]);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video updated successfully');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video deleted successfully');
    }

    private function getVideoId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
}
