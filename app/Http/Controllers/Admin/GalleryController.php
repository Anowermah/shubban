<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'path' => $path,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'ছবি সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', ['image' => $gallery]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($gallery->path);
            // Store new image
            $path = $request->file('image')->store('gallery', 'public');
            $gallery->path = $path;
        }

        $gallery->title = $validated['title'];
        $gallery->description = $validated['description'];
        $gallery->is_featured = $request->boolean('is_featured');
        $gallery->save();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'ছবি সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete the image file
        Storage::disk('public')->delete($gallery->path);
        // Delete the record
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'ছবি সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
