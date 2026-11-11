<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AIChatSetting;
use App\Models\AIChatKnowledgeBase;
use App\Models\AIChatMessage;
use App\Services\AIChatService;
use Illuminate\Http\Request;

class AdminAIChatController extends Controller
{
    protected AIChatService $chatService;

    public function __construct(AIChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Dashboard Overview & Live Test Console.
     */
    public function index()
    {
        $setting = AIChatSetting::getSettings();
        AIChatKnowledgeBase::seedDefaultsIfEmpty();

        $stats = [
            'total_messages' => AIChatMessage::count(),
            'today_messages' => AIChatMessage::whereDate('created_at', today())->count(),
            'total_knowledge' => AIChatKnowledgeBase::count(),
            'active_knowledge' => AIChatKnowledgeBase::active()->count(),
            'helpful_count' => AIChatMessage::where('was_helpful', true)->count(),
            'unhelpful_count' => AIChatMessage::where('was_helpful', false)->count(),
        ];

        $recentLogs = AIChatMessage::with('knowledgeBase')
            ->latest()
            ->take(8)
            ->get();

        $categories = AIChatKnowledgeBase::categories();

        return view('admin.ai-chat.index', compact('setting', 'stats', 'recentLogs', 'categories'));
    }

    /**
     * Update AI Chat Settings & API Provider.
     */
    public function updateSettings(Request $request)
    {
        $setting = AIChatSetting::getSettings();

        $validated = $request->validate([
            'bot_name' => 'required|string|max:100',
            'bot_subtitle' => 'nullable|string|max:150',
            'welcome_message' => 'required|string|max:1000',
            'fallback_message' => 'required|string|max:1000',
            'system_prompt' => 'nullable|string|max:2000',
            'ai_provider' => 'required|in:internal,gemini,openai',
            'api_key' => 'nullable|string|max:255',
            'model_name' => 'nullable|string|max:100',
            'temperature' => 'nullable|numeric|min:0|max:1',
            'widget_position' => 'required|in:bottom-right,bottom-left',
            'quick_prompts_text' => 'nullable|string',
        ]);

        $setting->is_enabled = $request->has('is_enabled');
        $setting->enable_floating_widget = $request->has('enable_floating_widget');
        $setting->bot_name = $validated['bot_name'];
        $setting->bot_subtitle = $validated['bot_subtitle'];
        $setting->welcome_message = $validated['welcome_message'];
        $setting->fallback_message = $validated['fallback_message'];
        $setting->system_prompt = $validated['system_prompt'];
        $setting->ai_provider = $validated['ai_provider'];
        
        // Only update API key if provided (don't erase if empty when editing)
        if ($request->filled('api_key')) {
            $setting->api_key = trim($request->input('api_key'));
        } elseif ($request->has('clear_api_key')) {
            $setting->api_key = null;
        }

        $setting->model_name = $validated['model_name'] ?: ($validated['ai_provider'] === 'openai' ? 'gpt-4o-mini' : 'gemini-1.5-flash');
        $setting->temperature = $validated['temperature'] ?? 0.7;
        $setting->widget_position = $validated['widget_position'];

        // Parse quick prompts (separated by newlines)
        if (!empty($validated['quick_prompts_text'])) {
            $prompts = array_values(array_filter(array_map('trim', explode("\n", $validated['quick_prompts_text']))));
            $setting->quick_prompts = $prompts;
        }

        $setting->save();

        return redirect()->route('admin.ai-chat.index')
            ->with('success', 'এআই চ্যাট সেটিংস ও কনফিগারেশন সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Knowledge Base Q&A Manager.
     */
    public function knowledgeIndex(Request $request)
    {
        AIChatKnowledgeBase::seedDefaultsIfEmpty();

        $query = AIChatKnowledgeBase::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('question', 'like', "%{$term}%")
                  ->orWhere('keywords', 'like', "%{$term}%")
                  ->orWhere('answer', 'like', "%{$term}%");
            });
        }

        $items = $query->orderByDesc('priority')->orderByDesc('hit_count')->paginate(15);
        $categories = AIChatKnowledgeBase::categories();

        return view('admin.ai-chat.knowledge', compact('items', 'categories'));
    }

