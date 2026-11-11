<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;
use App\Enums\CourseType;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminSalehTrainingController extends Controller
{
    public function index()
    {
        $registrations = TrainingRegistration::where('course_type', CourseType::SALEH)->get();
        return view('admin.training.saleh.index', compact('registrations'));
    }

    public function create()
    {
        return view('admin.training.saleh.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'nid' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'photo' => 'required|image|max:2048',
            'present_village' => 'required|string|max:255',
            'present_post' => 'required|string|max:255',
            'present_thana' => 'required|string|max:255',
            'present_district' => 'required|string|max:255',
            'permanent_village' => 'required|string|max:255',
            'permanent_post' => 'required|string|max:255',
            'permanent_thana' => 'required|string|max:255',
            'permanent_district' => 'required|string|max:255',
            'last_education' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'result' => 'required|string|max:50'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('training/saleh/photos', 'public');
        }

        $data['course_type'] = CourseType::SALEH;

        TrainingRegistration::create($data);

        return redirect()->route('admin.training.saleh.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে সম্পন্ন হয়েছে।');
    }

    public function show($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::SALEH)
            ->findOrFail($id);
            
        return response()->json($registration);
    }

    public function edit($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::SALEH)
            ->findOrFail($id);
            
        return view('admin.training.saleh.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::SALEH)
            ->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'nid' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|max:2048',
            'present_village' => 'required|string|max:255',
            'present_post' => 'required|string|max:255',
            'present_thana' => 'required|string|max:255',
            'present_district' => 'required|string|max:255',
            'permanent_village' => 'required|string|max:255',
            'permanent_post' => 'required|string|max:255',
            'permanent_thana' => 'required|string|max:255',
            'permanent_district' => 'required|string|max:255',
            'last_education' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'result' => 'required|string|max:50'
        ]);

        if ($request->hasFile('photo')) {
            if ($registration->photo) {
                Storage::disk('public')->delete($registration->photo);
            }
            $data['photo'] = $request->file('photo')->store('training/saleh/photos', 'public');
        }

        $registration->update($data);

        return redirect()->route('admin.training.saleh.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে আপডেট হয়েছে।');
    }

    public function destroy($id)
    {
        $registration = TrainingRegistration::where('course_type', CourseType::SALEH)
            ->findOrFail($id);

        if ($registration->photo) {
            Storage::disk('public')->delete($registration->photo);
        }

        $registration->delete();

        return redirect()->route('admin.training.saleh.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে মুছে ফেলা হয়েছে।');
    }

    public function download(TrainingRegistration $registration)
    {
        if ($registration->course_type !== CourseType::SALEH) {
            abort(404);
        }

        $pdf = PDF::loadView('admin.training.saleh.pdf', compact('registration'));
        return $pdf->download($registration->name . '_registration.pdf');
    }

    public function downloadAll()
    {
        $registrations = TrainingRegistration::where('course_type', CourseType::SALEH)->get();
        $pdf = PDF::loadView('admin.training.saleh.list-pdf', compact('registrations'));
        return $pdf->download('saleh-registrations-list.pdf');
    }
}
