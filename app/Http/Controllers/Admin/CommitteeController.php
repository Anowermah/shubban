<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommitteeController extends Controller
{
    public function index()
    {
        $members = Committee::orderBy('order', 'asc')->paginate(10);
        return view('admin.committee.index', compact('members'));
    }

    public function create()
    {
        return view('admin.committee.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'নাম দেওয়া আবশ্যক',
            'designation.required' => 'পদবী দেওয়া আবশ্যক',
            'image.required' => 'ছবি দেওয়া আবশ্যক',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে',
            'image.mimes' => 'ছবির ফরম্যাট jpeg, png, jpg, অথবা gif হতে হবে',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ 2MB হতে পারবে',
            'order.required' => 'ক্রম দেওয়া আবশ্যক',
            'order.integer' => 'ক্রম একটি পূর্ণসংখ্যা হতে হবে',
            'order.min' => 'ক্রম ০ বা তার বেশি হতে হবে',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ], $messages);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('committee', $imageName, 'public');
            }

            Committee::create([
                'name' => $validated['name'],
                'designation' => $validated['designation'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'image' => $path ?? null,
                'order' => $validated['order'],
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.committee.index')
                ->with('success', 'কমিটি সদস্য সফলভাবে যোগ করা হয়েছে।');
        } catch (\Exception $e) {
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।')->withInput();
        }
    }

    public function edit(Committee $committee)
    {
        $member = $committee;
        return view('admin.committee.edit', compact('member'));
    }

    public function update(Request $request, Committee $committee)
    {
        $messages = [
            'name.required' => 'নাম দেওয়া আবশ্যক',
            'designation.required' => 'পদবী দেওয়া আবশ্যক',
            'image.image' => 'ফাইলটি একটি ছবি হতে হবে',
            'image.mimes' => 'ছবির ফরম্যাট jpeg, png, jpg, অথবা gif হতে হবে',
            'image.max' => 'ছবির সাইজ সর্বোচ্চ 2MB হতে পারবে',
            'order.required' => 'ক্রম দেওয়া আবশ্যক',
            'order.integer' => 'ক্রম একটি পূর্ণসংখ্যা হতে হবে',
            'order.min' => 'ক্রম ০ বা তার বেশি হতে হবে',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ], $messages);

        try {
            if ($request->hasFile('image')) {
                // Delete old image
                if ($committee->image) {
                    Storage::disk('public')->delete($committee->image);
                }
                
                // Store new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('committee', $imageName, 'public');
                $committee->image = $path;
            }

            $committee->name = $validated['name'];
            $committee->designation = $validated['designation'];
            $committee->phone = $validated['phone'];
            $committee->email = $validated['email'];
            $committee->address = $validated['address'];
            $committee->order = $validated['order'];
            $committee->is_active = $request->boolean('is_active', true);
            $committee->save();

            return redirect()->route('admin.committee.index')
                ->with('success', 'কমিটি সদস্য সফলভাবে আপডেট করা হয়েছে।');
        } catch (\Exception $e) {
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।')->withInput();
        }
    }

    public function destroy(Committee $committee)
    {
        try {
            if ($committee->image) {
                Storage::disk('public')->delete($committee->image);
            }
            $committee->delete();
            return redirect()->route('admin.committee.index')
                ->with('success', 'কমিটি সদস্য সফলভাবে মুছে ফেলা হয়েছে।');
        } catch (\Exception $e) {
            return back()->with('error', 'কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }
}
