@php
    $aiSetting = \App\Models\AIChatSetting::getSettings();
@endphp

@if($aiSetting->is_enabled && $aiSetting->enable_floating_widget)
<!-- ========================================================================
     SHUBBAN SMART AI CHAT ASSISTANT WIDGET
     ======================================================================== -->
<style>
    /* AI Widget Floating Button */
    .shubban-ai-launcher {
        position: fixed;
        bottom: 24px;
        {{ $aiSetting->widget_position === 'bottom-left' ? 'left: 24px;' : 'right: 24px;' }}
        z-index: 1040;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        cursor: pointer;
    }
    .shubban-ai-btn {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #072e20 0%, #0C4B36 60%, #136f50 100%);
        color: #fff;
        border: 2px solid #FBB040;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        box-shadow: 0 8px 24px rgba(12, 75, 54, 0.45);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .shubban-ai-btn:hover {
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 12px 28px rgba(12, 75, 54, 0.55);
        color: #FBB040;
    }
    .shubban-ai-pulse {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: 50%;
        border: 2px solid #FBB040;
        animation: ai-pulse 2.2s infinite;
        opacity: 0.7;
        pointer-events: none;
    }
    @keyframes ai-pulse {
        0% { transform: scale(1); opacity: 0.8; }
        70% { transform: scale(1.35); opacity: 0; }
        100% { transform: scale(1.4); opacity: 0; }
    }
    .shubban-ai-label {
        background: #0C4B36;
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 14px rgba(0,0,0,0.18);
        border: 1px solid rgba(251, 176, 64, 0.4);
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        animation: ai-bounce 4s infinite ease-in-out;
    }
    @keyframes ai-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    .shubban-ai-online-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 6px #22c55e;
    }

    /* AI Chat Window */
    .shubban-ai-window {
        position: fixed;
        bottom: 95px;
        {{ $aiSetting->widget_position === 'bottom-left' ? 'left: 24px;' : 'right: 24px;' }}
        width: 380px;
        max-width: calc(100vw - 32px);
        height: 560px;
        max-height: calc(100vh - 120px);
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.22);
        border: 1px solid rgba(12, 75, 54, 0.15);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1050;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: {{ $aiSetting->widget_position === 'bottom-left' ? 'bottom left' : 'bottom right' }};
    }
    .shubban-ai-window.active {
        display: flex;
        animation: ai-slide-in 0.25s ease forwards;
    }
    @keyframes ai-slide-in {
        from { opacity: 0; transform: scale(0.92) translateY(15px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* Header */
    .shubban-ai-header {
        background: linear-gradient(135deg, #072e20 0%, #0C4B36 70%, #115e43 100%);
        color: #ffffff;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #FBB040;
    }
    .shubban-ai-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        border: 1.5px solid #FBB040;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        color: #FBB040;
    }
    .shubban-ai-header-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.75);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        cursor: pointer;
    }
    .shubban-ai-header-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
    }

    /* Body */
    .shubban-ai-body {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 12px;
        scroll-behavior: smooth;
    }
    .shubban-ai-body::-webkit-scrollbar {
        width: 5px;
    }
    .shubban-ai-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    /* Message Bubbles */
    .ai-msg {
        display: flex;
        gap: 10px;
        max-width: 88%;
        animation: ai-msg-fade 0.2s ease;
    }
    @keyframes ai-msg-fade {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .ai-msg.bot {
        align-self: flex-start;
    }
    .ai-msg.user {
        align-self: flex-end;
        flex-direction: row-reverse;
    }
    .ai-bubble {
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 0.9rem;
        line-height: 1.55;
        word-break: break-word;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }
    .ai-msg.bot .ai-bubble {
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-top-left-radius: 4px;
    }
    .ai-msg.user .ai-bubble {
        background: #0C4B36;
        color: #ffffff;
        border-top-right-radius: 4px;
    }
    .ai-msg-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .ai-msg.bot .ai-msg-avatar {
        background: #0C4B36;
        color: #FBB040;
    }
    .ai-msg.user .ai-msg-avatar {
        background: #FBB040;
        color: #0C4B36;
    }
    .ai-msg-time {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 4px;
    }
    .ai-msg.user .ai-msg-time {
        text-align: right;
    }

    /* Thumbs feedback */
    .ai-feedback-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
        font-size: 0.75rem;
    }
    .ai-feedback-btn {
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 2px 5px;
        border-radius: 4px;
        transition: all 0.15s;
    }
    .ai-feedback-btn:hover {
        color: #0C4B36;
        background: #f1f5f9;
    }
    .ai-feedback-btn.active {
        color: #0C4B36;
        font-weight: bold;
    }

    /* Quick Prompts Chips */
    .shubban-ai-prompts {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 4px 0 10px;
    }
    .ai-prompt-chip {
        background: #ffffff;
        color: #0C4B36;
        border: 1px solid rgba(12, 75, 54, 0.25);
        padding: 5px 11px;
        border-radius: 16px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .ai-prompt-chip:hover {
        background: #0C4B36;
        color: #ffffff;
        border-color: #0C4B36;
    }

    /* Typing Indicator */
    .ai-typing {
        display: none;
        align-items: center;
        gap: 4px;
        padding: 10px 14px;
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        width: fit-content;
    }
    .ai-typing span {
        width: 6px;
        height: 6px;
        background: #0C4B36;
        border-radius: 50%;
        animation: ai-dot-bounce 1.4s infinite ease-in-out both;
    }
    .ai-typing span:nth-child(1) { animation-delay: -0.32s; }
    .ai-typing span:nth-child(2) { animation-delay: -0.16s; }
    @keyframes ai-dot-bounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    /* Footer & Input */
    .shubban-ai-footer {
        padding: 10px 14px;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
    }
    .shubban-ai-form {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 24px;
        padding: 4px 6px 4px 14px;
        transition: border-color 0.2s;
    }
    .shubban-ai-form:focus-within {
        border-color: #0C4B36;
        box-shadow: 0 0 0 2px rgba(12, 75, 54, 0.12);
        background: #ffffff;
    }
    .shubban-ai-input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 0.9rem;
        padding: 6px 0;
        color: #1e293b;
    }
    .shubban-ai-send-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #0C4B36;
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .shubban-ai-send-btn:hover {
        background: #FBB040;
        color: #072e20;
    }
    .shubban-ai-note {
        font-size: 0.68rem;
        color: #94a3b8;
        text-align: center;
        margin-top: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    /* Dark Mode Theme Support */
    [data-theme="dark"] .shubban-ai-window {
        background: #1e293b;
        border-color: #334155;
    }
    [data-theme="dark"] .shubban-ai-body {
        background: #0f172a;
    }
    [data-theme="dark"] .ai-msg.bot .ai-bubble {
        background: #1e293b;
        color: #f8fafc;
        border-color: #334155;
    }
    [data-theme="dark"] .ai-prompt-chip {
        background: #1e293b;
        color: #6ee7b7;
        border-color: #334155;
    }
    [data-theme="dark"] .ai-prompt-chip:hover {
        background: #059669;
        color: #ffffff;
    }
    [data-theme="dark"] .shubban-ai-footer {
        background: #1e293b;
        border-color: #334155;
    }
    [data-theme="dark"] .shubban-ai-form {
        background: #0f172a;
        border-color: #334155;
    }
    [data-theme="dark"] .shubban-ai-input {
        color: #f8fafc;
    }
    [data-theme="dark"] .ai-typing {
        background: #1e293b;
        border-color: #334155;
    }

    @media (max-width: 576px) {
        .shubban-ai-window {
            bottom: 0 !important;
            right: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            max-width: 100vw !important;
            height: 85vh !important;
            max-height: 85vh !important;
            border-radius: 20px 20px 0 0 !important;
        }
        .shubban-ai-label {
            display: none;
        }
    }
</style>

<!-- Floating Launcher Button -->
<div class="shubban-ai-launcher" id="shubbanAiLauncher">
    <div class="shubban-ai-label d-none d-sm-flex">
        <span class="shubban-ai-online-dot"></span>
        <span>{{ $aiSetting->bot_name }}</span>
    </div>
    <button type="button" class="shubban-ai-btn" id="shubbanAiToggleBtn" aria-label="এআই সহকারী ওপেন করুন" title="{{ $aiSetting->bot_name }}">
        <div class="shubban-ai-pulse"></div>
        <i class="fas fa-robot" id="aiLauncherIcon"></i>
    </button>
</div>

<!-- Expandable Chat Window -->
<div class="shubban-ai-window" id="shubbanAiWindow">
    <!-- Header -->
    <div class="shubban-ai-header">
        <div class="d-flex align-items-center gap-2">
            <div class="shubban-ai-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div>
                <h6 class="mb-0 fw-bold fs-6 text-white">{{ $aiSetting->bot_name }}</h6>
                <div class="d-flex align-items-center gap-1 font-xs text-white-50">
                    <span class="shubban-ai-online-dot"></span>
                    <span>{{ $aiSetting->bot_subtitle }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-1">
            <button type="button" class="shubban-ai-header-btn" id="aiClearHistoryBtn" title="কথোপকথন মুছে ফেলুন">
                <i class="fas fa-trash-alt font-xs"></i>
            </button>
            <button type="button" class="shubban-ai-header-btn" id="aiCloseBtn" title="মিনিমাইজ করুন">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Body Messages Thread -->
    <div class="shubban-ai-body" id="aiMessagesContainer">
        <!-- Default Welcome Message -->
        <div class="ai-msg bot">
            <div class="ai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div>
                <div class="ai-bubble">
                    {!! nl2br(e($aiSetting->welcome_message)) !!}
                </div>
                <div class="ai-msg-time">এইমাত্র</div>
            </div>
        </div>

        <!-- Predefined Quick Prompts -->
        @if(!empty($aiSetting->quick_prompts) && is_array($aiSetting->quick_prompts))
            <div class="shubban-ai-prompts" id="aiQuickPrompts">
                @foreach($aiSetting->quick_prompts as $prompt)
                    <button type="button" class="ai-prompt-chip" data-prompt="{{ $prompt }}">
                        <i class="fas fa-question-circle font-xs me-1"></i> {{ $prompt }}
                    </button>
                @endforeach
            </div>
        @endif

        <!-- Typing Animation Indicator -->
        <div class="ai-msg bot" id="aiTypingIndicator" style="display: none;">
            <div class="ai-msg-avatar"><i class="fas fa-robot"></i></div>
            <div class="ai-typing" style="display: flex;">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <!-- Footer Input Form -->
    <div class="shubban-ai-footer">
        <form id="shubbanAiForm" class="shubban-ai-form" onsubmit="return false;">
            <input type="text" class="shubban-ai-input" id="aiUserInput" placeholder="আপনার প্রশ্নটি বাংলায় লিখুন..." autocomplete="off">
            <button type="submit" class="shubban-ai-send-btn" id="aiSendBtn" aria-label="বার্তা পাঠান">
                <i class="fas fa-paper-plane font-xs"></i>
            </button>
        </form>
        <div class="shubban-ai-note">
            <i class="fas fa-shield-alt text-success"></i>
            <span>শুব্বান এআই • কুরআন ও সহীহ সুন্নাহর ভিত্তিতে পরিচালিত</span>
        </div>
    </div>
</div>

<!-- AI Chat JavaScript Engine -->
<script>
(function() {
    const launcherBtn = document.getElementById('shubbanAiToggleBtn');
    const closeBtn = document.getElementById('aiCloseBtn');
    const clearBtn = document.getElementById('aiClearHistoryBtn');
    const chatWindow = document.getElementById('shubbanAiWindow');
    const form = document.getElementById('shubbanAiForm');
    const input = document.getElementById('aiUserInput');
    const container = document.getElementById('aiMessagesContainer');
    const typingIndicator = document.getElementById('aiTypingIndicator');
    const promptsWrap = document.getElementById('aiQuickPrompts');
    const launcherIcon = document.getElementById('aiLauncherIcon');

    const STORAGE_KEY = 'shubban_ai_chat_session_msgs';
    const SESSION_ID_KEY = 'shubban_ai_chat_session_id';

    // Get or generate session UUID
    let sessionId = localStorage.getItem(SESSION_ID_KEY);
    if (!sessionId) {
        sessionId = 'sess_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
        localStorage.setItem(SESSION_ID_KEY, sessionId);
    }

    // Toggle Chat Window
    function toggleChat(open) {
        const isOpen = open !== undefined ? open : !chatWindow.classList.contains('active');
        if (isOpen) {
            chatWindow.classList.add('active');
            launcherIcon.className = 'fas fa-chevron-down';
            setTimeout(() => input.focus(), 200);
            scrollToBottom();
        } else {
            chatWindow.classList.remove('active');
            launcherIcon.className = 'fas fa-robot';
        }
    }

    launcherBtn.addEventListener('click', () => toggleChat());
    closeBtn.addEventListener('click', () => toggleChat(false));

    function scrollToBottom() {
        container.scrollTop = container.scrollHeight;
    }

    // Append Message to Thread
    function appendMessage(text, isUser, timeText, messageId) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'ai-msg ' + (isUser ? 'user' : 'bot');

        const avatar = document.createElement('div');
        avatar.className = 'ai-msg-avatar';
        avatar.innerHTML = isUser ? '<i class="fas fa-user"></i>' : '<i class="fas fa-robot"></i>';

        const contentWrap = document.createElement('div');

        const bubble = document.createElement('div');
        bubble.className = 'ai-bubble';
        // Auto convert linebreaks
        bubble.innerHTML = text.replace(/\n/g, '<br>');

        contentWrap.appendChild(bubble);

        const time = document.createElement('div');
        time.className = 'ai-msg-time';
        time.textContent = timeText || new Date().toLocaleTimeString('bn-BD', { hour: '2-digit', minute: '2-digit' });
        contentWrap.appendChild(time);

        // Feedback buttons for bot messages with ID
        if (!isUser && messageId) {
            const feedbackDiv = document.createElement('div');
            feedbackDiv.className = 'ai-feedback-actions';
            feedbackDiv.innerHTML = `
                <button type="button" class="ai-feedback-btn btn-thumbs-up" data-id="${messageId}" title="উত্তরটি কার্যকর ছিল">
                    <i class="far fa-thumbs-up"></i>
                </button>
                <button type="button" class="ai-feedback-btn btn-thumbs-down" data-id="${messageId}" title="উপকারী ছিল না">
                    <i class="far fa-thumbs-down"></i>
                </button>
            `;
            contentWrap.appendChild(feedbackDiv);
        }

        msgDiv.appendChild(avatar);
        msgDiv.appendChild(contentWrap);

        container.insertBefore(msgDiv, typingIndicator);
        scrollToBottom();

        // Save to local storage
        saveToLocalStorage(text, isUser, time.textContent, messageId);
    }

    function saveToLocalStorage(text, isUser, time, messageId) {
        try {
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            saved.push({ text, isUser, time, messageId });
            localStorage.setItem(STORAGE_KEY, JSON.stringify(saved.slice(-30))); // Keep last 30
        } catch (e) {}
    }

    // Restore History
    function restoreHistory() {
        try {
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            saved.forEach(m => {
                appendMessage(m.text, m.isUser, m.time, m.messageId);
            });
        } catch (e) {}
    }
    restoreHistory();

    // Clear History
    clearBtn.addEventListener('click', function() {
        if (confirm('আপনি কি এই চ্যাট হিস্ট্রি মুছে ফেলতে চান?')) {
            localStorage.removeItem(STORAGE_KEY);
            // Remove user and bot messages except initial welcome
            const messages = container.querySelectorAll('.ai-msg');
            messages.forEach((m, idx) => {
                if (idx > 0 && m !== typingIndicator) {
                    m.remove();
                }
            });
        }
    });

    // Send Query to Backend
    async function sendMessage(query) {
        query = query.trim();
        if (!query) return;

        appendMessage(query, true);
        input.value = '';

        // Hide quick prompts once conversation starts
        if (promptsWrap) promptsWrap.style.display = 'none';

        // Show typing indicator
        typingIndicator.style.display = 'flex';
        scrollToBottom();

        try {
            const res = await fetch('{{ route("ai-chat.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: query,
                    session_id: sessionId
                })
            });

            const data = await res.json();
            typingIndicator.style.display = 'none';

            if (data && data.reply) {
                appendMessage(data.reply, false, null, data.message_id);
            } else {
                appendMessage('দুঃখিত, সংযোগে সমস্যা হয়েছে। অনুগ্রহ করে পুনরায় চেষ্টা করুন।', false);
            }
        } catch (err) {
            typingIndicator.style.display = 'none';
            appendMessage('দুঃখিত, কোনো উত্তর পাওয়া যায়নি। অনুগ্রহ করে ইন্টারনেট সংযোগ চেক করুন।', false);
        }
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage(input.value);
    });

    // Quick Prompts Click
    if (promptsWrap) {
        promptsWrap.addEventListener('click', function(e) {
            const chip = e.target.closest('.ai-prompt-chip');
            if (chip) {
                const prompt = chip.getAttribute('data-prompt');
                if (prompt) sendMessage(prompt);
            }
        });
    }

    // Feedback Thumbs Click
    container.addEventListener('click', async function(e) {
        const btnUp = e.target.closest('.btn-thumbs-up');
        const btnDown = e.target.closest('.btn-thumbs-down');

        if (btnUp || btnDown) {
            const btn = btnUp || btnDown;
            const messageId = btn.getAttribute('data-id');
            const wasHelpful = Boolean(btnUp);

            const wrap = btn.closest('.ai-feedback-actions');
            wrap.innerHTML = `<span class="text-success font-xs"><i class="fas fa-check"></i> ধন্যবাদ!</span>`;

            try {
                await fetch('{{ route("ai-chat.feedback") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message_id: messageId, was_helpful: wasHelpful })
                });
            } catch (err) {}
        }
    });
})();
</script>
@endif
