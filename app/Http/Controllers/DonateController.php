<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationCause;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonateController extends Controller
{
    /**
     * Show the public donation portal with causes, payment info, and transparency statistics.
     */
    public function index()
    {
        $causes = DonationCause::active()->get();
        $setting = Setting::first();

        // Payment accounts and numbers from database with fallback defaults
        $paymentInfo = [
            'bkash_number' => $setting->bkash_number ?? '01765812261',
            'bkash_type' => $setting->bkash_type ?? 'মার্চেন্ট',
            'nagad_number' => $setting->nagad_number ?? '01765812261',
            'nagad_type' => $setting->nagad_type ?? 'পার্সোনাল',
            'rocket_number' => $setting->rocket_number ?? '017658122617',
            'bank_name' => $setting->bank_name ?? 'ইসলামী ব্যাংক বাংলাদেশ লিমিটেড',
            'bank_branch' => $setting->bank_branch ?? 'যাত্রাবাড়ী শাখা, ঢাকা',
            'bank_account_name' => $setting->bank_account_name ?? 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ',
            'bank_account_number' => $setting->bank_account_number ?? '20501234567',
            'bank_routing' => $setting->bank_routing ?? '125273456',
        ];

        // Recent public donations (respects anonymous donors)
        $recentDonations = Donation::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        // Summary stats
        $totalApprovedDonations = Donation::where('status', 'approved')->sum('amount');
        $totalDonorsCount = Donation::where('status', 'approved')->count();

        return view('donate.index', compact('causes', 'paymentInfo', 'recentDonations', 'totalApprovedDonations', 'totalDonorsCount'));
    }

    /**
     * Process public donation submission with receipt generation and optional slip upload.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10',
            'cause_id' => 'required|exists:donation_causes,id',
            'payment_method' => 'required|string|in:bkash,nagad,rocket,bank,cash',
            'phone' => 'required|string|max:20',
            'name' => 'nullable|string|max:255',
            'is_anonymous' => 'nullable|boolean',
            'sender_number' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'transaction_id' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:1000',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'amount.required' => 'দানের টাকার পরিমাণ লিখুন।',
            'amount.min' => 'সর্বনিম্ন দানের পরিমাণ ১০ টাকা।',
            'cause_id.required' => 'অনুগ্রহ করে দানের খাত নির্বাচন করুন।',
            'cause_id.exists' => 'নির্বাচিত খাতটি সঠিক নয়।',
            'phone.required' => 'অনুগ্রহ করে মোবাইল নম্বর প্রদান করুন।',
            'payment_method.required' => 'পেমেন্ট মাধ্যম নির্বাচন করুন।',
            'receipt_image.max' => 'রশিদ বা স্লিপের ছবির সর্বোচ্চ সাইজ ৫ মেগাবাইট হতে পারে।',
        ]);

        $isAnonymous = $request->boolean('is_anonymous');
        $donorName = $isAnonymous ? 'এক দ্বীনি ভাই/বোন' : ($validated['name'] ?? 'নামবিহীন শুভাকাঙ্ক্ষী');

        // Handle payment slip upload if provided
        $slipPath = null;
        if ($request->hasFile('receipt_image')) {
            $file = $request->file('receipt_image');
            $filename = 'slip_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $slipPath = $file->storeAs('donations/slips', $filename, 'public');
        }

        // Generate unique branded donation receipt number: SHB-DON-YYYYMMDD-XXXX
        $receiptNo = 'SHB-DON-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $cause = DonationCause::find($validated['cause_id']);

        $donation = Donation::create([
            'receipt_no' => $receiptNo,
            'name' => $donorName,
            'is_anonymous' => $isAnonymous,
            'phone' => $validated['phone'],
            'sender_number' => $validated['sender_number'] ?? $validated['phone'],
            'email' => $validated['email'] ?? null,
            'amount' => $validated['amount'],
            'cause_id' => $cause->id,
            'category' => $cause->slug,
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'] ?? null,
            'receipt_image' => $slipPath,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('donate.receipt', $donation->receipt_no)
            ->with('success', 'জাযাকাল্লাহু খাইরান! আপনার দান সফলভাবে গৃহীত হয়েছে। ভেরিফিকেশনের পর এটি স্থায়ীভাবে অনুমোদিত হবে।');
    }

    /**
     * Show printable/shareable branded digital donation receipt.
     */
    public function receipt($receipt_no)
    {
        $donation = Donation::with('cause')
            ->where('receipt_no', $receipt_no)
            ->firstOrFail();

        $setting = Setting::first();

        return view('donate.receipt', compact('donation', 'setting'));
    }

    public function success()
    {
        return view('donate.success');
    }

    public function failed()
    {
        return view('donate.failed');
    }
}
