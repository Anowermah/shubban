<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives = Archive::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.gallery-archive.index', compact('archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery-archive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('archives', 'public');
        }

        Archive::create($data);

        return redirect()->route('admin.gallery-archives.index')
            ->with('success', 'Archive created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $galleryArchive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $galleryArchive)
    {
        return view('admin.gallery-archive.edit', ['archive' => $galleryArchive]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $galleryArchive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $galleryArchive)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($galleryArchive->cover_image) {
                Storage::disk('public')->delete($galleryArchive->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('archives', 'public');
        }

        $galleryArchive->update($data);

        return redirect()->route('admin.gallery-archives.index')
            ->with('success', 'Archive updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $galleryArchive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $galleryArchive)
    {
        if ($galleryArchive->cover_image) {
            Storage::disk('public')->delete($galleryArchive->cover_image);
        }

        $galleryArchive->delete();

        return redirect()->route('admin.gallery-archives.index')
            ->with('success', 'Archive deleted successfully.');
    }
}
