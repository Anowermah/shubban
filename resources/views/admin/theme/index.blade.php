@extends('admin.layouts.app')

@section('title', 'কালার থিম ও নাইট/ডে মোড ম্যানেজার')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header Box -->
    <div class="page-header-box d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill">
                    <i class="fas fa-palette me-1"></i> ব্র্যান্ড ও অ্যাপিয়ারেন্স
                </span>
                <span class="text-muted small">ওয়েবসাইটের রং ও নাইট/ডে ডিসপ্লে মোড পরিচালনা</span>
            </div>
            <h1 class="h3 fw-bold mb-0 text-dark">কালার থিম ও নাইট/ডে মোড ম্যানেজার</h1>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-success rounded-pill px-3 py-2">
                <i class="fas fa-external-link-alt me-1"></i> মূল সাইট দেখুন
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> নিচের ত্রুটিগুলো সংশোধন করুন:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.theme.update') }}">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Left Column: Preset Themes & Color Config (8 Cols) -->
            <div class="col-lg-8">
                <!-- 1. Preset Themes Selection -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold"><i class="fas fa-swatchbook text-primary me-2"></i>প্রিসেট কালার থিম নির্বাচন করুন</span>
                        <small class="text-muted">ক্লিক করলেই নিচে প্রিভিউ ও কোড পরিবর্তিত হবে</small>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($presets as $key => $preset)
                                <div class="col-sm-6 col-md-4">
                                    <div class="theme-preset-card p-3 rounded-3 border h-100 cursor-pointer position-relative {{ ($settings->color_theme ?? 'emerald') === $key ? 'active-preset' : '' }}" 
                                         onclick="selectPreset('{{ $key }}', '{{ $preset['primary'] }}', '{{ $preset['accent'] }}')">
                                        <!-- Radio -->
                                        <div class="form-check position-absolute top-0 end-0 m-2">
                                            <input class="form-check-input" type="radio" name="color_theme" id="theme_{{ $key }}" value="{{ $key }}" {{ ($settings->color_theme ?? 'emerald') === $key ? 'checked' : '' }}>
                                        </div>

                                        <!-- Swatch Dots -->
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="color-dot rounded-circle shadow-sm" style="background-color: {{ $preset['primary'] }}; width: 28px; height: 28px; display: inline-block;"></span>
                                            <span class="color-dot rounded-circle shadow-sm" style="background-color: {{ $preset['accent'] }}; width: 20px; height: 20px; display: inline-block;"></span>
                                        </div>

                                        <h6 class="fw-bold mb-1 text-dark" style="font-size: 0.92rem;">{{ $preset['name'] }}</h6>
                                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">{{ $preset['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 2. Custom Color Customizer -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <span class="fw-bold"><i class="fas fa-sliders-h text-primary me-2"></i>কাস্টম কালার কোড ও ফাইন টিউনিং</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <!-- Primary Color Picker -->
                            <div class="col-md-6">
                                <label for="primary_color" class="form-label fw-bold">প্রাইমারি ব্র্যান্ড কালার (Primary Color):</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color" id="primaryColorPicker" value="{{ $settings->primary_color ?? '#0C4B36' }}" title="কালার নির্বাচন করুন" onchange="updateFromPicker('primary', this.value)">
                                    <input type="text" name="primary_color" id="primaryColorText" class="form-control font-monospace text-uppercase" value="{{ $settings->primary_color ?? '#0C4B36' }}" required onkeyup="updateFromText('primary', this.value)">
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">টপবার, হেডিং, প্রধান বাটন ও ব্র্যান্ড হাইলাইটের জন্য ব্যবহৃত হয়।</small>
                            </div>

                            <!-- Accent Color Picker -->
                            <div class="col-md-6">
                                <label for="accent_color" class="form-label fw-bold">একসেন্ট ও গোল্ড কালার (Accent Color):</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color" id="accentColorPicker" value="{{ $settings->accent_color ?? '#FBB040' }}" title="কালার নির্বাচন করুন" onchange="updateFromPicker('accent', this.value)">
                                    <input type="text" name="accent_color" id="accentColorText" class="form-control font-monospace text-uppercase" value="{{ $settings->accent_color ?? '#FBB040' }}" required onkeyup="updateFromText('accent', this.value)">
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">ব্যাজ, বর্ডার হাইলাইট, স্টার ও অ্যাক্টিভ বাটন আভার জন্য ব্যবহৃত হয়।</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Night / Day Mode Settings -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <span class="fw-bold"><i class="fas fa-moon text-warning me-2"></i>নাইট ও ডে মোড কনফিগারেশন (Night / Day Display)</span>
                    </div>
                    <div class="card-body p-4">
                        <!-- Default Mode -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">সাইটের ডিফল্ট ডিসপ্লে মোড:</label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="display-mode-card p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer w-100 {{ ($settings->default_mode ?? 'light') === 'light' ? 'active-mode' : '' }}">
                                        <input type="radio" name="default_mode" value="light" {{ ($settings->default_mode ?? 'light') === 'light' ? 'checked' : '' }} class="form-check-input mt-0">
                                        <div>
                                            <div class="fw-bold text-dark"><i class="fas fa-sun text-warning me-1"></i> ডে মোড (Light)</div>
                                            <small class="text-muted">উজ্জ্বল ও সাদা ব্যাকগ্রাউন্ড</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="display-mode-card p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer w-100 {{ ($settings->default_mode ?? 'light') === 'dark' ? 'active-mode' : '' }}">
                                        <input type="radio" name="default_mode" value="dark" {{ ($settings->default_mode ?? 'light') === 'dark' ? 'checked' : '' }} class="form-check-input mt-0">
                                        <div>
                                            <div class="fw-bold text-dark"><i class="fas fa-moon text-primary me-1"></i> নাইট মোড (Dark)</div>
                                            <small class="text-muted">চোখের জন্য আরামদায়ক ডার্ক</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="display-mode-card p-3 rounded-3 border d-flex align-items-center gap-3 cursor-pointer w-100 {{ ($settings->default_mode ?? 'light') === 'auto' ? 'active-mode' : '' }}">
                                        <input type="radio" name="default_mode" value="auto" {{ ($settings->default_mode ?? 'light') === 'auto' ? 'checked' : '' }} class="form-check-input mt-0">
                                        <div>
                                            <div class="fw-bold text-dark"><i class="fas fa-adjust text-info me-1"></i> সিস্টেম অটো (Auto)</div>
                                            <small class="text-muted">ব্যবহারকারীর ডিভাইসের সাথে মিলবে</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Public Switcher Toggle Checkbox -->
                        <div class="form-check form-switch p-3 bg-light rounded-3 border">
                            <input class="form-check-input ms-0 me-3" type="checkbox" name="enable_theme_switcher" id="enable_theme_switcher" value="1" {{ ($settings->enable_theme_switcher ?? true) ? 'checked' : '' }} style="width: 2.25em; height: 1.25em;">
                            <label class="form-check-label fw-bold text-dark" for="enable_theme_switcher">
                                পাবলিক ওয়েবসাইটে নাইট/ডে মোড সুইচার বাটন চালু রাখুন
                            </label>
                            <small class="d-block text-muted mt-1 ms-5">চালু থাকলে ভিজিটররা সাইটের হেডার বা মোবাইল মেনু থেকে ইচ্ছেমতো নাইট/ডে মোড পরিবর্তন করতে পারবেন।</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Live Interactive Preview & Save (4 Cols) -->
            <div class="col-lg-4">
                <!-- Save Button Card -->
                <div class="card shadow-sm mb-4 border-primary">
                    <div class="card-body p-4 text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 w-100 fw-bold shadow">
                            <i class="fas fa-save me-2"></i> থিম ও সেটিংস সংরক্ষণ করুন
                        </button>
                        <small class="d-block text-muted mt-2">সংরক্ষণ করার পর তাৎক্ষণিকভাবে সম্পূর্ণ ওয়েবসাইটে নতুন থিম কার্যকর হবে।</small>
                    </div>
                </div>

                <!-- Live Component Preview Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <span class="fw-bold"><i class="fas fa-eye text-primary me-2"></i>লাইভ উপাদান প্রিভিউ</span>
                    </div>
                    <div class="card-body p-4" id="livePreviewBox">
                        <!-- Preview Navbar -->
                        <div class="p-3 rounded-3 text-white mb-3 d-flex align-items-center justify-content-between" id="previewNavbar" style="background: {{ $settings->primary_color ?? '#0C4B36' }};">
                            <span class="fw-bold small">শুব্বান বাংলাদেশ</span>
                            <span class="badge rounded-pill" id="previewBadge" style="background: {{ $settings->accent_color ?? '#FBB040' }}; color: #07281d;">সক্রিয় থিম</span>
                        </div>

                        <!-- Preview Buttons -->
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button type="button" class="btn btn-sm text-white rounded-pill px-3" id="previewBtnPrimary" style="background: {{ $settings->primary_color ?? '#0C4B36' }};">
                                প্রাইমারি বাটন
                            </button>
                            <button type="button" class="btn btn-sm rounded-pill px-3 fw-bold" id="previewBtnAccent" style="background: {{ $settings->accent_color ?? '#FBB040' }}; color: #07281d;">
                                একসেন্ট বাটন
                            </button>
                        </div>

                        <!-- Preview Alert Card -->
                        <div class="p-3 rounded-3 border-start border-4 bg-light small mb-0" id="previewCallout" style="border-left-color: {{ $settings->primary_color ?? '#0C4B36' }} !important;">
                            <div class="fw-bold text-dark mb-1">নমুনা নোটিশ বা প্রবন্ধ শিরোনাম</div>
                            <p class="text-muted mb-0" style="font-size: 0.78rem;">কালেমা লা-ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসুলুল্লাহর আলোকে পরিচালিত যুব আন্দোলন।</p>
                        </div>
                    </div>
                </div>

                <!-- Mode Quick Test Widget -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <span class="fw-bold"><i class="fas fa-magic text-warning me-2"></i>তাৎক্ষণিক টেস্ট</span>
                    </div>
                    <div class="card-body p-3 text-center">
                        <p class="text-muted small mb-3">নিচের বাটনে ক্লিক করে এখনই এই অ্যাডমিন পেজে নাইট মোড টেস্ট করে দেখতে পারেন:</p>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3" onclick="toggleTestTheme()">
                            <i class="fas fa-adjust me-1"></i> নাইট / ডে মোড টগল করুন
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
.theme-preset-card {
    transition: all 0.25s ease;
    background: #ffffff;
}
.theme-preset-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
}
.theme-preset-card.active-preset {
    border-color: var(--admin-primary) !important;
    background: #f0fdf4 !important;
    box-shadow: 0 0 0 2px var(--admin-accent);
}
.display-mode-card {
    transition: all 0.2s ease;
    background: #ffffff;
}
.display-mode-card:hover {
    border-color: var(--admin-primary) !important;
}
.display-mode-card.active-mode {
    border-color: var(--admin-primary) !important;
    background: #f0fdf4 !important;
    box-shadow: 0 0 0 2px var(--admin-accent);
}
.cursor-pointer {
    cursor: pointer;
}
</style>
@endpush

