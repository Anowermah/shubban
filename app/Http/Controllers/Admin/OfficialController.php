<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::orderBy('order')->get();
        return view('admin.officials.index', compact('officials'));
    }

    public function create()
    {
        return view('admin.officials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('officials', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        Official::create($validated);

        return redirect()->route('admin.officials.index')
            ->with('success', 'কর্মকর্তা সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Official $official)
    {
        return view('admin.officials.edit', compact('official'));
    }

    public function update(Request $request, Official $official)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($official->image) {
                Storage::disk('public')->delete($official->image);
            }
            
            $path = $request->file('image')->store('officials', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $official->update($validated);

        return redirect()->route('admin.officials.index')
            ->with('success', 'কর্মকর্তা সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Official $official)
    {
        if ($official->image) {
            Storage::disk('public')->delete($official->image);
        }

        $official->delete();

        return redirect()->route('admin.officials.index')
            ->with('success', 'কর্মকর্তা সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
