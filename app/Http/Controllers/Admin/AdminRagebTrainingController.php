<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingRegistration;
use App\Enums\CourseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRagebTrainingController extends Controller
{
    public function index()
    {
        $registrations = TrainingRegistration::where('course_type', CourseType::RAGEB)->get();
        return view('admin.training.rageb.index', compact('registrations'));
    }

    public function create()
    {
        return view('admin.training.rageb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_group' => 'nullable|string|max:10',
            'gender' => 'required|string|in:male,female',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'present_village' => 'required|string|max:255',
            'present_post' => 'required|string|max:255',
            'present_thana' => 'required|string|max:255',
            'present_district' => 'required|string|max:255',
            'permanent_village' => 'required|string|max:255',
            'permanent_post' => 'required|string|max:255',
            'permanent_thana' => 'required|string|max:255',
            'permanent_district' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'organization_address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');
        $data['course_type'] = CourseType::RAGEB;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('training/photos', 'public');
            $data['photo'] = $photoPath;
        }

        TrainingRegistration::create($data);

        return redirect()->route('admin.training.rageb.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে সম্পন্ন হয়েছে।');
    }

    public function show($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::RAGEB)
            ->findOrFail($id);
        return response()->json($registration);
    }

    public function edit($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::RAGEB)
            ->findOrFail($id);
        return view('admin.training.rageb.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_group' => 'nullable|string|max:10',
            'gender' => 'required|string|in:male,female',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'present_village' => 'required|string|max:255',
            'present_post' => 'required|string|max:255',
            'present_thana' => 'required|string|max:255',
            'present_district' => 'required|string|max:255',
            'permanent_village' => 'required|string|max:255',
            'permanent_post' => 'required|string|max:255',
            'permanent_thana' => 'required|string|max:255',
            'permanent_district' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'organization_address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $registration = TrainingRegistration::where('course_type', CourseType::RAGEB)
            ->findOrFail($id);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($registration->photo) {
                Storage::disk('public')->delete($registration->photo);
            }
            $photo = $request->file('photo');
            $photoPath = $photo->store('training/photos', 'public');
            $data['photo'] = $photoPath;
        }

        $registration->update($data);

        return redirect()->route('admin.training.rageb.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::RAGEB)
            ->findOrFail($id);

        if ($registration->photo) {
            Storage::disk('public')->delete($registration->photo);
        }

        $registration->delete();

        return redirect()->route('admin.training.rageb.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে মুছে ফেলা হয়েছে।');
    }

    public function download($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::RAGEB)
            ->findOrFail($id);

        $pdf = PDF::loadView('admin.training.rageb.pdf', compact('registration'));

        return $pdf->download('rageb-registration-' . $registration->id . '.pdf');
    }

    public function downloadAll()
    {
        $registrations = TrainingRegistration::where('course_type', CourseType::RAGEB)->get();

        $pdf = PDF::loadView('admin.training.rageb.pdf-all', compact('registrations'));

        return $pdf->download('rageb-registrations.pdf');
    }
}
