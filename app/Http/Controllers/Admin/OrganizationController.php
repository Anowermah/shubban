<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iyanat;
use App\Models\ProgramReport;
use App\Models\TierPromotion;
use App\Models\User;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * List all monthly iyanats.
     */
    public function iyanats(Request $request)
    {
        $query = Iyanat::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('month')) {
            $query->where('month', 'like', "%{$request->month}%");
        }

        $iyanats = $query->latest()->paginate(20);

        $stats = [
            'total_approved' => Iyanat::where('status', 'approved')->sum('amount'),
            'total_count' => Iyanat::count(),
            'pending_count' => Iyanat::where('status', 'pending')->count(),
        ];

        return view('admin.organization.iyanats', compact('iyanats', 'stats'));
    }

    /**
     * Update iyanat status (approve/reject).
     */
    public function updateIyanatStatus(Request $request, Iyanat $iyanat)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
        ]);

        $iyanat->status = $request->status;
        $iyanat->save();

        $statusText = $request->status === 'approved' ? 'অনুমোদিত' : ($request->status === 'rejected' ? 'প্রত্যাখ্যাত' : 'পর্যালোচনায়');

        return redirect()->back()->with('success', "রসিদ নং {$iyanat->receipt_no} এর এয়ানত সফলভাবে {$statusText} করা হয়েছে।");
    }

    /**
     * List all program reports.
     */
    public function programReports(Request $request)
    {
        $query = ProgramReport::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('org_tier')) {
            $query->where('org_tier', $request->org_tier);
        }

        $reports = $query->latest()->paginate(20);

        $stats = [
            'total_reports' => ProgramReport::count(),
            'approved_reports' => ProgramReport::where('status', 'approved')->count(),
            'submitted_reports' => ProgramReport::where('status', 'submitted')->count(),
        ];

        return view('admin.organization.reports', compact('reports', 'stats'));
    }

    /**
     * Update program report status and feedback.
     */
    public function updateReportStatus(Request $request, ProgramReport $report)
    {
        $request->validate([
            'status' => ['required', 'in:submitted,under_review,approved'],
            'admin_feedback' => ['nullable', 'string', 'max:1000'],
        ]);

        $report->status = $request->status;
        $report->admin_feedback = $request->admin_feedback;
        $report->save();

        return redirect()->back()->with('success', "প্রতিবেদনটি সফলভাবে আপডেট করা হয়েছে।");
    }

    /**
     * List all tier promotion applications.
     */
    public function tierPromotions(Request $request)
    {
        $query = TierPromotion::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $promotions = $query->latest()->paginate(20);

        $stats = [
            'total' => TierPromotion::count(),
            'pending' => TierPromotion::where('status', 'pending')->count(),
            'approved' => TierPromotion::where('status', 'approved')->count(),
        ];

        return view('admin.organization.promotions', compact('promotions', 'stats'));
    }

    /**
     * Approve or reject a tier promotion application.
     */
    public function updatePromotionStatus(Request $request, TierPromotion $promotion)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $promotion->status = $request->status;
        $promotion->admin_notes = $request->admin_notes;
        $promotion->save();

        // If approved, update user's worker_tier and role!
        if ($request->status === 'approved') {
            $user = $promotion->user;
            $user->worker_tier = $promotion->target_tier;
            $user->tier_promoted_at = now();

            // Also map to role if student
            if (in_array($promotion->target_tier, ['rageb', 'aref', 'salek', 'saleh'])) {
                $user->role = 'student_' . $promotion->target_tier;
            }

            $user->save();
        }

        $tierLabel = TierPromotion::getTierLabel($promotion->target_tier);

        return redirect()->back()->with('success', "কর্মী {$promotion->user->name} এর '{$tierLabel}' স্তরে পদোন্নতি আবেদন সফলভাবে হালনাগাদ করা হয়েছে।");
    }
}
