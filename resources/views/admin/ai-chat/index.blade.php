@extends('admin.layouts.app')

@section('title', 'শুব্বান এআই সহকারী কন্ট্রোল সেন্টার')

@push('styles')
<style>
    .ai-stat-card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease;
    }
    .ai-stat-card:hover {
        transform: translateY(-3px);
    }
    .ai-test-console {
        background: #0f172a;
        color: #f8fafc;
        border-radius: 14px;
        overflow: hidden;
    }
    .ai-test-header {
        background: #1e293b;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #334155;
    }
    .ai-test-thread {
        height: 280px;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .ai-test-msg {
        max-width: 85%;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 0.88rem;
        line-height: 1.5;
    }
    .ai-test-msg.user {
        align-self: flex-end;
        background: #0C4B36;
        color: #fff;
    }
    .ai-test-msg.bot {
        align-self: flex-start;
        background: #1e293b;
        color: #e2e8f0;
        border: 1px solid #334155;
    }
    .ai-test-footer {
        padding: 10px 14px;
        background: #1e293b;
        border-top: 1px solid #334155;
    }
    .nav-tabs-ai .nav-link {
        font-weight: 600;
        color: #64748b;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 18px;
    }
    .nav-tabs-ai .nav-link.active {
        color: #0C4B36;
        border-bottom-color: #0C4B36;
        background: transparent;
    }
    [data-theme="dark"] .nav-tabs-ai .nav-link.active {
        color: #38bdf8;
        border-bottom-color: #38bdf8;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3">

    <!-- Header & Breadcrumb -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">এআই সহকারী</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-robot text-success"></i> শুব্বান এআই সহকারী কন্ট্রোল সেন্টার
            </h1>
            <p class="text-secondary small mb-0">
                ওয়েবসাইটে আগত দর্শনার্থীদের স্বয়ংক্রিয় চ্যাট সেবা, নলেজ বেস প্রশ্নোত্তর ও এআই ইঞ্জিন পরিচালনা করুন।
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-success">
                <i class="fas fa-external-link-alt me-1"></i> লাইভ সাইটে টেস্ট করুন
            </a>
            <a href="{{ route('admin.ai-chat.knowledge.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-book-reader me-1"></i> নলেজ বেস ({{ $stats['total_knowledge'] }})
            </a>
            <a href="{{ route('admin.ai-chat.logs.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-history me-1"></i> চ্যাট হিস্ট্রি
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 4 Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card ai-stat-card p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">মোট কথোপকথন</span>
                        <h3 class="fw-bold mb-0 text-dark">{{ $stats['total_messages'] }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-primary-subtle text-primary">
                        <i class="fas fa-comments fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card ai-stat-card p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">আজকের অনুসন্ধান</span>
                        <h3 class="fw-bold mb-0 text-success">{{ $stats['today_messages'] }}</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-success-subtle text-success">
                        <i class="fas fa-calendar-day fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card ai-stat-card p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">নলেজ বেস Q&A</span>
                        <h3 class="fw-bold mb-0 text-info">{{ $stats['active_knowledge'] }} টি</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-info-subtle text-info">
                        <i class="fas fa-brain fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card ai-stat-card p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">ইতিবাচক প্রতিক্রিয়া</span>
                        <h3 class="fw-bold mb-0 text-warning">{{ $stats['helpful_count'] }} টি</h3>
                    </div>
                    <div class="rounded-circle p-3 bg-warning-subtle text-warning">
                        <i class="fas fa-thumbs-up fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Tabs -->
    <ul class="nav nav-tabs nav-tabs-ai mb-4" id="aiTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                <i class="fas fa-terminal me-1"></i> লাইভ টেস্ট কনসোল ও সাম্প্রতিক চ্যাট
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                <i class="fas fa-sliders-h me-1"></i> সেটিংস ও এআই ইঞ্জিন কনফিগারেশন
            </button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content" id="aiTabContent">

        <!-- TAB 1: Live Test Console & Recent Logs -->
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="row g-4">
                <!-- Left: Real-time Live Test Console -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                        <div class="card-header border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #072e20 0%, #0C4B36 100%);">
                            <span class="text-white fw-bold d-flex align-items-center">
                                <i class="fas fa-vial text-warning me-2"></i> রিয়েলটাইম এআই টেস্ট কনসোল
                            </span>
                            <span class="badge bg-warning text-dark">
                                ইঞ্জিন: {{ strtoupper($setting->ai_provider) }}
                            </span>
                        </div>
                        <div class="card-body p-3 p-md-4 d-flex flex-column">
                            <p class="text-secondary small mb-3">
                                দর্শনার্থীদের কাছে যাওয়ার আগেই বট কীভাবে উত্তর দিচ্ছে তা এখান থেকেই সরাসরি পরীক্ষা করুন:
                            </p>

                            <!-- Console Screen -->
                            <div class="ai-test-console flex-grow-1 d-flex flex-column">
                                <div class="ai-test-header">
                                    <span class="font-xs text-white-50"><i class="fas fa-circle text-success me-1"></i> শুব্বান ইন্টেলিজেন্ট ইঞ্জিন রেডি</span>
                                    <button type="button" class="btn btn-sm btn-link text-white-50 p-0 text-decoration-none font-xs" id="adminClearTestBtn">ক্লিয়ার</button>
                                </div>
                                <div class="ai-test-thread" id="adminTestThread">
                                    <div class="ai-test-msg bot">
                                        আসসালামু আলাইকুম! আমি শুব্বান এআই সহকারী। যেকোনো প্রশ্ন করে আমার বুদ্ধিমত্তা ও উত্তর পরীক্ষা করতে পারেন।
                                    </div>
                                </div>
                                <div class="ai-test-footer">
                                    <form id="adminTestForm" class="d-flex gap-2">
                                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="adminTestInput" placeholder="উদাঃ শুব্বানের লক্ষ্য কি? অথবা আরেফ সিলেবাস কি?" autocomplete="off">
                                        <button type="submit" class="btn btn-sm btn-success px-3" id="adminTestSubmitBtn">
                                            <i class="fas fa-paper-plane font-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Recent Visitor Queries -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                        <div class="card-header border-0 py-3 px-4 d-flex justify-content-between align-items-center bg-light">
                            <span class="fw-bold text-dark d-flex align-items-center">
                                <i class="fas fa-history text-primary me-2"></i> সাম্প্রতিক ভিজিটর প্রশ্ন ও উত্তর
                            </span>
                            <a href="{{ route('admin.ai-chat.logs.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 font-xs">
                                সকল হিস্ট্রি <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @forelse($recentLogs as $log)
                                    <div class="list-group-item p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge bg-light text-secondary border font-xs">
                                                <i class="far fa-clock me-1"></i> {{ $log->created_at->diffForHumans() }}
                                            </span>
                                            <div class="d-flex align-items-center gap-1">
                                                <span class="badge {{ $log->provider_used === 'internal' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }} font-xs">
                                                    {{ $log->provider_used }}
                                                </span>
                                                @if($log->was_helpful === true)
                                                    <span class="badge bg-success-subtle text-success font-xs" title="উপকারী ছিল"><i class="fas fa-thumbs-up"></i></span>
                                                @elseif($log->was_helpful === false)
                                                    <span class="badge bg-danger-subtle text-danger font-xs" title="উপকারী ছিল না"><i class="fas fa-thumbs-down"></i></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="fw-bold text-dark small mb-1">
                                            <i class="fas fa-user-circle text-primary me-1"></i> {{ $log->user_message }}
                                        </div>
                                        <div class="text-secondary font-xs bg-light p-2 rounded-2 text-truncate" style="max-height: 48px;">
                                            <i class="fas fa-robot text-success me-1"></i> {{ Str::limit($log->bot_response, 90) }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-muted">এখনো কোনো চ্যাট বার্তা রেকর্ড হয়নি।</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: Settings & Engine Configuration Form -->
        <div class="tab-pane fade" id="settings" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <form action="{{ route('admin.ai-chat.settings.update') }}" method="POST">
                    @csrf

                    <!-- Main Switch & Basic Information -->
                    <div class="row g-4 mb-4 pb-4 border-bottom">
                        <div class="col-12">
                            <h5 class="fw-bold text-dark mb-1"><i class="fas fa-toggle-on text-success me-2"></i> সাধারণ ও ডিসপ্লে সেটিংস</h5>
                            <p class="text-secondary small mb-0">ওয়েবসাইটে এআই চ্যাট সহকারীর সক্রিয়তা ও প্রাথমিক তথ্যাদি নির্ধারণ করুন।</p>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light border d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-check-label fw-bold text-dark" for="is_enabled">এআই চ্যাট সার্ভিস চালু রাখুন</label>
                                    <div class="font-xs text-muted">বন্ধ থাকলে দর্শনার্থীরা এআই চ্যাট উইজেট দেখতে পাবে না।</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_enabled" name="is_enabled" value="1" {{ $setting->is_enabled ? 'checked' : '' }} style="width: 2.8rem; height: 1.5rem;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light border d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-check-label fw-bold text-dark" for="enable_floating_widget">ভাসমান বাবল (Floating Bubble)</label>
                                    <div class="font-xs text-muted">স্ক্রিনের নিচে সর্বদা প্রদর্শিত হবে কিনা</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="enable_floating_widget" name="enable_floating_widget" value="1" {{ $setting->enable_floating_widget ? 'checked' : '' }} style="width: 2.8rem; height: 1.5rem;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">সহকারীর নাম (Bot Name) *</label>
                            <input type="text" name="bot_name" class="form-control" value="{{ old('bot_name', $setting->bot_name) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">সাবটাইটেল / স্ট্যাটাস টেক্সট</label>
                            <input type="text" name="bot_subtitle" class="form-control" value="{{ old('bot_subtitle', $setting->bot_subtitle) }}" placeholder="উদাঃ ২৪/৭ অনলাইন তথ্য ও দিকনির্দেশনা">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">উইজেটের অবস্থান (Position)</label>
                            <select name="widget_position" class="form-select">
                                <option value="bottom-right" {{ $setting->widget_position === 'bottom-right' ? 'selected' : '' }}>স্ক্রিনের নিচে ডানপাশে (ডিফল্ট)</option>
                                <option value="bottom-left" {{ $setting->widget_position === 'bottom-left' ? 'selected' : '' }}>স্ক্রিনের নিচে বামপাশে</option>
                            </select>
                        </div>
                    </div>

                    <!-- AI Provider & Engine Settings -->
                    <div class="row g-4 mb-4 pb-4 border-bottom">
                        <div class="col-12">
                            <h5 class="fw-bold text-dark mb-1"><i class="fas fa-brain text-primary me-2"></i> এআই ব্রেইন ও ইঞ্জিন নির্বাচন</h5>
                            <p class="text-secondary small mb-0">আপনি অন্তর্নির্মিত স্মার্ট নলেজবেস ব্যবহার করতে পারেন অথবা গুগল জেমিনাই / ওপেনএআই সংযুক্ত করতে পারেন।</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">এআই ইঞ্জিন মোড (Engine Mode) *</label>
                            <select name="ai_provider" id="aiProviderSelect" class="form-select">
                                <option value="internal" {{ $setting->ai_provider === 'internal' ? 'selected' : '' }}>
                                    ⚡ বিল্ট-ইন স্মার্ট ইঞ্জিন (ফ্রি, দ্রুত, অফলাইন)
                                </option>
                                <option value="gemini" {{ $setting->ai_provider === 'gemini' ? 'selected' : '' }}>
                                    ✨ গুগল জেমিনাই এআই (Google Gemini API)
                                </option>
                                <option value="openai" {{ $setting->ai_provider === 'openai' ? 'selected' : '' }}>
                                    🤖 ওপেনএআই চ্যাটজিপিটি (OpenAI GPT)
                                </option>
                            </select>
                            <div class="font-xs text-muted mt-1">
                                বিল্ট-ইন ইঞ্জিন কোনো এক্সটার্নাল এপিআই কী ছাড়াই সম্পূর্ণ নির্ভুল উত্তর প্রদান করে।
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">API Key (ঐচ্ছিক, যদি Gemini/OpenAI নির্বাচন করেন)</label>
                            <div class="input-group">
                                <input type="password" name="api_key" id="apiKeyInput" class="form-control" placeholder="{{ $setting->api_key ? '••••••••••••••••' : 'এপিআই কী পেস্ট করুন...' }}">
                                <button class="btn btn-outline-secondary" type="button" id="toggleApiKeyVisibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($setting->api_key)
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="clear_api_key" id="clear_api_key" value="1">
                                    <label class="form-check-label font-xs text-danger" for="clear_api_key">সংরক্ষিত API Key মুছে ফেলুন</label>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-dark">মডেল নাম (Model Name)</label>
                            <input type="text" name="model_name" class="form-control" value="{{ old('model_name', $setting->model_name) }}" placeholder="gemini-1.5-flash বা gpt-4o-mini">
                        </div>
                    </div>

                    <!-- Bot Messages & Persona -->
                    <div class="row g-4 mb-4 pb-4 border-bottom">
                        <div class="col-12">
                            <h5 class="fw-bold text-dark mb-1"><i class="fas fa-comment-dots text-warning me-2"></i> বার্তা ও আচরণ নির্দেশনা</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">স্বাগতম বার্তা (Welcome Message) *</label>
                            <textarea name="welcome_message" class="form-control" rows="3" required>{{ old('welcome_message', $setting->welcome_message) }}</textarea>
                            <div class="font-xs text-muted mt-1">চ্যাট উইজেট খোলার সাথে সাথে দর্শনার্থীকে এই বার্তাটি দেখানো হবে।</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">ফলব্যাক বার্তা (Fallback Message) *</label>
                            <textarea name="fallback_message" class="form-control" rows="3" required>{{ old('fallback_message', $setting->fallback_message) }}</textarea>
                            <div class="font-xs text-muted mt-1">প্রশ্নটির উত্তর জানা না থাকলে এআই এই বার্তাটি দিয়ে হেল্পলাইনে যোগাযোগ করতে বলবে।</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">কুইক প্রম্পট সাজেশন (প্রতি লাইনে একটি করে প্রশ্ন দিন)</label>
                            @php
                                $promptsText = is_array($setting->quick_prompts) ? implode("\n", $setting->quick_prompts) : '';
                            @endphp
                            <textarea name="quick_prompts_text" class="form-control" rows="4">{{ old('quick_prompts_text', $promptsText) }}</textarea>
                            <div class="font-xs text-muted mt-1">চ্যাটের শুরুতে রেডিমেড চিপ হিসেবে প্রদর্শিত হবে।</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark">সিস্টেম প্রম্পট / বটের নির্দেশিকা (System Prompt)</label>
                            <textarea name="system_prompt" class="form-control" rows="4">{{ old('system_prompt', $setting->system_prompt) }}</textarea>
                            <div class="font-xs text-muted mt-1">Gemini বা OpenAI-কে কীভাবে শুব্বানের প্রতিনিধিত্ব করতে হবে তার নির্দেশিকা।</div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2 shadow-sm">
                            <i class="fas fa-save me-1"></i> সেটিংস সংরক্ষণ করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // API Key visibility toggle
    const toggleKeyBtn = document.getElementById('toggleApiKeyVisibility');
    const keyInput = document.getElementById('apiKeyInput');
    if (toggleKeyBtn && keyInput) {
        toggleKeyBtn.addEventListener('click', function() {
            const isPassword = keyInput.type === 'password';
            keyInput.type = isPassword ? 'text' : 'password';
            toggleKeyBtn.innerHTML = isPassword ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });
    }

    // Admin Realtime Test Console
    const testForm = document.getElementById('adminTestForm');
    const testInput = document.getElementById('adminTestInput');
    const testThread = document.getElementById('adminTestThread');
    const clearTestBtn = document.getElementById('adminClearTestBtn');

    if (testForm) {
        testForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const q = testInput.value.trim();
            if (!q) return;

            // Append user msg
            const userMsg = document.createElement('div');
            userMsg.className = 'ai-test-msg user';
            userMsg.textContent = q;
            testThread.appendChild(userMsg);
            testInput.value = '';
            testThread.scrollTop = testThread.scrollHeight;

            // Append typing placeholder
            const botMsg = document.createElement('div');
            botMsg.className = 'ai-test-msg bot';
            botMsg.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> প্রসেসিং হচ্ছে...';
            testThread.appendChild(botMsg);
            testThread.scrollTop = testThread.scrollHeight;

            try {
                const res = await fetch('{{ route("admin.ai-chat.test") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: q })
                });
                const data = await res.json();
                botMsg.innerHTML = `<div>${(data.reply || 'কোনো উত্তর নেই').replace(/\n/g, '<br>')}</div><span class="badge bg-secondary font-xs mt-1">ইঞ্জিন: ${data.provider || 'unknown'}</span>`;
            } catch (err) {
                botMsg.textContent = 'টেস্টিং ত্রুটি: সার্ভারে যোগাযোগ ব্যর্থ।';
            }
            testThread.scrollTop = testThread.scrollHeight;
        });
    }

    if (clearTestBtn) {
        clearTestBtn.addEventListener('click', function() {
            testThread.innerHTML = '<div class="ai-test-msg bot">কনসোল রিসেট করা হয়েছে। আপনার নতুন প্রশ্ন লিখুন।</div>';
        });
    }
});
</script>
@endpush
