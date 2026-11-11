<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingRegistration;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    public function selfDevelopment()
    {
        return view('training.self-development');
    }

    public function courses()
    {
        return view('training.courses');
    }

    public function aref()
    {
        return view('training.aref');
    }

    public function rageb()
    {
        return view('training.rageb');
    }

    public function salek()
    {
        return view('training.salek');
    }

    public function saleh()
    {
        return view('training.saleh');
    }

    public function showRegistrationForm($type)
    {
        return view('training.registration', ['courseType' => $type]);
    }

    public function storeRegistration(Request $request)
    {
        try {
            // Validate course type
            if (!in_array($request->course_type, ['aref', 'rageb', 'salek', 'saleh'])) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'অবৈধ কোর্স টাইপ।',
                        'errors' => ['course_type' => ['অবৈধ কোর্স টাইপ।']]
                    ], 422);
                }
                return back()->withErrors(['course_type' => 'অবৈধ কোর্স টাইপ।'])->withInput();
            }

            // Check if same_as_present is checked
            $permanentAddressRules = $request->has('same_as_present') ? 'nullable' : 'required';

            // Define validation rules
            $rules = [
                'course_type' => 'required|string|in:aref,rageb,salek,saleh',
                'name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before:today',
                'gender' => 'required|in:male,female',
                'mobile' => ['required', 'string', 'digits:11', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
                'email' => 'nullable|email|max:255',
                'emergency_contact' => ['required', 'string', 'digits:11', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
                'emergency_relation' => 'required|string|max:50',
                'present_village' => 'required|string|max:255',
                'present_post' => 'required|string|max:255',
                'present_thana' => 'required|string|max:255',
                'present_district' => 'required|string|max:255',
                'permanent_village' => $permanentAddressRules . '|string|max:255',
                'permanent_post' => $permanentAddressRules . '|string|max:255',
                'permanent_thana' => $permanentAddressRules . '|string|max:255',
                'permanent_district' => $permanentAddressRules . '|string|max:255',
                'last_education' => 'required|string|max:255',
                'institute' => 'required|string|max:255',
                'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'result' => 'required|string|max:50',
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'blood_group' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'nid' => ['nullable', 'string', 'regex:/^[0-9]{10}$|^[0-9]{13}$|^[0-9]{17}$/'],
                'father_occupation' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
            ];

            // Define custom messages
            $messages = [
                'required' => ':attribute দিতে হবে।',
                'required_without_all' => ':attribute দিতে হবে যদি স্থায়ী ঠিকানা একই না হয়।',
                'string' => ':attribute টেক্সট হতে হবে।',
                'max' => ':attribute সর্বোচ্চ :max অক্ষর হতে পারবে।',
                'date' => ':attribute তারিখ হতে হবে।',
                'in' => ':attribute সঠিক নয়।',
                'integer' => ':attribute সংখ্যা হতে হবে।',
                'min' => ':attribute ন্যূনতম :min হতে হবে।',
                'image' => ':attribute একটি ছবি হতে হবে।',
                'mimes' => ':attribute JPG, JPEG, বা PNG ফরম্যাটে হতে হবে।',
                'max.file' => ':attribute সর্বোচ্চ :max কিলোবাইট হতে পারবে।',
                'email' => ':attribute সঠিক ইমেইল ঠিকানা হতে হবে।',
                'digits' => ':attribute ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর হতে হবে।',
                'date_format' => ':attribute সঠিক ফরম্যাটে দিন।',
                'before' => ':attribute আজকের তারিখের আগে হতে হবে।',
                'regex' => [
                    'mobile' => 'মোবাইল নম্বর সঠিক নয়। ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর দিন।',
                    'emergency_contact' => 'জরুরী যোগাযোগের নম্বর সঠিক নয়। ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর দিন।',
                    'nid' => 'জাতীয় পরিচয়পত্র নম্বর সঠিক নয়। ১০, ১৩, বা ১৭ ডিজিটের NID নম্বর দিন।'
                ],
                'blood_group.in' => 'রক্তের গ্রুপ সঠিক নয়। সঠিক রক্তের গ্রুপ নির্বাচন করুন।',
                'mobile.digits' => 'মোবাইল নম্বর ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর হতে হবে।',
                'emergency_contact.digits' => 'জরুরী যোগাযোগের নম্বর ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর হতে হবে।'
            ];

            // Define custom attribute names
            $attributes = [
                'name' => 'নাম',
                'father_name' => 'পিতার নাম',
                'mother_name' => 'মাতার নাম',
                'date_of_birth' => 'জন্ম তারিখ',
                'gender' => 'লিঙ্গ',
                'mobile' => 'মোবাইল নম্বর',
                'email' => 'ইমেইল',
                'emergency_contact' => 'জরুরী যোগাযোগের নম্বর',
                'emergency_relation' => 'জরুরী যোগাযোগের সম্পর্ক',
                'present_village' => 'বর্তমান গ্রাম/মহল্লা',
                'present_post' => 'বর্তমান ডাকঘর',
                'present_thana' => 'বর্তমান থানা/উপজেলা',
                'present_district' => 'বর্তমান জেলা',
                'permanent_village' => 'স্থায়ী গ্রাম/মহল্লা',
                'permanent_post' => 'স্থায়ী ডাকঘর',
                'permanent_thana' => 'স্থায়ী থানা/উপজেলা',
                'permanent_district' => 'স্থায়ী জেলা',
                'last_education' => 'সর্বশেষ শিক্ষাগত যোগ্যতা',
                'institute' => 'শিক্ষা প্রতিষ্ঠান',
                'passing_year' => 'পাসের সন',
                'result' => 'ফলাফল',
                'photo' => 'ছবি',
                'blood_group' => 'রক্তের গ্রুপ',
                'nid' => 'জাতীয় পরিচয়পত্র নম্বর',
                'father_occupation' => 'পিতার পেশা',
                'designation' => 'পদবী'
            ];

            // Validate request
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->setAttributeNames($attributes);
            $validated = $validator->validate();

            // If same_as_present is checked, copy present address to permanent address
            if ($request->has('same_as_present')) {
                $validated['permanent_village'] = $validated['present_village'];
                $validated['permanent_post'] = $validated['present_post'];
                $validated['permanent_thana'] = $validated['present_thana'];
                $validated['permanent_district'] = $validated['present_district'];
            }

            // Check for duplicate registration
            $existingRegistration = TrainingRegistration::where('course_type', $request->course_type)
                ->where(function($query) use ($request) {
                    $query->where('mobile', $request->mobile)
                        ->orWhere(function($q) use ($request) {
                            $q->where('name', $request->name)
                                ->where('father_name', $request->father_name)
                                ->where('mother_name', $request->mother_name);
                        });
                })->first();

            if ($existingRegistration) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'আপনি ইতিমধ্যে রেজিস্ট্রেশন করেছেন।',
                        'errors' => ['duplicate' => ['আপনি ইতিমধ্যে রেজিস্ট্রেশন করেছেন।']]
                    ], 422);
                }
                return back()->withErrors(['duplicate' => 'আপনি ইতিমধ্যে রেজিস্ট্রেশন করেছেন।'])->withInput();
            }

            // Handle file upload
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/photos'), $filename);
                $validated['photo'] = $filename;
            }

            // Create registration
            $registration = TrainingRegistration::create($validated);

            // Generate PDF
            $pdf = Pdf::loadView('training.pdf', [
                'registration' => $registration
            ]);
            $pdf->setPaper('A4');
            $pdf->setOption([
                'isHtml5ParserEnabled' => true, 
                'isRemoteEnabled' => true,
                'defaultFont' => 'nikosh'
            ]);

            // Save PDF
            $pdfPath = 'registration_' . $registration->id . '.pdf';
            Storage::disk('public')->put('uploads/pdfs/' . $pdfPath, $pdf->output());

            // Update registration with PDF path
            $registration->pdf_path = $pdfPath;
            $registration->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'রেজিস্ট্রেশন সফল হয়েছে।',
                    'registration_id' => $registration->id,
                    'pdf_url' => asset('storage/uploads/pdfs/' . $pdfPath)
                ]);
            }

            return redirect()->back()->with('success', 'রেজিস্ট্রেশন সফল হয়েছে।');

        } catch (ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'ভুল তথ্য দেওয়া হয়েছে।',
                    'errors' => $e->errors()
                ], 422);
            }

            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'দুঃখিত, একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'দুঃখিত, একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।'])->withInput();
        }
    }

    public function downloadPdf($id)
    {
        try {
            $registration = TrainingRegistration::findOrFail($id);
            
            $pdf = Pdf::loadView('training.pdf', ['registration' => $registration]);
            $pdf->setPaper('A4');
            $pdf->setOption([
                'isHtml5ParserEnabled' => true, 
                'isRemoteEnabled' => true,
                'defaultFont' => 'nikosh'
            ]);
            
            return $pdf->download('registration_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('PDF Download Error: ' . $e->getMessage());
            return back()->with('error', 'PDF ডাউনলোড করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }

    public function printPdf($id)
    {
        try {
            $registration = TrainingRegistration::findOrFail($id);
            
            $pdf = Pdf::loadView('training.pdf', ['registration' => $registration]);
            $pdf->setPaper('A4');
            $pdf->setOption([
                'isHtml5ParserEnabled' => true, 
                'isRemoteEnabled' => true,
                'defaultFont' => 'nikosh'
            ]);
            
            return $pdf->stream('registration_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('PDF Print Error: ' . $e->getMessage());
            return back()->with('error', 'PDF প্রিন্ট করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
        }
    }
}
