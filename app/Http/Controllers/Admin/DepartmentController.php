<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('order')->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'head' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|array',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'staff_count' => 'required|integer|min:0',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Department::create($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'বিভাগ সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'head' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|array',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'staff_count' => 'required|integer|min:0',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $department->update($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'বিভাগ সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('success', 'বিভাগ সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
