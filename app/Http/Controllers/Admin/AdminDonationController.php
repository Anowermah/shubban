<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class AdminDonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $donation->update($validated);

        return redirect()->back()->with('success', 'দানের স্ট্যাটাস আপডেট করা হয়েছে।');
    }
}