@push('scripts')
<script>
function selectPreset(key, primary, accent) {
    // Select radio
    const radio = document.getElementById('theme_' + key);
    if (radio) radio.checked = true;

    // Remove active class from all preset cards
    document.querySelectorAll('.theme-preset-card').forEach(card => card.classList.remove('active-preset'));
    if (radio) {
        const card = radio.closest('.theme-preset-card');
        if (card) card.classList.add('active-preset');
    }

    // Update pickers and inputs
    document.getElementById('primaryColorPicker').value = primary;
    document.getElementById('primaryColorText').value = primary.toUpperCase();

    document.getElementById('accentColorPicker').value = accent;
    document.getElementById('accentColorText').value = accent.toUpperCase();

    updatePreview(primary, accent);
}

function updateFromPicker(type, value) {
    if (type === 'primary') {
        document.getElementById('primaryColorText').value = value.toUpperCase();
    } else {
        document.getElementById('accentColorText').value = value.toUpperCase();
    }
    uncheckPresets();
    updatePreview(document.getElementById('primaryColorText').value, document.getElementById('accentColorText').value);
}

function updateFromText(type, value) {
    if (/^#[0-9A-F]{6}$/i.test(value)) {
        if (type === 'primary') {
            document.getElementById('primaryColorPicker').value = value;
        } else {
            document.getElementById('accentColorPicker').value = value;
        }
        uncheckPresets();
        updatePreview(document.getElementById('primaryColorText').value, document.getElementById('accentColorText').value);
    }
}

function uncheckPresets() {
    document.querySelectorAll('.theme-preset-card').forEach(card => card.classList.remove('active-preset'));
}

function updatePreview(primary, accent) {
    const navbar = document.getElementById('previewNavbar');
    const badge = document.getElementById('previewBadge');
    const btnPrimary = document.getElementById('previewBtnPrimary');
    const btnAccent = document.getElementById('previewBtnAccent');
    const callout = document.getElementById('previewCallout');

    if (navbar) navbar.style.background = primary;
    if (badge) {
        badge.style.background = accent;
    }
    if (btnPrimary) btnPrimary.style.background = primary;
    if (btnAccent) {
        btnAccent.style.background = accent;
    }
    if (callout) callout.style.borderLeftColor = primary;
}

function toggleTestTheme() {
    const current = document.documentElement.getAttribute('data-bs-theme');
    const newTheme = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme', newTheme);
    document.body.setAttribute('data-theme', newTheme);
}
</script>
@endpush
@endsection
