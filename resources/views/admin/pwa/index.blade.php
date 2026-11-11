@extends('admin.layouts.app')

@section('title', 'পিডব্লিউএ (PWA) কন্ট্রোল সেন্টার')

@push('styles')
<style>
    .pwa-stat-badge {
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 20px;
    }
    .pwa-health-card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        background: #ffffff;
        transition: transform 0.2s ease;
    }
    .pwa-health-card:hover {
        transform: translateY(-2px);
    }
    .nav-tabs-pwa .nav-link {
        font-weight: 600;
        color: #64748b;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 18px;
    }
    .nav-tabs-pwa .nav-link.active {
        color: #0C4B36;
        border-bottom-color: #0C4B36;
        background: transparent;
    }
    [data-theme="dark"] .nav-tabs-pwa .nav-link.active {
        color: #38bdf8;
        border-bottom-color: #38bdf8;
    }
    /* Phone Mockup Preview */
    .phone-mockup-wrap {
        width: 260px;
        height: 520px;
        border: 10px solid #1e293b;
        border-radius: 36px;
        background: #072e20;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
    }
    .phone-speaker {
        width: 60px;
        height: 5px;
        background: #334155;
        border-radius: 4px;
        margin: 10px auto 14px;
    }
    .phone-screen {
        padding: 14px;
        color: #ffffff;
        text-align: center;
    }
    .phone-app-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: #0C4B36;
        margin: 40px auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        border: 2px solid #FBB040;
        padding: 6px;
    }
    .phone-app-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
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
                    <li class="breadcrumb-item active" aria-current="page">পিডব্লিউএ (PWA) কন্ট্রোল</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-mobile-alt text-success"></i> প্রগ্রেসিভ ওয়েব অ্যাপ (PWA) কন্ট্রোল সেন্টার
            </h1>
            <p class="text-secondary small mb-0">
                মোবাইল ও ডেস্কটপ ইনস্টলেশন, ম্যানিফেস্ট মেটাডাটা, আইকন জেনারেশন, অফলাইন পেজ এবং সার্ভিস ওয়ার্কার পরিচালনা করুন।
            </p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <form action="{{ route('admin.pwa.bump-cache') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm fw-semibold text-dark" title="সকল গ্রাহক ও ডিভাইসের ক্যাশ ফোর্স আপডেট করুন">
                    <i class="fas fa-sync-alt me-1"></i> ক্যাশ আপডেট ({{ $pwa->cache_version }})
                </button>
            </form>
            <form action="{{ route('admin.pwa.regenerate-icons') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-icons me-1"></i> আইকন রি-জেনারেট
                </button>
            </form>
            <form action="{{ route('admin.pwa.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে পিডব্লিউএ কনফিগারেশন ডিফল্ট সেটিংসে রিসেট করতে চান?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-undo me-1"></i> রিসেট
                </button>
            </form>
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

    <!-- PWA Health Audit & System Checklist -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card pwa-health-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">ওয়েব ম্যানিফেস্ট</span>
                        <h6 class="fw-bold mb-0 {{ $health['manifest_ok'] ? 'text-success' : 'text-danger' }}">
                            <i class="fas {{ $health['manifest_ok'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-1"></i>
                            {{ $health['manifest_ok'] ? 'সঠিক ও কার্যকর' : 'ত্রুটি' }}
                        </h6>
                    </div>
                    <a href="/manifest.json" target="_blank" class="badge bg-light text-primary border text-decoration-none">
                        JSON <i class="fas fa-external-link-alt font-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card pwa-health-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">সার্ভিস ওয়ার্কার</span>
                        <h6 class="fw-bold mb-0 {{ $health['sw_ok'] ? 'text-success' : 'text-danger' }}">
                            <i class="fas {{ $health['sw_ok'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-1"></i>
                            {{ $health['sw_ok'] ? 'ক্যাশিং সক্রিয়' : 'অনুপস্থিত' }}
                        </h6>
                    </div>
                    <a href="/sw.js" target="_blank" class="badge bg-light text-success border text-decoration-none">
                        sw.js <i class="fas fa-external-link-alt font-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card pwa-health-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">অফলাইন ফলব্যাক</span>
                        <h6 class="fw-bold mb-0 {{ $health['offline_ok'] ? 'text-success' : 'text-danger' }}">
                            <i class="fas {{ $health['offline_ok'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-1"></i>
                            {{ $health['offline_ok'] ? 'অফলাইন রেডি' : 'অনুপস্থিত' }}
                        </h6>
                    </div>
                    <a href="/offline.html" target="_blank" class="badge bg-light text-warning-emphasis border text-decoration-none">
                        ভিউ <i class="fas fa-external-link-alt font-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card pwa-health-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-secondary small fw-semibold">আইকন ও মাস্কেবল</span>
                        <h6 class="fw-bold mb-0 {{ $health['icons_ok'] ? 'text-success' : 'text-danger' }}">
                            <i class="fas {{ $health['icons_ok'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-1"></i>
                            {{ $health['icons_ok'] ? '১০টি সাইজ প্রস্তুত' : 'মিসিং' }}
                        </h6>
                    </div>
                    <span class="badge bg-success-subtle text-success">Android & iOS</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Configuration Form with Tabs -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4">
                
                <ul class="nav nav-tabs nav-tabs-pwa mb-4" id="pwaTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="identity-tab" data-bs-toggle="tab" data-bs-target="#tab-identity" type="button">
                            <i class="fas fa-id-card me-1"></i> অ্যাপ পরিচয় ও ব্র্যান্ডিং
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="display-tab" data-bs-toggle="tab" data-bs-target="#tab-display" type="button">
                            <i class="fas fa-tv me-1"></i> ডিসপ্লে ও ওরিয়েন্টেশন
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="banner-tab" data-bs-toggle="tab" data-bs-target="#tab-banner" type="button">
                            <i class="fas fa-download me-1"></i> ইনস্টল প্রম্পট ব্যানার
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="shortcuts-tab" data-bs-toggle="tab" data-bs-target="#tab-shortcuts" type="button">
                            <i class="fas fa-external-link-square-alt me-1"></i> কুইক শর্টকাট মেনু
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="offline-tab" data-bs-toggle="tab" data-bs-target="#tab-offline" type="button">
                            <i class="fas fa-wifi me-1"></i> অফলাইন পেজ সেটিংস
                        </button>
                    </li>
                </ul>

                <form action="{{ route('admin.pwa.update') }}" method="POST" enctype="multipart/form-data" id="pwaConfigForm">
                    @csrf

                    <div class="tab-content" id="pwaTabContent">
                        
                        <!-- TAB 1: App Identity & Branding -->
                        <div class="tab-pane fade show active" id="tab-identity">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <label class="form-check-label fw-bold text-dark" for="is_enabled">পিডব্লিউএ (PWA) সার্ভিস সক্রিয় রাখুন</label>
                                            <div class="font-xs text-muted">সক্রিয় থাকলে সার্ভিস ওয়ার্কার, অফলাইন মোড ও ইনস্টলেশন প্রম্পট কার্যকর থাকবে।</div>
                                        </div>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_enabled" name="is_enabled" value="1" {{ $pwa->is_enabled ? 'checked' : '' }} style="width: 2.8rem; height: 1.5rem;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <label class="form-label fw-semibold small text-dark">অ্যাপের পূর্ণ নাম (App Full Name) *</label>
                                    <input type="text" name="app_name" class="form-control" value="{{ old('app_name', $pwa->app_name) }}" required>
                                    <div class="font-xs text-muted">ইনস্টলেশনের সময় ও টাইটেল বারে প্রদর্শিত হবে।</div>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label fw-semibold small text-dark">সংক্ষিপ্ত নাম (Short Name) *</label>
                                    <input type="text" name="app_short_name" class="form-control" value="{{ old('app_short_name', $pwa->app_short_name) }}" required>
                                    <div class="font-xs text-muted">মোবাইলের হোমস্ক্রিন আইকনের নিচে প্রদর্শিত হবে।</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">অ্যাপের সংক্ষিপ্ত বর্ণনা (Description)</label>
                                    <textarea name="app_description" class="form-control" rows="2">{{ old('app_description', $pwa->app_description) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">থিম কালার (Theme Color / Status Bar) *</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="themeColorPicker" value="{{ $pwa->theme_color }}" title="রং নির্বাচন করুন" onchange="document.getElementById('themeColorText').value = this.value;">
                                        <input type="text" name="theme_color" id="themeColorText" class="form-control" value="{{ old('theme_color', $pwa->theme_color) }}" required onkeyup="document.getElementById('themeColorPicker').value = this.value;">
                                    </div>
                                    <div class="font-xs text-muted">মোবাইলের উপরের স্ট্যাটাস বার ও টাইটেল বারের রং।</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">স্প্ল্যাশ স্ক্রিন ব্যাকগ্রাউন্ড (Background Color) *</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="bgColorPicker" value="{{ $pwa->background_color }}" title="রং নির্বাচন করুন" onchange="document.getElementById('bgColorText').value = this.value;">
                                        <input type="text" name="background_color" id="bgColorText" class="form-control" value="{{ old('background_color', $pwa->background_color) }}" required onkeyup="document.getElementById('bgColorPicker').value = this.value;">
                                    </div>
                                    <div class="font-xs text-muted">অ্যাপ ওপেন হওয়ার সময় স্প্ল্যাশ স্ক্রিনের পটভূমির রং।</div>
                                </div>

                                <div class="col-12 border-top pt-3 mt-2">
                                    <label class="form-label fw-semibold small text-dark">নতুন কাস্টম অ্যাপ আইকন আপলোড করুন (ঐচ্ছিক)</label>
                                    <input type="file" name="app_icon" class="form-control" accept="image/png,image/jpeg">
                                    <div class="font-xs text-muted mt-1">
                                        বর্গাকার পিএনজি (কমপক্ষে ৫১২x৫১২ পিক্সেল) আপলোড করলে স্বয়ংক্রিয়ভাবে ৭২ থেকে ৫১২ পিক্সেল ও মাস্কেবল আইকন জেনারেট হয়ে যাবে।
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: Display & Startup -->
                        <div class="tab-pane fade" id="tab-display">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">স্টার্ট ইউআরএল (Start URL) *</label>
                                    <input type="text" name="start_url" class="form-control" value="{{ old('start_url', $pwa->start_url) }}" required>
                                    <div class="font-xs text-muted">অ্যাপ ওপেন হওয়ামাত্র কোন পাতায় ঢুকবে (উদাঃ <code>/?source=pwa</code> বা <code>/notice</code>)</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">ডিসপ্লে মোড (Display Mode) *</label>
                                    <select name="display_mode" class="form-select">
                                        <option value="standalone" {{ $pwa->display_mode === 'standalone' ? 'selected' : '' }}>
                                            Standalone (প্রস্তাবিত: ১০০% নেটিভ অ্যাপের মতো অ্যাড্রেস বার ছাড়া)
                                        </option>
                                        <option value="fullscreen" {{ $pwa->display_mode === 'fullscreen' ? 'selected' : '' }}>
                                            Fullscreen (সম্পূর্ণ ফুলস্ক্রিন)
                                        </option>
                                        <option value="minimal-ui" {{ $pwa->display_mode === 'minimal-ui' ? 'selected' : '' }}>
                                            Minimal-UI (ন্যূনতম ব্যাক বাটনসহ)
                                        </option>
                                        <option value="browser" {{ $pwa->display_mode === 'browser' ? 'selected' : '' }}>
                                            Browser (স্বাভাবিক ব্রাউজার ট্যাব)
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">স্ক্রিন ওরিয়েন্টেশন (Orientation) *</label>
                                    <select name="orientation" class="form-select">
                                        <option value="portrait-primary" {{ $pwa->orientation === 'portrait-primary' ? 'selected' : '' }}>
                                            Portrait Primary (লম্বালম্বি - ডিফল্ট)
                                        </option>
                                        <option value="any" {{ $pwa->orientation === 'any' ? 'selected' : '' }}>
                                            Any (লম্বালম্বি ও আড়াআড়ি উভয়ই)
                                        </option>
                                        <option value="landscape" {{ $pwa->orientation === 'landscape' ? 'selected' : '' }}>
                                            Landscape (আড়াআড়ি)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: Install Prompt Banner -->
                        <div class="tab-pane fade" id="tab-banner">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="p-3 rounded-3 bg-light border d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <label class="form-check-label fw-bold text-dark" for="enable_install_banner">ইনস্টল ব্যানার প্রম্পট চালু রাখুন</label>
                                            <div class="font-xs text-muted">ভিজিটর ওয়েবসাইট ব্রাউজ করার সময় স্বয়ংক্রিয়ভাবে অ্যাপ ইনস্টল করার আমন্ত্রণ জানাবে।</div>
                                        </div>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" role="switch" id="enable_install_banner" name="enable_install_banner" value="1" {{ $pwa->enable_install_banner ? 'checked' : '' }} style="width: 2.8rem; height: 1.5rem;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">ব্যানার শিরোনাম (Title) *</label>
                                    <input type="text" name="banner_title" class="form-control" value="{{ old('banner_title', $pwa->banner_title) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">ব্যানার বিবরণ (Subtitle)</label>
                                    <input type="text" name="banner_subtitle" class="form-control" value="{{ old('banner_subtitle', $pwa->banner_subtitle) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small text-dark">ইনস্টল বাটন টেক্সট *</label>
                                    <input type="text" name="banner_btn_text" class="form-control" value="{{ old('banner_btn_text', $pwa->banner_btn_text) }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small text-dark">ডিসপ্লে ডিলে (সেকেন্ড)</label>
                                    <input type="number" name="banner_delay" class="form-control" value="{{ old('banner_delay', $pwa->banner_delay) }}" min="0" max="60">
                                    <div class="font-xs text-muted">পেজ লোড হওয়ার কত সেকেন্ড পর ব্যানার উঠবে।</div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small text-dark">পুনরায় দেখানোর ব্যবধান (দিন)</label>
                                    <input type="number" name="banner_dismiss_days" class="form-control" value="{{ old('banner_dismiss_days', $pwa->banner_dismiss_days) }}" min="1" max="90">
                                    <div class="font-xs text-muted">একবার ক্রস চাপলে কতদিন পর আবার ব্যানার আসবে।</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: Shortcuts Manager -->
                        <div class="tab-pane fade" id="tab-shortcuts">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">অ্যাপ আইকন লং-প্রেস শর্টকাট</h6>
                                    <div class="font-xs text-muted">মোবাইলে অ্যাপ আইকনে চেপে ধরে রাখলে এই কুইক লিংকগুলো প্রদর্শিত হয়।</div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">সক্রিয়</th>
                                            <th>শর্টকাট নাম</th>
                                            <th>সংক্ষিপ্ত নাম</th>
                                            <th>টার্গেট লিঙ্ক (URL)</th>
                                            <th>বিবরণ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="shortcutsTableBody">
                                        @php
                                            $shortcuts = $pwa->shortcuts ?: \App\Models\PwaSetting::defaultShortcuts();
                                        @endphp
                                        @foreach($shortcuts as $idx => $sc)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" name="shortcuts[{{ $idx }}][is_active]" value="1" {{ !isset($sc['is_active']) || $sc['is_active'] ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <input type="text" name="shortcuts[{{ $idx }}][name]" class="form-control form-control-sm" value="{{ $sc['name'] ?? '' }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="shortcuts[{{ $idx }}][short_name]" class="form-control form-control-sm" value="{{ $sc['short_name'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="shortcuts[{{ $idx }}][url]" class="form-control form-control-sm" value="{{ $sc['url'] ?? '' }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="shortcuts[{{ $idx }}][description]" class="form-control form-control-sm" value="{{ $sc['description'] ?? '' }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 5: Offline Page Settings -->
                        <div class="tab-pane fade" id="tab-offline">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center gap-2">
                                        <i class="fas fa-info-circle fs-5"></i>
                                        <div class="small">ব্যবহারকারীর ডিভাইসে ইন্টারনেট সংযোগ না থাকলে এই পেজটি স্বয়ংক্রিয়ভাবে সার্ভিস ওয়ার্কার থেকে প্রদর্শিত হবে।</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">অফলাইন পেজের মূল শিরোনাম *</label>
                                    <input type="text" name="offline_title" class="form-control" value="{{ old('offline_title', $pwa->offline_title) }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">অফলাইন বার্তা / বিবরণ *</label>
                                    <textarea name="offline_message" class="form-control" rows="3">{{ old('offline_message', $pwa->offline_message) }}</textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="/offline.html" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-external-link-alt me-1"></i> লাইভ অফলাইন পেজ প্রিভিউ দেখুন
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Actions -->
                    <div class="border-top pt-4 mt-4 text-end">
                        <button type="submit" class="btn btn-success fw-bold px-4 shadow-sm">
                            <i class="fas fa-save me-1"></i> PWA সেটিংস সংরক্ষণ করুন
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Right Side: Phone Device Live Mockup Simulator -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4 text-center">
                <h6 class="fw-bold text-dark mb-1 d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-mobile-alt text-warning"></i> মোবাইল প্রিভিউ সিমুলেটর
                </h6>
                <p class="text-secondary font-xs mb-3">হোমস্ক্রিন ও অ্যাপ স্টাইল লাইভ প্রিভিউ</p>

                <!-- Phone Device Frame -->
                <div class="phone-mockup-wrap" style="background: {{ $pwa->background_color }};">
                    <div class="phone-speaker"></div>
                    
                    <div class="phone-screen">
                        <!-- Top status bar mock -->
                        <div class="d-flex justify-content-between align-items-center px-2 font-xs text-white-50 mb-4">
                            <span>10:30 AM</span>
                            <div class="d-flex gap-1">
                                <i class="fas fa-wifi font-xs"></i>
                                <i class="fas fa-battery-full font-xs"></i>
                            </div>
                        </div>

                        <!-- App Icon on Home Screen -->
                        <div class="phone-app-icon" style="background: {{ $pwa->theme_color }};">
                            <img src="/icons/icon-96x96.png" alt="App Icon">
                        </div>
                        <div class="fw-bold text-white fs-6 mb-1">{{ $pwa->app_short_name }}</div>
                        <span class="badge bg-warning text-dark font-xs">PWA Standalone</span>

                        <!-- Mock Install Prompt Card on screen -->
                        <div class="p-2 bg-white rounded-3 mt-4 text-start shadow-sm mx-1">
                            <div class="d-flex align-items-center gap-2">
                                <img src="/icons/icon-72x72.png" style="width: 28px; height: 28px; border-radius: 6px;">
                                <div>
                                    <div class="fw-bold text-dark font-xs">{{ $pwa->banner_title }}</div>
                                    <div class="text-muted" style="font-size: 0.65rem;">{{ Str::limit($pwa->banner_subtitle, 30) }}</div>
                                </div>
                            </div>
                            <div class="text-end mt-1">
                                <span class="badge bg-success" style="font-size: 0.65rem;">{{ $pwa->banner_btn_text }}</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 font-xs text-white-50">
                            ক্যাশ ভার্সন: <span class="text-warning">{{ $pwa->cache_version }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-external-link-alt me-1"></i> ব্রাউজারে অ্যাপ ইনস্টল টেস্ট
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
