<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
        ], [
            'name.required' => 'নাম দেওয়া আবশ্যক',
            'phone.required' => 'মোবাইল নাম্বার দেওয়া আবশ্যক',
            'phone.regex' => 'অনুগ্রহ করে সঠিক মোবাইল নাম্বার দিন',
            'phone.min' => 'মোবাইল নাম্বার কমপক্ষে ১১ ডিজিট হতে হবে',
            'email.email' => 'অনুগ্রহ করে সঠিক ইমেইল ঠিকানা দিন',
            'subject.required' => 'বিষয় দেওয়া আবশ্যক',
            'message.required' => 'বার্তা দেওয়া আবশ্যক',
        ]);

        // Store in database
        Contact::create($validated);

        // Send email notification
        // Mail::to('info@shubbanbd.org')->send(new ContactFormSubmission($validated));

        return redirect()->back()->with('success', 'আপনার বার্তা সফলভাবে পাঠানো হয়েছে। আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।');
    }
}
