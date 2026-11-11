<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'button_text' => 'nullable|string|max:255',
                'button_link' => 'nullable|string|max:255',
                'status' => 'boolean',
                'order' => 'integer'
            ]);

            $data = $request->except('image');
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('sliders', 'public');
                $data['image'] = $imagePath;
            }

            Slider::create($data);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'স্লাইড সফলভাবে যোগ করা হয়েছে।');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'স্লাইড যোগ করতে ব্যর্থ হয়েছে।');
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'button_text' => 'nullable|string|max:255',
                'button_link' => 'nullable|string|max:255',
                'status' => 'boolean',
                'order' => 'integer'
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                // Delete old image
                if ($slider->image) {
                    Storage::disk('public')->delete($slider->image);
                }
                
                $imagePath = $request->file('image')->store('sliders', 'public');
                $data['image'] = $imagePath;
            }

            $slider->update($data);

            return redirect()->route('admin.sliders.index')
                ->with('success', 'স্লাইড সফলভাবে আপডেট করা হয়েছে।');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'স্লাইড আপডেট করতে ব্যর্থ হয়েছে।');
        }
    }

    public function destroy(Slider $slider)
    {
        try {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            
            $slider->delete();

            return redirect()->route('admin.sliders.index')
                ->with('success', 'স্লাইড সফলভাবে মুছে ফেলা হয়েছে।');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'স্লাইড মুছে ফেলতে ব্যর্থ হয়েছে।');
        }
    }
}
