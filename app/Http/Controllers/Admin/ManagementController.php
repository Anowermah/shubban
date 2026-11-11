<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ManagementController extends Controller
{
    public function central()
    {
        $managers = Management::central()->orderBy('order')->get();
        return view('admin.management.index', [
            'title' => 'কেন্দ্রীয় দায়িত্বশীল',
            'managers' => $managers,
            'level' => Management::LEVEL_CENTRAL
        ]);
    }

    public function district()
    {
        $managers = Management::district()->orderBy('order')->get();
        return view('admin.management.index', [
            'title' => 'জেলা দায়িত্বশীল',
            'managers' => $managers,
            'level' => Management::LEVEL_DISTRICT
        ]);
    }

    public function upazila()
    {
        $managers = Management::upazila()->orderBy('order')->get();
        return view('admin.management.index', [
            'title' => 'উপজেলা দায়িত্বশীল',
            'managers' => $managers,
            'level' => Management::LEVEL_UPAZILA
        ]);
    }

    public function thana()
    {
        $managers = Management::thana()->orderBy('order')->get();
        return view('admin.management.index', [
            'title' => 'থানা দায়িত্বশীল',
            'managers' => $managers,
            'level' => Management::LEVEL_THANA
        ]);
    }

    public function branch()
    {
        $managers = Management::branch()->orderBy('order')->get();
        return view('admin.management.index', [
            'title' => 'শাখা দায়িত্বশীল',
            'managers' => $managers,
            'level' => Management::LEVEL_BRANCH
        ]);
    }

    public function create()
    {
        return view('admin.management.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'level' => 'required|string|in:central,district,upazila,thana,branch',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'order' => 'nullable|integer|min:0'
        ]);

        if (empty($validated['order'])) {
            $validated['order'] = (Management::where('level', $validated['level'])->max('order') ?? 0) + 1;
        }
        $validated['status'] = $request->boolean('status', true);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize and save image
            $img = Image::make($image->getRealPath());
            $img->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            // Save to storage
            Storage::disk('public')->put('management/' . $filename, $img->stream());
            $validated['image'] = 'management/' . $filename;
        }

        Management::create($validated);

        return redirect()->route('admin.management.' . $validated['level'])
            ->with('success', 'দায়িত্বশীল সফলভাবে যুক্ত করা হয়েছে।');
    }

    public function edit(Management $management)
    {
        return view('admin.management.edit', compact('management'));
    }

    public function update(Request $request, Management $management)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'level' => 'required|string|in:central,district,upazila,thana,branch',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'order' => 'nullable|integer|min:0'
        ]);

        if (empty($validated['order'])) {
            $validated['order'] = $management->order ?: 1;
        }
        if ($request->has('status')) {
            $validated['status'] = $request->boolean('status');
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($management->image) {
                Storage::disk('public')->delete($management->image);
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize and save image
            $img = Image::make($image->getRealPath());
            $img->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            // Save to storage
            Storage::disk('public')->put('management/' . $filename, $img->stream());
            $validated['image'] = 'management/' . $filename;
        }

        $management->update($validated);

        return redirect()->route('admin.management.' . $validated['level'])
            ->with('success', 'দায়িত্বশীল সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Management $management)
    {
        $level = $management->level;

        if ($management->image) {
            Storage::disk('public')->delete($management->image);
        }

        $management->delete();

        return redirect()->route('admin.management.' . $level)
            ->with('success', 'দায়িত্বশীল সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
