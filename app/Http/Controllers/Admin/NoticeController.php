<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->paginate(10);
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|in:academic,admission,exam,general',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $validatedData['file'] = $request->file('file')->store('notices/files', 'public');
        }

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('notices/images', 'public');
        }

        Notice::create($validatedData);

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $validatedData = $request->validate([
            'title' => 'required|array',
            'title.en' => 'required|string',
            'title.bn' => 'required|string',
            'description' => 'required|array',
            'description.en' => 'required|string',
            'description.bn' => 'required|string',
            'category' => 'required|string',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($notice->file) {
                Storage::disk('public')->delete($notice->file);
            }
            $validatedData['file'] = $request->file('file')->store('notices/files', 'public');
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($notice->image) {
                Storage::disk('public')->delete($notice->image);
            }
            $validatedData['image'] = $request->file('image')->store('notices/images', 'public');
        }

        $notice->update($validatedData);

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Notice $notice)
    {
        // Delete files
        if ($notice->file) {
            Storage::disk('public')->delete($notice->file);
        }
        if ($notice->image) {
            Storage::disk('public')->delete($notice->image);
        }

        $notice->delete();

        return redirect()->route('admin.notices.index')
            ->with('success', 'নোটিশ সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
