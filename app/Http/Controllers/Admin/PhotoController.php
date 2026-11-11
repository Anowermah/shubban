<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Photo::orderBy('date', 'desc');
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        $photos = $query->paginate(12)->withQueryString();
        
        // Get unique categories
        $categories = Photo::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->get()
            ->pluck('category')
            ->sort();
        
        return view('admin.photos.index', compact('photos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Photo::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->get()
            ->pluck('category')
            ->sort();
            
        return view('admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'date' => 'required|date'
        ]);

        $data = $request->all();
        $data['date'] = Carbon::parse($request->date);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            $data['image_url'] = $imagePath;
        }

        Photo::create($data);

        return redirect()->route('admin.photos.index')
            ->with('success', 'ছবি সফলভাবে যোগ করা হয়েছে।');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $categories = Photo::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->get()
            ->pluck('category')
            ->sort();
            
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'date' => 'required|date'
        ]);

        $data = $request->all();
        $data['date'] = Carbon::parse($request->date);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($photo->image_url) {
                Storage::disk('public')->delete($photo->image_url);
            }
            
            $imagePath = $request->file('image')->store('photos', 'public');
            $data['image_url'] = $imagePath;
        }

        $photo->update($data);

        return redirect()->route('admin.photos.index')
            ->with('success', 'ছবি সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        if ($photo->image_url) {
            Storage::disk('public')->delete($photo->image_url);
        }

        $photo->delete();

        return redirect()->route('admin.photos.index')
            ->with('success', 'ছবি সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
