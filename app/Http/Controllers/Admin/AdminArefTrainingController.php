<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;
use Illuminate\Support\Facades\Storage;
use App\Models\Training;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminArefTrainingController extends Controller
{
    public function index()
    {
        $registrations = TrainingRegistration::where('course_type', 'aref')->latest()->get();
        return view('admin.training.aref.index', compact('registrations'));
    }

    public function create()
    {
        return view('admin.training.aref.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $training = new Training();
        $training->setTranslation('title', 'bn', $request->title);
        $training->setTranslation('description', 'bn', $request->description);
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->setTranslation('location', 'bn', $request->location);
        $training->organization_name = $request->organization_name;
        $training->type = 'aref';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/trainings', $imageName);
            $training->image = 'trainings/' . $imageName;
        }

        $training->save();

        return redirect()->route('admin.training.aref.index')
            ->with('success', 'আরেফ প্রশিক্ষণ সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit($id)
    {
        $registration = TrainingRegistration::where('course_type', 'aref')->findOrFail($id);
        return view('admin.training.aref.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $registration = TrainingRegistration::where('course_type', 'aref')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_group' => 'nullable|string|max:5',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'emergency_contact' => 'required|string|max:15',
            'emergency_relation' => 'required|string|max:50',
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($registration->photo) {
                Storage::delete('public/' . $registration->photo);
            }

            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->extension();
            $photo->storeAs('public/registrations', $photoName);
            $data['photo'] = 'registrations/' . $photoName;
        }

        $registration->update($data);

        return redirect()->route('admin.training.aref.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy($id)
    {
        $training = TrainingRegistration::where('course_type', 'aref')->findOrFail($id);
        
        if ($training->photo) {
            Storage::delete('public/' . $training->photo);
        }
        
        $training->delete();

        return redirect()->route('admin.training.aref.index')
            ->with('success', 'আরেফ প্রশিক্ষণ সফলভাবে মুছে ফেলা হয়েছে।');
    }

    public function download(TrainingRegistration $registration)
    {
        $pdf = PDF::loadView('admin.training.aref.pdf', compact('registration'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'SolaimanLipi',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'isPhpEnabled' => true,
            'defaultMediaType' => 'screen',
            'defaultPaperSize' => 'a4',
            'dpi' => 96,
            'fontHeightRatio' => 1.1,
        ]);
        
        return $pdf->download('aref-registration-' . $registration->id . '.pdf');
    }

    public function downloadAll()
    {
        $registrations = TrainingRegistration::where('course_type', 'aref')->latest()->get();
        
        $pdf = PDF::loadView('admin.training.aref.list-pdf', compact('registrations'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'SolaimanLipi',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'isPhpEnabled' => true,
            'defaultMediaType' => 'screen',
            'defaultPaperSize' => 'a4',
            'dpi' => 96,
            'fontHeightRatio' => 1.1,
        ]);
        
        return $pdf->download('aref-registrations-list.pdf');
    }

    public function show($id)
    {
        $registration = TrainingRegistration::where('course_type', 'aref')
            ->findOrFail($id);
            
        return response()->json($registration);
    }

    public function updateRegistration(Request $request, $id)
    {
        $registration = TrainingRegistration::where('course_type', 'aref')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_group' => 'nullable|string|max:5',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'emergency_contact' => 'required|string|max:15',
            'emergency_relation' => 'required|string|max:50',
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($registration->photo) {
                Storage::delete('public/' . $registration->photo);
            }

            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->extension();
            $photo->storeAs('public/registrations', $photoName);
            $data['photo'] = 'registrations/' . $photoName;
        }

        $registration->update($data);

        return redirect()->route('admin.training.aref.index')
            ->with('success', 'রেজিস্ট্রেশন সফলভাবে আপডেট করা হয়েছে।');
    }
}