    /**
     * Store new Q&A in Knowledge Base.
     */
    public function knowledgeStore(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'question' => 'required|string|max:255',
            'keywords' => 'nullable|string',
            'answer' => 'required|string',
            'priority' => 'nullable|integer|min:0|max:10',
        ]);

        AIChatKnowledgeBase::create([
            'category' => $validated['category'],
            'question' => $validated['question'],
            'keywords' => $validated['keywords'],
            'answer' => $validated['answer'],
            'priority' => $validated['priority'] ?? 0,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'নতুন প্রশ্নোত্তর সফলভাবে নলেজ বেসে যুক্ত করা হয়েছে।');
    }

    /**
     * Update Q&A item.
     */
    public function knowledgeUpdate(Request $request, AIChatKnowledgeBase $item)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'question' => 'required|string|max:255',
            'keywords' => 'nullable|string',
            'answer' => 'required|string',
            'priority' => 'nullable|integer|min:0|max:10',
        ]);

        $item->update($validated);

        return redirect()->back()->with('success', 'প্রশ্নোত্তরটি সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Delete Q&A item.
     */
    public function knowledgeDestroy(AIChatKnowledgeBase $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'প্রশ্নোত্তরটি মুছে ফেলা হয়েছে।');
    }

    /**
     * Toggle Q&A active status.
     */
    public function knowledgeToggle(AIChatKnowledgeBase $item)
    {
        $item->is_active = !$item->is_active;
        $item->save();

        return redirect()->back()->with('success', "প্রশ্নোত্তরটি " . ($item->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়') . ' করা হয়েছে।');
    }

    /**
     * Reset Knowledge Base to default facts.
     */
    public function knowledgeReset()
    {
        AIChatKnowledgeBase::resetToDefaults();
        return redirect()->back()->with('success', 'নলেজ বেস সফলভাবে ডিফল্ট প্রাতিষ্ঠানিক উপাত্তে রিসেট করা হয়েছে।');
    }

    /**
     * Visitor Chat Logs & Questions.
     */
    public function logsIndex(Request $request)
    {
        $query = AIChatMessage::with('knowledgeBase');

        if ($request->filled('filter')) {
            if ($request->filter === 'unresolved') {
                $query->where('is_resolved', false);
            } elseif ($request->filter === 'unhelpful') {
                $query->where('was_helpful', false);
            } elseif ($request->filter === 'helpful') {
                $query->where('was_helpful', true);
            }
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('user_message', 'like', "%{$term}%")
                  ->orWhere('bot_response', 'like', "%{$term}%");
            });
        }

        $logs = $query->latest()->paginate(20);

        return view('admin.ai-chat.logs', compact('logs'));
    }

    /**
     * Convert visitor question from log into new Knowledge Base item.
     */
    public function convertLogToKnowledge(Request $request, AIChatMessage $message)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'question' => 'required|string|max:255',
            'keywords' => 'nullable|string',
            'answer' => 'required|string',
        ]);

        $kb = AIChatKnowledgeBase::create([
            'category' => $validated['category'],
            'question' => $validated['question'],
            'keywords' => $validated['keywords'],
            'answer' => $validated['answer'],
            'priority' => 5,
            'is_active' => true,
        ]);

        // Link message to new knowledge base entry
        $message->update([
            'matched_knowledge_id' => $kb->id,
            'is_resolved' => true,
        ]);

        return redirect()->back()->with('success', 'ভিজিটরের প্রশ্নটি সফলভাবে নতুন নলেজ বেস হিসেবে যুক্ত করা হয়েছে।');
    }

    /**
     * Clear all chat logs.
     */
    public function clearLogs()
    {
        AIChatMessage::truncate();
        return redirect()->back()->with('success', 'সকল চ্যাট লগ মুছে ফেলা হয়েছে।');
    }

    /**
     * Realtime Test Query AJAX endpoint for Admin.
     */
    public function testQuery(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        $result = $this->chatService->generateResponse(
            $request->input('message'),
            'admin-test-session',
            $request->ip()
        );

        return response()->json($result);
    }
}
