<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AIAdminAction;
use App\Models\HomeSection;
use App\Models\Setting;
use App\Services\AIAdminCopilotService;
use Illuminate\Http\Request;

class AdminAICopilotController extends Controller
{
    protected AIAdminCopilotService $copilot;

    public function __construct(AIAdminCopilotService $copilot)
    {
        $this->copilot = $copilot;
    }

    public function index()
    {
        $themeSettings = Setting::getThemeSettings();
        $sections = HomeSection::orderBy('order')->get();
        $recentActions = AIAdminAction::latest()->take(8)->get();
        $setting = Setting::first();

        return view('admin.ai-copilot.index', compact('themeSettings', 'sections', 'recentActions', 'setting'));
    }

    public function execute(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        $response = $this->copilot->executePrompt($request->input('prompt'));

        return response()->json($response);
    }

    public function rollback(Request $request, ?int $id = null)
    {
        $actionId = $id ?: $request->input('action_id');
        $result = $this->copilot->handleRollback($actionId ? (int) $actionId : null);

        if ($request->expectsJson()) {
            return response()->json($result);
        }

        return redirect()->route('admin.ai-copilot.index')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function resetCss(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            $setting->update(['custom_css' => null]);
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        }

        return redirect()->route('admin.ai-copilot.index')
            ->with('success', 'কাস্টম সিএসএস ডিজাইন রিসেট করা হয়েছে।');
    }
}
