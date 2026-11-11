<?php

namespace App\Http\Controllers;

use App\Models\AIChatSetting;
use App\Services\AIChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AIChatController extends Controller
{
    protected AIChatService $chatService;

    public function __construct(AIChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Get initial config for the floating chat widget.
     */
    public function init(Request $request)
    {
        $setting = AIChatSetting::getSettings();

        return response()->json([
            'is_enabled' => (bool) $setting->is_enabled,
            'bot_name' => $setting->bot_name,
            'bot_subtitle' => $setting->bot_subtitle,
            'welcome_message' => $setting->welcome_message,
            'widget_position' => $setting->widget_position ?: 'bottom-right',
            'quick_prompts' => $setting->quick_prompts ?: AIChatSetting::defaultQuickPrompts(),
        ]);
    }

    /**
     * Send user message to AI and receive reply.
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string|max:100',
        ]);

        $sessionId = $request->input('session_id') ?: session()->getId();
        if (empty($sessionId)) {
            $sessionId = Str::uuid()->toString();
        }

        $userMessage = $request->input('message');
        $userIp = $request->ip();

        $result = $this->chatService->generateResponse($userMessage, $sessionId, $userIp);

        return response()->json($result);
    }

    /**
     * Submit visitor feedback (thumbs up / down).
     */
    public function feedback(Request $request)
    {
        $request->validate([
            'message_id' => 'required|integer',
            'was_helpful' => 'required|boolean',
        ]);

        $success = $this->chatService->recordFeedback(
            $request->input('message_id'),
            (bool) $request->input('was_helpful')
        );

        return response()->json(['success' => $success]);
    }
}
