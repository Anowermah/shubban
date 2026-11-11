<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TrainingRegistration;
use App\Models\Donation;
use App\Models\Iyanat;
use App\Models\ProgramReport;
use App\Models\TierPromotion;
use App\Models\UserSyllabusProgress;
use App\Services\TierSyllabusService;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the member / user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Ensure user has a default worker tier if null
        if (!$user->worker_tier) {
            $user->worker_tier = 'rageb';
            $user->save();
        }

        // Training registrations by user's email
        $registrations = TrainingRegistration::where('email', $user->email)
            ->latest()
            ->take(10)
            ->get();

        // Donations by user's email
        $donations = Donation::where('email', $user->email)
            ->latest()
            ->take(10)
            ->get();

        // Iyanats (মাসিক এয়ানত)
        $iyanats = $user->iyanats()->take(12)->get();
        $totalIyanatAmount = $user->iyanats()->where('status', 'approved')->sum('amount');

        // Program Reports (কর্মসূচি প্রতিবেদন)
        $programReports = $user->programReports()->take(10)->get();

        // Tier Promotions (মানোন্নয়ন আবেদনসমূহ)
        $tierPromotions = $user->tierPromotions()->get();
        $hasPendingPromotion = $user->tierPromotions()->where('status', 'pending')->exists();

        // Current Syllabus for User's Worker Tier (রাগেব/আরেফ/সালেক/সালেহ)
        $currentTierKey = $user->worker_tier ?? 'rageb';
        $syllabusData = TierSyllabusService::getSyllabusForTier($currentTierKey);

        // Completed checklist keys
        $completedItemKeys = UserSyllabusProgress::where('user_id', $user->id)
            ->where('tier', $currentTierKey)
            ->where('is_completed', true)
            ->pluck('item_key')
            ->toArray();

        // Calculate progress percentage
        $totalItems = count($syllabusData['items']);
        $completedCount = count($completedItemKeys);
        $progressPercent = $totalItems > 0 ? round(($completedCount / $totalItems) * 100) : 0;

        return view('user.dashboard', compact(
            'user',
            'registrations',
            'donations',
            'iyanats',
            'totalIyanatAmount',
            'programReports',
            'tierPromotions',
            'hasPendingPromotion',
            'syllabusData',
            'completedItemKeys',
            'progressPercent'
        ));
    }

    /**
     * Submit Monthly Iyanat Payment Record.
     */
    public function storeIyanat(Request $request)
    {
        $request->validate([
            'month' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:10'],
            'payment_method' => ['required', 'string', 'in:bkash,nagad,rocket,bank,cash'],
            'transaction_id' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'note' => ['nullable', 'string', 'max:255'],
        ], [
            'month.required' => 'মাসের নাম প্রদান করুন।',
            'amount.required' => 'এয়ানতের পরিমাণ লিখুন।',
            'amount.min' => 'পরিমাণ ন্যূনতম ১০ টাকা হতে হবে।',
        ]);

        $receiptNo = 'IYN-' . date('Ym') . '-' . strtoupper(Str::random(4)) . rand(10, 99);

        Iyanat::create([
            'user_id' => Auth::id(),
            'receipt_no' => $receiptNo,
            'month' => $request->month,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'phone' => $request->phone,
            'status' => 'pending',
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', "আপনার {$request->month} মাসের এয়ানত (৳ {$request->amount}) সফলভাবে জমা হয়েছে। রসিদ নং: {$receiptNo}");
    }

    /**
     * Submit Activity / Program Report.
     */
    public function storeProgramReport(Request $request)
    {
        $request->validate([
            'program_type' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['nullable', 'string', 'max:255'],
            'worker_attendance' => ['required', 'integer', 'min:0'],
            'guest_attendance' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ], [
            'program_type.required' => 'প্রোগ্রামের ধরন নির্বাচন করুন।',
            'title.required' => 'কর্মসূচির শিরোনাম লিখুন।',
            'date.required' => 'কর্মসূচির তারিখ দিন।',
            'description.required' => 'কর্মসূচির বিস্তারিত বিবরণ ও সিদ্ধান্তসমূহ লিখুন।',
        ]);

        $user = Auth::user();
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('program_reports', 'public');
        }

        ProgramReport::create([
            'user_id' => $user->id,
            'org_tier' => $user->org_tier ?? 'branch',
            'branch_name' => $user->branch_name ?? 'শাখা ইউনিট',
            'program_type' => $request->program_type,
            'title' => $request->title,
            'date' => $request->date,
            'venue' => $request->venue,
            'worker_attendance' => $request->worker_attendance,
            'guest_attendance' => $request->guest_attendance,
            'description' => $request->description,
            'attachment' => $attachmentPath,
            'status' => 'submitted',
        ]);

        return redirect()->back()->with('success', 'কর্মসূচি প্রতিবেদন সফলভাবে কেন্দ্রীয় দফতরে জমা হয়েছে। পর্যালোচনার পর অনুমোদন দেওয়া হবে।');
    }

    /**
     * Submit Tier Promotion Application.
     */
    public function applyTierPromotion(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'target_tier' => ['required', 'string'],
            'syllabus_completed' => ['accepted'],
            'books_read' => ['required', 'string'],
            'applicant_notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'syllabus_completed.accepted' => 'সিলেবাস ও পাঠ্য কিতাব সমাপ্তির নিশ্চিতকরণ টিক দিন।',
            'books_read.required' => 'আপনার পঠিত কিতাব ও অধ্যয়নকৃত বিষয়সমূহ উল্লেখ করুন।',
        ]);

        if ($user->tierPromotions()->where('status', 'pending')->exists()) {
            return redirect()->back()->withErrors(['promotion' => 'আপনার একটি মানোন্নয়ন আবেদন ইতিমধ্যে প্রক্রিয়াধীন রয়েছে।']);
        }

        TierPromotion::create([
            'user_id' => $user->id,
            'current_tier' => $user->worker_tier ?? 'general',
            'target_tier' => $request->target_tier,
            'syllabus_completed' => true,
            'books_read' => $request->books_read,
            'applicant_notes' => $request->applicant_notes,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'মানোন্নয়ন আবেদন সফলভাবে দাখিল হয়েছে। কেন্দ্রীয় প্রশিক্ষণ বোর্ড এটি মূল্যায়ন করে আপনার মান উন্নীত করবে ইনশাআল্লাহ।');
    }

    /**
     * Toggle Checklist Item for Syllabus Reading.
     */
    public function toggleSyllabusItem(Request $request)
    {
        $request->validate([
            'item_key' => ['required', 'string'],
            'tier' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $record = UserSyllabusProgress::firstOrNew([
            'user_id' => $user->id,
            'tier' => $request->tier,
            'item_key' => $request->item_key,
        ]);

        $record->is_completed = !$record->is_completed;
        $record->completed_at = $record->is_completed ? now() : null;
        $record->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_completed' => $record->is_completed,
            ]);
        }

        return redirect()->back()->with('success', 'পাঠ অগ্রগতি হালনাগাদ করা হয়েছে।');
    }

    /**
     * Print Digital Iyanat Receipt.
     */
    public function printIyanatReceipt(Iyanat $iyanat)
    {
        if ($iyanat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized receipt access.');
        }

        return view('user.receipt', compact('iyanat'));
    }

    /**
     * Update Profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'profession' => ['nullable', 'string', 'max:100'],
            'branch_name' => ['nullable', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:500'],
        ], [
            'name.required' => 'আপনার নাম প্রদান করুন।',
            'email.required' => 'ইমেইল ঠিকানা প্রদান করুন।',
            'email.unique' => 'এই ইমেইলটি অন্য একাউন্টে ব্যবহৃত হচ্ছে।',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->blood_group = $request->blood_group;
        $user->profession = $request->profession;
        $user->branch_name = $request->branch_name;
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'আপনার কর্মী প্রোফাইল তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'বর্তমান পাসওয়ার্ড দিন।',
            'password.required' => 'নতুন পাসওয়ার্ড দিন।',
            'password.min' => 'নতুন পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।',
            'password.confirmed' => 'পাসওয়ার্ড নিশ্চিতকরণ মিলছে না।',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়।']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }
}
