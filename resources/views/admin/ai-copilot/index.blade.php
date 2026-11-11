@extends('admin.layouts.app')

@section('title', 'শুব্বান এআই সাইট কো-পাইলট (AI Site Manager)')

@section('content')
<div class="container-fluid py-3">
    <!-- Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center rounded-3 shadow-sm" style="width: 48px; height: 48px;">
                <i class="fas fa-wand-magic-sparkles fs-4 text-warning"></i>
            </div>
            <div>
                <h1 class="h3 fw-bold text-dark mb-0">এআই সাইট কো-পাইলট ও ডিজাইন ম্যানেজার</h1>
                <p class="text-muted small mb-0">সাধারণ বাংলা নির্দেশে সাইটের ডিজাইন, কালার, হোম সেকশন এবং কনফিগারেশন পরিবর্তন করুন</p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-2 px-3 rounded-pill">
                <i class="fas fa-circle text-success font-xs me-1 animate-pulse"></i> এআই মডেল প্রস্তুত
            </span>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="clearChatBtn">
                <i class="fas fa-eraser me-1"></i>চ্যাট ক্লিয়ার
            </button>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                <i class="fas fa-external-link-alt me-1"></i>লাইভ সাইট দেখুন
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Left Column: AI Interactive Command Terminal -->
        <div class="col-xl-8 col-lg-7 col-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden d-flex flex-column" style="height: 720px;">
                <div class="card-header bg-dark text-white py-3 px-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-terminal text-warning"></i>
                        <span class="fw-bold">এআই সাইট সহকারী কনসোল</span>
                    </div>
                    <span class="text-white-50 font-xs">বাংলা অথবা ইংরেজিতে নির্দেশ দিন</span>
                </div>

                <!-- Chat Messages Feed -->
                <div class="card-body p-4 overflow-y-auto flex-grow-1" id="chatMessagesFeed" style="background: #f8fafc;">
                    <!-- Bot Welcome Message -->
                    <div class="ai-msg bot-msg mb-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="msg-avatar bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 40px; height: 40px;">
                                <i class="fas fa-wand-magic-sparkles"></i>
                            </div>
                            <div class="msg-bubble bg-white p-3 rounded-4 shadow-sm border" style="max-width: 85%;">
                                <div class="fw-bold text-dark mb-1 font-sm">শুব্বান এআই সাইট কো-পাইলট</div>
                                <div class="text-secondary" style="font-size: 0.92rem; line-height: 1.6;">
                                    আসসালামু আলাইকুম! আমি শুব্বান সাইটের এআই কো-পাইলট। আমাকে যেকোনো নির্দেশ দিন, আমি সাইটে সরাসরি তা সম্পাদন করব:
                                    <ul class="mb-2 mt-2 ps-3 small text-muted">
                                        <li><strong>🎨 কালার ও থিম:</strong> <em>"সাইটের কালার পরিবর্তন করে গাঢ় সবুজ ও গোল্ডেন দাও"</em></li>
                                        <li><strong>✨ ডিজাইন উন্নয়ন:</strong> <em>"বাটনগুলোতে সুন্দর শ্যাডো ও রাউন্ডেড কোণা যুক্ত কর"</em></li>
                                        <li><strong>📑 হোম সেকশন:</strong> <em>"ভিডিও গ্যালারি সেকশনটি বন্ধ রাখো"</em> অথবা <em>"চালু কর"</em></li>
                                        <li><strong>👤 দায়িত্বশীল পরিষদ:</strong> <em>"সিরাজগঞ্জ জেলা সভাপতি হিসেবে মাওলানা আব্দুল্লাহ যুক্ত কর"</em></li>
                                        <li><strong>⚡ পারফরম্যান্স:</strong> <em>"সিস্টেম ক্যাশ পরিষ্কার কর এবং অপটিমাইজ কর"</em></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Prompt Chips -->
                <div class="p-3 bg-white border-top border-bottom overflow-x-auto d-flex gap-2 text-nowrap" id="quickPromptsWrap">
                    <span class="text-muted font-xs align-self-center me-1"><i class="fas fa-bolt text-warning"></i> নমুনা প্রম্পট:</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="সাইটের কালার পরিবর্তন করে গাঢ় সবুজ ও গোল্ডেন থিম দাও">
                        🎨 গাঢ় সবুজ থিম
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="বাটন ও কার্ডগুলোতে সুন্দর শ্যাডো এবং রাউন্ডেড ডিজাইন যুক্ত কর">
                        ✨ বাটন শ্যাডো ও রাউন্ড
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="হোমপেজের ভিডিও গ্যালারি সেকশনটি বন্ধ রাখো">
                        🎥 ভিডিও সেকশন অফ
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="হোমপেজের ভিডিও গ্যালারি সেকশনটি চালু কর">
                        🎥 ভিডিও সেকশন অন
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="সিস্টেম ক্যাশ ক্লিয়ার কর এবং সাইট অপটিমাইজ কর">
                        ⚡ ক্যাশ পরিষ্কার কর
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill font-xs prompt-chip" data-prompt="সিস্টেম ডায়াগনস্টিক রিপোর্ট দাও">
                        🔍 হেলথ রিপোর্ট
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill font-xs prompt-chip" data-prompt="আগের পরিবর্তনটি বাতিল করে পূর্বাবস্থায় ফিরিয়ে নাও">
                        ↩️ আগের পরিবর্তন বাতিল
                    </button>
                </div>

                <!-- Chat Input Form -->
                <div class="card-footer bg-white p-3 border-0">
                    <form id="aiCopilotForm" class="position-relative">
                        @csrf
                        <div class="input-group">
                            <input type="text" 
                                   id="copilotPromptInput" 
                                   class="form-control rounded-pill ps-4 py-3 border shadow-none" 
                                   placeholder="এআইকে আপনার নির্দেশ বলুন (যেমন: 'সাইটের কালার হালকা সবুজ কর')..." 
                                   autocomplete="off" 
                                   required>
                            <button type="submit" class="btn btn-success rounded-pill px-4 ms-2 d-flex align-items-center gap-2" id="sendBtn">
                                <span>পাঠান</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Live Status & Rollback Control -->
        <div class="col-xl-4 col-lg-5 col-12">
            <div class="d-flex flex-column gap-4">
                <!-- Theme & Palette Card -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-palette text-success me-2"></i>বর্তমান থিম ও কালার</h6>
                        <span class="badge bg-success font-xs">{{ $themeSettings['theme_key'] }}</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-around p-3 rounded-3 bg-light border mb-3">
                            <div class="text-center">
                                <div class="color-swatch mx-auto mb-1 rounded-3 shadow-sm border" style="width: 44px; height: 44px; background: {{ $themeSettings['primary_color'] }};"></div>
                                <div class="font-xs fw-bold text-dark">প্রাইমারি কালার</div>
                                <div class="font-xs text-muted font-monospace">{{ $themeSettings['primary_color'] }}</div>
                            </div>
                            <div class="text-center">
                                <div class="color-swatch mx-auto mb-1 rounded-3 shadow-sm border" style="width: 44px; height: 44px; background: {{ $themeSettings['accent_color'] }};"></div>
                                <div class="font-xs fw-bold text-dark">অ্যাকসেন্ট কালার</div>
                                <div class="font-xs text-muted font-monospace">{{ $themeSettings['accent_color'] }}</div>
                            </div>
                        </div>

                        <!-- Custom CSS Status -->
                        <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border font-xs">
                            <div>
                                <i class="fas fa-code text-primary me-1"></i>
                                <span>কাস্টম সিএসএস:</span>
                                <strong>{{ !empty($themeSettings['custom_css']) ? 'সক্রিয় (' . strlen($themeSettings['custom_css']) . ' bytes)' : 'খালি (ডিফল্ট)' }}</strong>
                            </div>
                            @if(!empty($themeSettings['custom_css']))
                                <form action="{{ route('admin.ai-copilot.reset-css') }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে কাস্টম সিএসএস মুছে ফেলতে চান?');">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill py-0 px-2" style="font-size: 0.7rem;">
                                        রিসেট
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Homepage Sections Status Card -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-layer-group text-primary me-2"></i>হোমপেজ সেকশন তালিকা</h6>
                        <a href="{{ route('admin.homepage.index') }}" class="btn btn-sm btn-link text-decoration-none p-0 font-xs">ম্যানেজ করুন</a>
                    </div>
                    <div class="card-body p-0 overflow-y-auto" style="max-height: 230px;">
                        <ul class="list-group list-group-flush font-xs">
                            @foreach($sections as $sec)
                                <li class="list-group-item d-flex align-items-center justify-content-between py-2 px-3">
                                    <span class="text-truncate" style="max-width: 200px;">
                                        <i class="fas fa-grip-vertical text-muted me-2"></i>{{ $sec->name_bn }}
                                    </span>
                                    <span class="badge {{ $sec->is_active ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary' }} rounded-pill">
                                        {{ $sec->is_active ? 'সক্রিয়' : 'বন্ধ' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Recent AI Changes & Rollback Card -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-history text-warning me-2"></i>সাম্প্রতিক এআই পরিবর্তন ও রোলব্যাক</h6>
                        <span class="badge bg-warning text-dark font-xs">Auto Backup</span>
                    </div>
                    <div class="card-body p-3 overflow-y-auto" style="max-height: 250px;" id="recentActionsList">
                        @forelse($recentActions as $action)
                            <div class="action-item p-2 mb-2 rounded-3 border bg-light font-xs">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge bg-secondary font-xs py-0 px-2">{{ $action->action_type }}</span>
                                    <span class="text-muted font-xs">{{ $action->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-dark fw-semibold mb-2" style="line-height: 1.3;">{{ $action->summary }}</div>
                                
                                <div class="d-flex align-items-center justify-content-between pt-1 border-top">
                                    @if($action->is_rolled_back)
                                        <span class="text-muted"><i class="fas fa-undo-alt me-1"></i>পূর্বাবস্থায় ফেরানো হয়েছে</span>
                                    @else
                                        <form action="{{ route('admin.ai-copilot.rollback', $action->id) }}" method="POST" onsubmit="return confirm('আপনি কি এই পরিবর্তনটি বাতিল করে পূর্বাবস্থায় ফিরিয়ে নিতে চান?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill py-0 px-2" style="font-size: 0.72rem;">
                                                <i class="fas fa-undo me-1"></i>রোলব্যাক (বাতিল)
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3 small">
                                এখনো কোনো এআই পরিবর্তন রেকর্ড করা হয়নি।
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .font-xs { font-size: 0.75rem; }
    .font-sm { font-size: 0.88rem; }
    .btn-xs { font-size: 0.7rem; padding: 2px 8px; }

    .animate-pulse {
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    .prompt-chip {
        transition: all 0.2s ease;
    }
    .prompt-chip:hover {
        background: #0C4B36;
        color: #ffffff;
        border-color: #0C4B36;
    }

    .msg-bubble {
        animation: slideInMsg 0.25s ease-out;
    }
    @keyframes slideInMsg {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .user-msg {
        justify-content: flex-end;
    }
    .user-msg .msg-bubble {
        background: #0C4B36 !important;
        color: #ffffff !important;
        border: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('aiCopilotForm');
    const input = document.getElementById('copilotPromptInput');
    const feed = document.getElementById('chatMessagesFeed');
    const sendBtn = document.getElementById('sendBtn');
    const clearBtn = document.getElementById('clearChatBtn');
    const chips = document.querySelectorAll('.prompt-chip');

    function scrollToBottom() {
        feed.scrollTop = feed.scrollHeight;
    }

    function appendUserMessage(text) {
        const div = document.createElement('div');
        div.className = 'ai-msg user-msg d-flex justify-content-end mb-3';
        div.innerHTML = `
            <div class="msg-bubble bg-success text-white p-3 rounded-4 shadow-sm" style="max-width: 80%;">
                <div class="fw-bold font-xs text-white-50 mb-1">অ্যাডমিনের নির্দেশ</div>
                <div style="font-size: 0.95rem;">${escapeHtml(text)}</div>
            </div>
        `;
        feed.appendChild(div);
        scrollToBottom();
    }

    function appendBotMessage(data) {
        const div = document.createElement('div');
        div.className = 'ai-msg bot-msg mb-4';

        let previewHtml = data.preview_html ? `<div class="mt-2">${data.preview_html}</div>` : '';
        let rollbackBtn = '';
        if (data.can_rollback && data.action_id) {
            rollbackBtn = `
                <div class="mt-3 pt-2 border-top d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 rollback-btn" data-id="${data.action_id}">
                        <i class="fas fa-undo me-1"></i>এই পরিবর্তনটি বাতিল করুন (Rollback)
                    </button>
                </div>
            `;
        }

        div.innerHTML = `
            <div class="d-flex align-items-start gap-3">
                <div class="msg-avatar bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 40px; height: 40px;">
                    <i class="fas fa-wand-magic-sparkles"></i>
                </div>
                <div class="msg-bubble bg-white p-3 rounded-4 shadow-sm border" style="max-width: 85%;">
                    <div class="fw-bold text-dark mb-1 font-sm">শুব্বান এআই কো-পাইলট</div>
                    <div class="text-secondary" style="font-size: 0.92rem; line-height: 1.6;">
                        ${data.message || 'নির্দেশ সফলভাবে কার্যকর করা হয়েছে।'}
                    </div>
                    ${previewHtml}
                    ${rollbackBtn}
                </div>
            </div>
        `;
        feed.appendChild(div);
        scrollToBottom();
    }

    function appendTypingIndicator() {
        const div = document.createElement('div');
        div.id = 'typingIndicator';
        div.className = 'ai-msg bot-msg mb-4';
        div.innerHTML = `
            <div class="d-flex align-items-start gap-3">
                <div class="msg-avatar bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                    <i class="fas fa-wand-magic-sparkles"></i>
                </div>
                <div class="msg-bubble bg-white p-3 rounded-4 shadow-sm border">
                    <span class="spinner-border spinner-border-sm text-success me-2" role="status"></span>
                    <span class="text-muted small">এআই নির্দেশ বিশ্লেষণ ও কার্যকর করছে...</span>
                </div>
            </div>
        `;
        feed.appendChild(div);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        const ind = document.getElementById('typingIndicator');
        if (ind) ind.remove();
    }

    function escapeHtml(text) {
        const p = document.createElement('p');
        p.textContent = text;
        return p.innerHTML;
    }

    async function submitPrompt(promptText) {
        promptText = promptText.trim();
        if (!promptText) return;

        appendUserMessage(promptText);
        input.value = '';
        input.disabled = true;
        sendBtn.disabled = true;
        appendTypingIndicator();

        try {
            const response = await fetch("{{ route('admin.ai-copilot.execute') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ prompt: promptText })
            });

            removeTypingIndicator();
            input.disabled = false;
            sendBtn.disabled = false;
            input.focus();

            if (!response.ok) {
                appendBotMessage({ success: false, message: 'সার্ভারে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।' });
                return;
            }

            const result = await response.json();
            appendBotMessage(result);
        } catch (err) {
            removeTypingIndicator();
            input.disabled = false;
            sendBtn.disabled = false;
            appendBotMessage({ success: false, message: 'ইন্টারনেট বা নেটওয়ার্ক সংযোগে ত্রুটি দেখা দিয়েছে।' });
        }
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        submitPrompt(input.value);
    });

    chips.forEach(chip => {
        chip.addEventListener('click', function () {
            const p = this.getAttribute('data-prompt');
            if (p) submitPrompt(p);
        });
    });

    // Rollback button click handler inside chat
    feed.addEventListener('click', async function (e) {
        const btn = e.target.closest('.rollback-btn');
        if (!btn) return;

        const actionId = btn.getAttribute('data-id');
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> বাতিল করা হচ্ছে...`;

        try {
            const res = await fetch("{{ route('admin.ai-copilot.rollback') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ action_id: actionId })
            });
            const data = await res.json();
            btn.className = 'btn btn-sm btn-secondary rounded-pill px-3';
            btn.innerHTML = `<i class="fas fa-check me-1"></i> পূর্বাবস্থায় ফিরিয়ে নেওয়া হয়েছে`;
            appendBotMessage({ success: data.success, message: data.message });
        } catch (err) {
            btn.disabled = false;
            btn.innerHTML = `<i class="fas fa-undo me-1"></i> পুনরায় চেষ্টা করুন`;
        }
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            if (confirm('আপনি কি এই চ্যাট সেশনটি পরিষ্কার করতে চান?')) {
                feed.innerHTML = '';
            }
        });
    }
});
</script>
@endpush
@endsection
