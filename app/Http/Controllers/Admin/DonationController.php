<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCause;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Display a listing of donations with search, filters, and statistics.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $paymentMethod = $request->query('payment_method');
        $causeId = $request->query('cause_id');
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');

        $query = Donation::with('cause')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('sender_number', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%")
                  ->orWhere('receipt_no', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($paymentMethod && $paymentMethod !== 'all') {
            $query->where('payment_method', $paymentMethod);
        }

        if ($causeId) {
            $query->where('cause_id', $causeId);
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $donations = $query->paginate(15)->withQueryString();

        // Financial & Verification Statistics
        $stats = [
            'total_approved_amount' => Donation::where('status', 'approved')->sum('amount'),
            'total_approved_count' => Donation::where('status', 'approved')->count(),
            'pending_amount' => Donation::where('status', 'pending')->sum('amount'),
            'pending_count' => Donation::where('status', 'pending')->count(),
            'rejected_count' => Donation::where('status', 'rejected')->count(),
            'this_month_amount' => Donation::where('status', 'approved')
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->sum('amount'),
            'total_count' => Donation::count(),
        ];

        $causes = DonationCause::orderBy('sort_order', 'asc')->get();

        return view('admin.donations.index', compact('donations', 'stats', 'causes'));
    }

    /**
     * Show the form for creating a new manual donation (e.g. office cash deposit).
     */
    public function create()
    {
        $causes = DonationCause::active()->get();
        return view('admin.donations.create', compact('causes'));
    }

    /**
     * Store a manually created donation from admin panel.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'amount' => 'required|numeric|min:1',
            'cause_id' => 'required|exists:donation_causes,id',
            'payment_method' => 'required|string|in:cash,bank,bkash,nagad,rocket,other',
            'transaction_id' => 'nullable|string|max:100',
            'status' => 'required|in:pending,approved,rejected',
            'is_anonymous' => 'nullable|boolean',
            'message' => 'nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $cause = DonationCause::findOrFail($validated['cause_id']);
        $receiptNo = 'SHB-DON-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $slipPath = null;
        if ($request->hasFile('receipt_image')) {
            $slipPath = $request->file('receipt_image')->store('donations/slips', 'public');
        }

        $adminName = auth('admin')->user()->name ?? 'Admin';

        $donation = Donation::create([
            'receipt_no' => $receiptNo,
            'name' => $validated['name'],
            'is_anonymous' => $request->boolean('is_anonymous'),
            'phone' => $validated['phone'],
            'sender_number' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'amount' => $validated['amount'],
            'cause_id' => $cause->id,
            'category' => $cause->slug,
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'] ?? null,
            'receipt_image' => $slipPath,
            'status' => $validated['status'],
            'message' => $validated['message'] ?? null,
            'admin_notes' => $validated['admin_notes'] ?? null,
            'verified_at' => $validated['status'] === 'approved' ? now() : null,
            'verified_by' => $validated['status'] === 'approved' ? $adminName : null,
        ]);

        if ($validated['status'] === 'approved') {
            $cause->increment('raised_amount', $validated['amount']);
        }

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'নতুন দানের রেকর্ড সফলভাবে সংরক্ষণ করা হয়েছে। রসিদ নং: ' . $receiptNo);
    }

    /**
     * Display donation details with receipt preview and slip modal.
     */
    public function show(Donation $donation)
    {
        $donation->load('cause');
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Donation $donation)
    {
        $causes = DonationCause::orderBy('sort_order', 'asc')->get();
        return view('admin.donations.edit', compact('donation', 'causes'));
    }

    /**
     * Update the specified donation in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'sender_number' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'amount' => 'required|numeric|min:1',
            'cause_id' => 'required|exists:donation_causes,id',
            'payment_method' => 'required|string|in:cash,bank,bkash,nagad,rocket,other',
            'transaction_id' => 'nullable|string|max:100',
            'status' => 'required|in:pending,approved,rejected',
            'is_anonymous' => 'nullable|boolean',
            'message' => 'nullable|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $oldStatus = $donation->status;
        $oldAmount = $donation->amount;
        $oldCauseId = $donation->cause_id;

        $newCause = DonationCause::findOrFail($validated['cause_id']);

        if ($request->hasFile('receipt_image')) {
            if ($donation->receipt_image && Storage::disk('public')->exists($donation->receipt_image)) {
                Storage::disk('public')->delete($donation->receipt_image);
            }
            $validated['receipt_image'] = $request->file('receipt_image')->store('donations/slips', 'public');
        }

        $validated['is_anonymous'] = $request->boolean('is_anonymous');
        $validated['category'] = $newCause->slug;

        $adminName = auth('admin')->user()->name ?? 'Admin';
        if ($validated['status'] === 'approved' && $oldStatus !== 'approved') {
            $validated['verified_at'] = now();
            $validated['verified_by'] = $adminName;
        }

        $donation->update($validated);

        // Adjust raised amount on causes if status or amount changed
        if ($oldStatus === 'approved') {
            $oldCause = DonationCause::find($oldCauseId);
            if ($oldCause) {
                $oldCause->decrement('raised_amount', $oldAmount);
            }
        }
        if ($validated['status'] === 'approved') {
            $newCause->increment('raised_amount', $validated['amount']);
        }

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'দানের তথ্য ও খতিয়ান সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Quick status update action with admin notes.
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $donation->status;
        $adminName = auth('admin')->user()->name ?? 'Admin';

        $donation->status = $validated['status'];
        if ($request->filled('admin_notes')) {
            $donation->admin_notes = $validated['admin_notes'];
        }

        if ($validated['status'] === 'approved' && $oldStatus !== 'approved') {
            $donation->verified_at = now();
            $donation->verified_by = $adminName;
            if ($donation->cause) {
                $donation->cause->increment('raised_amount', $donation->amount);
            }
        } elseif ($oldStatus === 'approved' && $validated['status'] !== 'approved') {
            if ($donation->cause) {
                $donation->cause->decrement('raised_amount', $donation->amount);
            }
        }

        $donation->save();

        return redirect()->back()->with('success', 'দানের স্ট্যাটাস পরিবর্তিত হয়েছে: ' . ucfirst($validated['status']));
    }

    /**
     * Print official branded digital voucher / receipt for office records.
     */
    public function printReceipt(Donation $donation)
    {
        $donation->load('cause');
        $setting = Setting::first();
        return view('admin.donations.receipt', compact('donation', 'setting'));
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy(Donation $donation)
    {
        if ($donation->status === 'approved' && $donation->cause) {
            $donation->cause->decrement('raised_amount', $donation->amount);
        }

        if ($donation->receipt_image && Storage::disk('public')->exists($donation->receipt_image)) {
            Storage::disk('public')->delete($donation->receipt_image);
        }

        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'দানের রেকর্ড সফলভাবে মুছে ফেলা হয়েছে।');
    }

    // ==========================================================
    // DONATION CAUSES / FUNDS MANAGEMENT (দান খাত নিয়ন্ত্রণ)
    // ==========================================================

    public function causesIndex()
    {
        $causes = DonationCause::withCount('donations')->orderBy('sort_order', 'asc')->get();
        return view('admin.donations.causes.index', compact('causes'));
    }

    public function causesCreate()
    {
        return view('admin.donations.causes.create');
    }

    public function causesStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['name']);
        if (DonationCause::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $validated['slug'] = $slug;
        $validated['icon'] = $validated['icon'] ?? 'fas fa-hand-holding-heart';
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        DonationCause::create($validated);

        return redirect()->route('admin.donations.causes.index')
            ->with('success', 'নতুন দান খাত সফলভাবে যুক্ত করা হয়েছে।');
    }

    public function causesEdit(DonationCause $cause)
    {
        return view('admin.donations.causes.edit', compact('cause'));
    }

    public function causesUpdate(Request $request, DonationCause $cause)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $cause->update($validated);

        return redirect()->route('admin.donations.causes.index')
            ->with('success', 'দান খাতের তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    public function causesToggleStatus(DonationCause $cause)
    {
        $cause->is_active = !$cause->is_active;
        $cause->save();

        $statusText = $cause->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়';
        return redirect()->back()->with('success', "দান খাত সফলভাবে {$statusText} করা হয়েছে।");
    }

    public function causesDestroy(DonationCause $cause)
    {
        if ($cause->donations()->count() > 0) {
            return redirect()->back()->with('error', 'এই খাতের অধীনে ইতিমধ্যে অনুদান রেকর্ড রয়েছে, তাই এটি সরাসরি মুছে ফেলা যাবে না। প্রয়োজনে নিষ্ক্রিয় করুন।');
        }

        $cause->delete();
        return redirect()->route('admin.donations.causes.index')
            ->with('success', 'দান খাত সফলভাবে মুছে ফেলা হয়েছে।');
    }

    // ==========================================================
    // PAYMENT ACCOUNTS & NUMBERS CONFIGURATION (পেমেন্ট গেটওয়ে ও ব্যাংক তথ্য)
    // ==========================================================

    public function paymentAccounts()
    {
        $setting = Setting::firstOrCreate([]);
        return view('admin.donations.accounts', compact('setting'));
    }

    public function updatePaymentAccounts(Request $request)
    {
        $validated = $request->validate([
            'bkash_number' => 'nullable|string|max:30',
            'bkash_type' => 'nullable|string|max:30',
            'nagad_number' => 'nullable|string|max:30',
            'nagad_type' => 'nullable|string|max:30',
            'rocket_number' => 'nullable|string|max:30',
            'bank_name' => 'nullable|string|max:150',
            'bank_branch' => 'nullable|string|max:100',
            'bank_account_name' => 'nullable|string|max:150',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_routing' => 'nullable|string|max:50',
        ]);

        $setting = Setting::firstOrCreate([]);
        $setting->update($validated);

        return redirect()->back()->with('success', 'পেমেন্ট গেটওয়ে ও ব্যাংক একাউন্টের তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }
}
