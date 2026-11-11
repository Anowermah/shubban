@extends('layouts.app')

@section('title', 'কর্মী ও দায়িত্বশীল ড্যাশবোর্ড - জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')

@push('styles')
<style>
    .user-dashboard-wrap {
        background: #f4f7f5;
        min-height: calc(100vh - 200px);
        padding: 35px 0 60px;
    }
    .user-hero-card {
        background: linear-gradient(135deg, #06261a 0%, #0C4B36 50%, #135d43 100%);
        color: #ffffff;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(12, 75, 54, 0.18);
        margin-bottom: 25px;
    }
    .user-hero-card::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FBB040 0%, #f7d070 100%);
    }
    .user-avatar-circle {
        width: 80px;
        height: 80px;
        background: #FBB040;
        color: #0C4B36;
        font-size: 2.2rem;
        font-weight: 700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
        flex-shrink: 0;
    }
    .user-hero-name {
        font-size: 1.65rem;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }
    .tier-badge {
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .stat-card-org {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid rgba(12, 75, 54, 0.08);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .stat-card-org:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(12, 75, 54, 0.08);
    }
    .stat-org-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }
    .stat-org-icon.gold { background: #fff8e7; color: #d99014; }
    .stat-org-icon.green { background: #e8f5ed; color: #0C4B36; }
    .stat-org-icon.blue { background: #e6f2fa; color: #1565c0; }
    .stat-org-icon.purple { background: #f3e8fa; color: #7b1fa2; }
    
    .dash-sidebar-nav {
        background: #ffffff;
        border-radius: 18px;
        padding: 15px;
        border: 1px solid rgba(12, 75, 54, 0.08);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        position: sticky;
        top: 20px;
    }
    .dash-nav-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        color: #3e4d46;
        font-weight: 500;
        font-size: 0.92rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
        margin-bottom: 6px;
    }
    .dash-nav-btn:hover {
        background: #f0f6f2;
        color: #0C4B36;
    }
    .dash-nav-btn.active {
        background: #0C4B36;
        color: #ffffff;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(12, 75, 54, 0.2);
    }
    .dash-nav-btn i {
        font-size: 1.1rem;
        width: 22px;
        text-align: center;
    }
    .dash-content-pane {
        background: #ffffff;
        border-radius: 18px;
        padding: 30px;
        border: 1px solid rgba(12, 75, 54, 0.08);
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .pane-header-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0C4B36;
        margin-bottom: 22px;
        padding-bottom: 14px;
        border-bottom: 2px solid #edf3f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: gap;
    }
    .syllabus-card {
        background: #fbfdfc;
        border: 1px solid #e1ebe5;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 14px;
        transition: all 0.2s ease;
    }
    .syllabus-card:hover {
        border-color: #0C4B36;
        box-shadow: 0 4px 15px rgba(12, 75, 54, 0.05);
    }
    .book-mini-card {
        background: #ffffff;
        border: 1px solid #e2ece6;
        border-radius: 12px;
        padding: 14px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .progress-bar-custom {
        height: 10px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.25);
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #FBB040 0%, #ffe082 100%);
        border-radius: 10px;
        transition: width 0.6s ease;
    }
</style>
@endpush

@section('content')
<div class="user-dashboard-wrap">
    <div class="container">
        <!-- Hero Organizational Header Card -->
        <div class="user-hero-card">
            <div class="row align-items-center gy-3">
                <div class="col-lg-8 d-flex align-items-center gap-3">
                    <div class="user-avatar-circle">
                        {{ mb_substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <h1 class="user-hero-name">{{ $user->name }}</h1>
                            <span class="tier-badge bg-warning text-dark">
                                <i class="fas fa-layer-group"></i> স্তর: {{ $user->worker_tier_label }}
                            </span>
                            <span class="tier-badge bg-light text-dark">
                                <i class="fas fa-sitemap"></i> {{ $user->org_tier_label }}
                            </span>
                        </div>
                        <p class="mb-2 text-white-50 font-sm">
                            <i class="fas fa-user-tag text-warning me-1"></i> পদবী: <strong>{{ $user->designation ?? 'সদস্য' }}</strong>
                            <span class="mx-2 opacity-50">•</span>
                            <i class="fas fa-map-marker-alt text-warning me-1"></i> শাখা: <strong>{{ $user->branch_name ?? 'সাধারণ শাখা' }}</strong>
                            <span class="mx-2 opacity-50">•</span>
                            <i class="fas fa-envelope text-warning me-1"></i> {{ $user->email }}
                        </p>
                        <!-- Syllabus Progress Bar -->
                        <div style="max-width: 480px;">
                            <div class="d-flex justify-content-between text-white font-xs mb-1">
                                <span>বর্তমান স্তরের পাঠ সমাপ্তি: <strong>{{ $progressPercent }}%</strong></span>
                                <span>পরবর্তী স্তর: <strong>{{ $user->next_tier_label }}</strong></span>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-bar-fill" style="width: {{ $progressPercent }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="d-flex flex-column align-items-lg-end gap-2">
                        @if($user->is_current_month_iyanat_paid)
                            <span class="badge bg-success px-3 py-2 font-sm rounded-pill">
                                <i class="fas fa-check-circle me-1"></i> চলতি মাসের এয়ানত পরিশোধিত
                            </span>
                        @else
                            <button class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark" onclick="openIyanatTab()">
                                <i class="fas fa-hand-holding-usd me-1"></i> মাসিক এয়ানত পরিশোধ করুন
                            </button>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3 font-xs">
                                <i class="fas fa-sign-out-alt me-1"></i> লগআউট
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Global Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- 4 Key Organizational Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card-org">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted font-xs">বর্তমান স্তর</span>
                        <div class="stat-org-icon gold"><i class="fas fa-layer-group"></i></div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $user->worker_tier_label }}</h4>
                        <small class="text-success font-xs"><i class="fas fa-arrow-up me-1"></i>লক্ষ্য: {{ $user->next_tier_label }}</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card-org">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted font-xs">সাংগঠনিক ইউনিট</span>
                        <div class="stat-org-icon blue"><i class="fas fa-sitemap"></i></div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $user->org_tier_label }}</h4>
                        <small class="text-muted font-xs">{{ $user->branch_name ?? 'শাখা' }} • {{ $user->designation ?? 'কর্মী' }}</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card-org">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted font-xs">পরিশোধিত এয়ানত</span>
                        <div class="stat-org-icon green"><i class="fas fa-hand-holding-usd"></i></div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 text-success">৳ {{ number_format($totalIyanatAmount, 2) }}</h4>
                        <small class="text-muted font-xs">মাসিক ধার্য: ৳ {{ number_format($user->monthly_iyanat ?? 200, 2) }}</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card-org">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted font-xs">কর্মসূচি প্রতিবেদন</span>
                        <div class="stat-org-icon purple"><i class="fas fa-file-signature"></i></div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $programReports->count() }} টি</h4>
                        <small class="text-muted font-xs">অনুমোদিত: {{ $programReports->where('status', 'approved')->count() }} টি</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Body: Navigation Sidebar & Content Tabs -->
        <div class="row g-4">
            <!-- Left Sidebar Navigation -->
            <div class="col-lg-3 col-12">
                <div class="dash-sidebar-nav">
                    <div class="nav flex-column nav-pills" id="memberTab" role="tablist">
                        <button class="dash-nav-btn active" id="tab-overview-btn" data-bs-toggle="pill" data-bs-target="#tab-overview" type="button" role="tab">
                            <i class="fas fa-th-large text-warning"></i> <span>কর্মী ওভারভিউ</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-syllabus-btn" data-bs-toggle="pill" data-bs-target="#tab-syllabus" type="button" role="tab">
                            <i class="fas fa-book-reader text-primary"></i> <span>সিলেবাস ও কিতাব</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-iyanat-btn" data-bs-toggle="pill" data-bs-target="#tab-iyanat" type="button" role="tab">
                            <i class="fas fa-hand-holding-usd text-success"></i> <span>মাসিক এয়ানত ও রসিদ</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-reports-btn" data-bs-toggle="pill" data-bs-target="#tab-reports" type="button" role="tab">
                            <i class="fas fa-file-alt text-info"></i> <span>কর্মসূচি প্রতিবেদন জমা</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-promotion-btn" data-bs-toggle="pill" data-bs-target="#tab-promotion" type="button" role="tab">
                            <i class="fas fa-level-up-alt text-danger"></i> <span>স্তর মানোন্নয়ন আবেদন</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-trainings-btn" data-bs-toggle="pill" data-bs-target="#tab-trainings" type="button" role="tab">
                            <i class="fas fa-graduation-cap text-secondary"></i> <span>প্রশিক্ষণ কোর্স ও আবেদন</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-profile-btn" data-bs-toggle="pill" data-bs-target="#tab-profile" type="button" role="tab">
                            <i class="fas fa-user-circle text-dark"></i> <span>ব্যক্তিগত বায়োডাটা</span>
                        </button>
                        <button class="dash-nav-btn" id="tab-password-btn" data-bs-toggle="pill" data-bs-target="#tab-password" type="button" role="tab">
                            <i class="fas fa-key text-muted"></i> <span>পাসওয়ার্ড পরিবর্তন</span>
                        </button>
                    </div>

                    <hr class="my-3 text-muted opacity-25">
                    <div class="px-2">
                        <small class="text-muted d-block font-xs mb-2">সাংগঠনিক হেল্পডেস্ক</small>
                        <a href="tel:01712345678" class="text-decoration-none font-xs text-secondary d-block mb-1">
                            <i class="fas fa-phone-alt me-1 text-success"></i> ০১৭০০-০০০০০০
                        </a>
                        <a href="mailto:info.shubbanbd@gmail.com" class="text-decoration-none font-xs text-secondary d-block">
                            <i class="fas fa-envelope me-1 text-primary"></i> info.shubbanbd@gmail.com
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Content Panes -->
            <div class="col-lg-9 col-12">
                <div class="tab-content" id="memberTabContent">
                    
                    <!-- TAB 1: OVERVIEW -->
                    <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-user-shield me-2 text-warning"></i> কর্মী সাংগঠনিক পরিচিতি</span>
                                <span class="badge bg-light text-dark border font-xs">আইডি: SHB-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold text-dark mb-2"><i class="fas fa-id-card me-2 text-primary"></i>কর্মী বিবরণ</h6>
                                        <ul class="list-unstyled mb-0 font-sm">
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">পূর্ণ নাম:</span>
                                                <span class="fw-semibold">{{ $user->name }}</span>
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">কর্মী মান/স্তর:</span>
                                                <span class="badge bg-warning text-dark">{{ $user->worker_tier_label }}</span>
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">সাংগঠনিক স্তর:</span>
                                                <span class="badge bg-light text-dark border">{{ $user->org_tier_label }}</span>
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">পদবী:</span>
                                                <span class="fw-semibold text-primary">{{ $user->designation ?? 'সাধারণ কর্মী' }}</span>
                                            </li>
                                            <li class="py-1 d-flex justify-content-between">
                                                <span class="text-muted">শাখা ইউনিট:</span>
                                                <span class="fw-semibold">{{ $user->branch_name ?? 'নির্ধারিত হয়নি' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold text-dark mb-2"><i class="fas fa-wallet me-2 text-success"></i>এয়ানত ও কর্মসূচি স্ট্যাটাস</h6>
                                        <ul class="list-unstyled mb-0 font-sm">
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">মাসিক এয়ানত হার:</span>
                                                <span class="fw-bold text-success">৳ {{ number_format($user->monthly_iyanat ?? 200, 2) }}</span>
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">চলতি মাস:</span>
                                                <span>{{ date('F Y') }}</span>
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">এয়ানত স্ট্যাটাস:</span>
                                                @if($user->is_current_month_iyanat_paid)
                                                    <span class="badge bg-success">পরিশোধিত</span>
                                                @else
                                                    <span class="badge bg-danger">বকেয়া</span>
                                                @endif
                                            </li>
                                            <li class="py-1 border-bottom d-flex justify-content-between">
                                                <span class="text-muted">জমাকৃত রিপোর্ট:</span>
                                                <span>{{ $programReports->count() }} টি</span>
                                            </li>
                                            <li class="py-1 d-flex justify-content-between">
                                                <span class="text-muted">পদোন্নতি স্ট্যাটাস:</span>
                                                @if($hasPendingPromotion)
                                                    <span class="badge bg-warning text-dark">আবেদন পর্যালোচনায়</span>
                                                @else
                                                    <span class="badge bg-secondary font-xs">আবেদনের উপযুক্ত</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Action Buttons -->
                            <h6 class="fw-bold text-secondary mb-3">জরুরি অ্যাকশন শর্টকাট</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-success rounded-pill px-3 py-2 font-sm" onclick="openIyanatTab()">
                                    <i class="fas fa-hand-holding-usd me-1"></i> এয়ানত পরিশোধ করুন
                                </button>
                                <button class="btn btn-outline-primary rounded-pill px-3 py-2 font-sm" onclick="openReportTab()">
                                    <i class="fas fa-file-upload me-1"></i> কর্মসূচি প্রতিবেদন জমা
                                </button>
                                <button class="btn btn-outline-warning text-dark rounded-pill px-3 py-2 font-sm" onclick="openSyllabusTab()">
                                    <i class="fas fa-book-reader me-1"></i> স্তরের সিলেবাস পড়ুন
                                </button>
                                <button class="btn btn-outline-danger rounded-pill px-3 py-2 font-sm" onclick="openPromotionTab()">
                                    <i class="fas fa-level-up-alt me-1"></i> মানোন্নয়ন আবেদন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: SYLLABUS & BOOKS -->
                    <div class="tab-pane fade" id="tab-syllabus" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <div>
                                    <span><i class="fas fa-book-reader me-2 text-primary"></i> {{ $syllabusData['name'] }} সিলেবাস ও কিতাব</span>
                                    <small class="text-muted d-block font-xs mt-1">{{ $syllabusData['description'] }}</small>
                                </div>
                                <span class="badge {{ $syllabusData['badge'] }} px-3 py-2">{{ $user->worker_tier_label }}</span>
                            </div>

                            <!-- Progress Notice -->
                            <div class="alert alert-info border-0 rounded-3 d-flex align-items-center mb-4" style="background: #e8f4fc;">
                                <i class="fas fa-info-circle fa-2x text-primary me-3"></i>
                                <div>
                                    <strong class="d-block">সিলেবাস সমাপ্তি ও মানোন্নয়ন নির্দেশিকা:</strong>
                                    <small>প্রতিটি বিষয় পড়া সম্পন্ন হলে চেকবক্সে টিক দিন। পুরো সিলেবাস শেষ হলে আপনি পরবর্তী স্তরে মানোন্নয়নের আবেদন করতে পারবেন।</small>
                                </div>
                            </div>

                            <!-- Syllabus Items Checklist -->
                            <h6 class="fw-bold text-dark mb-3">স্তরভিত্তিক আবশ্যিক পাঠ্যসূচি</h6>
                            @foreach($syllabusData['items'] as $item)
                                @php
                                    $isDone = in_array($item['key'], $completedItemKeys);
                                @endphp
                                <div class="syllabus-card d-flex align-items-start justify-content-between gap-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="badge bg-light text-secondary border font-xs">{{ $item['category'] }}</span>
                                            @if($isDone)
                                                <span class="badge bg-success font-xs"><i class="fas fa-check"></i> সম্পন্ন হয়েছে</span>
                                            @endif
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1 {{ $isDone ? 'text-decoration-line-through text-muted' : '' }}">{{ $item['title'] }}</h6>
                                        <p class="text-muted font-sm mb-0">{{ $item['desc'] }}</p>
                                    </div>
                                    <form action="{{ route('user.syllabus.toggle') }}" method="POST" class="flex-shrink-0">
                                        @csrf
                                        <input type="hidden" name="item_key" value="{{ $item['key'] }}">
                                        <input type="hidden" name="tier" value="{{ $user->worker_tier ?? 'rageb' }}">
                                        <button type="submit" class="btn btn-sm {{ $isDone ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-3">
                                            @if($isDone)
                                                <i class="fas fa-check-circle me-1"></i> সম্পন্ন
                                            @else
                                                <i class="far fa-circle me-1"></i> সমাপ্ত চিহ্নিত করুন
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endforeach

                            <!-- Required Reading Books for this Tier -->
                            <h6 class="fw-bold text-dark mt-4 mb-3">স্তরের নির্ধারিত পাঠ্য কিতাবসমূহ</h6>
                            <div class="row g-3">
                                @foreach($syllabusData['books'] as $b)
                                    <div class="col-md-6 col-12">
                                        <div class="book-mini-card">
                                            <div>
                                                <span class="badge bg-success bg-opacity-10 text-success font-xs mb-2">নির্ধারিত কিতাব</span>
                                                <h6 class="fw-bold text-dark mb-1">{{ $b['title'] }}</h6>
                                                <small class="text-muted d-block mb-2"><i class="fas fa-pen-nib me-1"></i> {{ $b['author'] }}</small>
                                                <p class="text-secondary font-xs mb-3">{{ $b['desc'] }}</p>
                                            </div>
                                            <a href="{{ $b['url'] }}" class="btn btn-sm btn-outline-success rounded-pill w-100">
                                                <i class="fas fa-book-open me-1"></i> কিতাব লাইব্রেরিতে পড়ুন
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: MONTHLY IYANAT -->
                    <div class="tab-pane fade" id="tab-iyanat" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-hand-holding-usd me-2 text-success"></i> মাসিক এয়ানত ও বায়তুলমাল</span>
                                <span class="badge bg-success font-sm">মোট পরিশোধ: ৳ {{ number_format($totalIyanatAmount, 2) }}</span>
                            </div>

                            <!-- Iyanat Payment Form -->
                            <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                                <h6 class="fw-bold text-dark mb-3"><i class="fas fa-paper-plane me-2 text-success"></i>নতুন মাসের এয়ানত প্রদান ফরম</h6>
                                <form action="{{ route('user.iyanat.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold font-sm">এয়ানতের মাস</label>
                                            <select name="month" class="form-select" required>
                                                @php
                                                    $months = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
                                                    $currentYear = date('Y');
                                                @endphp
                                                @foreach($months as $m)
                                                    <option value="{{ $m }} {{ $currentYear }}">{{ $m }} {{ $currentYear }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-bold font-sm">পরিমাণ (টাকা)</label>
                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $user->monthly_iyanat ?? 200 }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-bold font-sm">পরিশোধের মাধ্যম</label>
                                            <select name="payment_method" class="form-select" required>
                                                <option value="bkash">বিকাশ (bKash) - ০১৭১২-৩৪৫৬৭৮</option>
                                                <option value="nagad">নগদ (Nagad) - ০১৭০০-০০০০০০</option>
                                                <option value="rocket">রকেট (Rocket)</option>
                                                <option value="bank">ব্যাংক একাউন্ট</option>
                                                <option value="cash">শাখা দায়িত্বশীলের কাছে নগদ</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold font-sm">ট্রানজেকশন আইডি (TrxID)</label>
                                            <input type="text" name="transaction_id" class="form-control" placeholder="যেমন: 9J3K8LM2">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold font-sm">প্রেরকের মোবাইল নম্বর</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="যেমন: 017xxxxxxxx">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold font-sm">মন্তব্য / নোট (ঐচ্ছিক)</label>
                                            <input type="text" name="note" class="form-control" placeholder="শাখা বা বিশেষ কোনো বিবরণ...">
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                                <i class="fas fa-check-circle me-1"></i> এয়ানত তথ্য দাখিল করুন
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- History Table -->
                            <h6 class="fw-bold text-dark mb-3">এয়ানত পরিশোধের ইতিহাস ও রসিদ</h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>রসিদ নং</th>
                                            <th>মাস</th>
                                            <th>পরিমাণ</th>
                                            <th>মাধ্যম</th>
                                            <th>তারিখ</th>
                                            <th>স্ট্যাটাস</th>
                                            <th class="text-end">রসিদ মুদ্রণ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($iyanats as $iyn)
                                            <tr>
                                                <td><code>{{ $iyn->receipt_no }}</code></td>
                                                <td><span class="badge bg-light text-dark border">{{ $iyn->month }}</span></td>
                                                <td class="fw-bold text-success">৳ {{ number_format($iyn->amount, 2) }}</td>
                                                <td>{{ $iyn->payment_method_label }}</td>
                                                <td>{{ $iyn->created_at->format('d M, Y') }}</td>
                                                <td>{!! $iyn->status_badge !!}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('user.iyanat.receipt', $iyn->id) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3" title="রসিদ ডাউনলোড / প্রিন্ট">
                                                        <i class="fas fa-print me-1"></i> রসিদ
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">কোনো এয়ানত রেকর্ড পাওয়া যায়নি।</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: PROGRAM REPORTS -->
                    <div class="tab-pane fade" id="tab-reports" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-file-signature me-2 text-info"></i> কর্মসূচি ও দাওয়াতী কার্যক্রম প্রতিবেদন</span>
                                <button class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="collapse" data-bs-target="#newReportForm">
                                    <i class="fas fa-plus me-1"></i> নতুন প্রতিবেদন তৈরি
                                </button>
                            </div>

                            <!-- New Report Collapse Form -->
                            <div class="collapse mb-4" id="newReportForm">
                                <div class="card border-0 bg-light p-4 rounded-4 shadow-sm">
                                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-edit me-2 text-primary"></i>কর্মসূচি প্রতিবেদন দাখিল ফরম</h6>
                                    <form action="{{ route('user.report.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold font-sm">কর্মসূচির ধরন</label>
                                                <select name="program_type" class="form-select" required>
                                                    <option value="মাসিক সাধারণ সভা">মাসিক সাধারণ সভা</option>
                                                    <option value="তাফসীরুল কুরআন মাহফিল">তাফসীরুল কুরআন মাহফিল</option>
                                                    <option value="যুব সমাবেশ ও মতবিনিময়">যুব সমাবেশ ও মতবিনিময়</option>
                                                    <option value="পাঠচক্র ও কিতাব অধ্যয়ন">পাঠচক্র ও কিতাব অধ্যয়ন</option>
                                                    <option value="দাওয়াতী সফর ও প্রচার">দাওয়াতী সফর ও প্রচার</option>
                                                    <option value="ত্রাণ ও সমাজসেবা কার্যক্রম">ত্রাণ ও সমাজসেবা কার্যক্রম</option>
                                                    <option value="বৃক্ষরোপণ ও পরিচ্ছন্নতা অভিযান">বৃক্ষরোপণ ও পরিচ্ছন্নতা অভিযান</option>
                                                    <option value="বিশেষ কর্মশালা ও প্রশিক্ষণ">বিশেষ কর্মশালা ও প্রশিক্ষণ</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold font-sm">কর্মসূচির শিরোনাম</label>
                                                <input type="text" name="title" class="form-control" placeholder="যেমন: মাঘ মাসের মাসিক যুব সমাবেশ" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-bold font-sm">তারিখ</label>
                                                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-bold font-sm">স্থান / ভেন্যু</label>
                                                <input type="text" name="venue" class="form-control" placeholder="যেমন: শাখা কার্যালয় বা মসজিদ">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-bold font-sm">কর্মী উপস্থিতি</label>
                                                <input type="number" name="worker_attendance" class="form-control" value="0" min="0" required>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-bold font-sm">সুধী উপস্থিতি</label>
                                                <input type="number" name="guest_attendance" class="form-control" value="0" min="0" required>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label fw-bold font-sm">বিস্তারিত বিবরণ ও গৃহীত সিদ্ধান্তসমূহ</label>
                                                <textarea name="description" class="form-control" rows="4" placeholder="কর্মসূচির মূল আলোচনা, গৃহীত সিদ্ধান্ত ও ভবিষ্যৎ পরিকল্পনা লিখুন..." required></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold font-sm">সংযুক্তি ফাইল বা ছবি (ঐচ্ছিক)</label>
                                                <input type="file" name="attachment" class="form-control">
                                                <small class="text-muted font-xs">PDF, JPG, PNG ফাইল (সর্বোচ্চ ৫ মেগাবাইট)</small>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                    <i class="fas fa-paper-plane me-1"></i> কেন্দ্রীয় দফতরে প্রতিবেদন জমা দিন
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Submitted Reports List -->
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>তারিখ</th>
                                            <th>কর্মসূচির শিরোনাম</th>
                                            <th>উপস্থিতি</th>
                                            <th>শাখা / ইউনিট</th>
                                            <th>স্ট্যাটাস</th>
                                            <th>কেন্দ্রীয় ফিডব্যাক</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($programReports as $rep)
                                            <tr>
                                                <td>{{ $rep->date ? $rep->date->format('d M, Y') : '' }}</td>
                                                <td>
                                                    <div class="fw-bold">{{ $rep->title }}</div>
                                                    <small class="text-muted"><i class="fas fa-tag me-1"></i>{{ $rep->program_type }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border">কর্মী: {{ $rep->worker_attendance }}</span>
                                                    <span class="badge bg-light text-dark border">সুধী: {{ $rep->guest_attendance }}</span>
                                                </td>
                                                <td>{{ $rep->branch_name ?? 'শাখা' }}</td>
                                                <td>{!! $rep->status_badge !!}</td>
                                                <td>
                                                    @if($rep->admin_feedback)
                                                        <span class="text-success font-xs"><i class="fas fa-comment-dots me-1"></i> {{ $rep->admin_feedback }}</span>
                                                    @else
                                                        <span class="text-muted font-xs">অপেক্ষমাণ</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">কোনো প্রতিবেদন দাখিল করা হয়নি। উপরের বাটনে ক্লিক করে প্রতিবেদন জমা দিন।</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: TIER PROMOTION -->
                    <div class="tab-pane fade" id="tab-promotion" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-layer-group me-2 text-danger"></i> কর্মী মানোন্নয়ন ও স্তর পরিবর্তনের আবেদন</span>
                                <span class="badge bg-warning text-dark font-sm">বর্তমান: {{ $user->worker_tier_label }}</span>
                            </div>

                            @if($hasPendingPromotion)
                                <div class="alert alert-warning border-0 rounded-4 p-4 text-center mb-4">
                                    <i class="fas fa-hourglass-half fa-3x text-warning mb-3"></i>
                                    <h5 class="fw-bold text-dark">আপনার একটি মানোন্নয়ন আবেদন প্রক্রিয়াধীন রয়েছে</h5>
                                    <p class="text-muted font-sm mb-0">কেন্দ্রীয় প্রশিক্ষণ ও মূল্যায়ন বোর্ড আপনার পঠিত বিষয় ও সাংগঠনিক কার্যক্রম পর্যালোচনা করছে। সিদ্ধান্ত হলে আপনার ড্যাশবোর্ডে স্বয়ংক্রিয়ভাবে স্তর হালনাগাদ হবে ইনশাআল্লাহ।</p>
                                </div>
                            @else
                                <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                                    <h6 class="fw-bold text-dark mb-2">পরবর্তী স্তরে পদোন্নতির জন্য আবেদন করুন</h6>
                                    <p class="text-muted font-sm mb-3">সিলেবাসের কিতাবসমূহ মনোযোগ দিয়ে অধ্যয়ন সম্পন্ন করার পর নিচের ফর্ম পূরণ করে আবেদন দাখিল করুন।</p>

                                    <form action="{{ route('user.promotion.apply') }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold font-sm">বর্তমান স্তর</label>
                                                <input type="text" class="form-control bg-white" value="{{ $user->worker_tier_label }}" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold font-sm">আবেদনকৃত কাঙ্ক্ষিত স্তর</label>
                                                <select name="target_tier" class="form-select" required>
                                                    @if($user->worker_tier === 'general')
                                                        <option value="rageb">রাগেব (১ম স্তর)</option>
                                                    @elseif($user->worker_tier === 'rageb')
                                                        <option value="aref">আরেফ (২য় স্তর)</option>
                                                    @elseif($user->worker_tier === 'aref')
                                                        <option value="salek">সালেক (৩য় স্তর)</option>
                                                    @elseif($user->worker_tier === 'salek')
                                                        <option value="saleh">সালেহ (৪র্থ / শীর্ষ স্তর)</option>
                                                    @else
                                                        <option value="saleh">সালেহ (সর্বোচ্চ স্তর)</option>
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label fw-bold font-sm">পঠিত কিতাব ও বিষয়সমূহের তালিকা</label>
                                                <textarea name="books_read" class="form-control" rows="3" placeholder="বর্তমান স্তরে আপনি কোন কোন কিতাব, তাফসীর ও হাদিস পড়েছেন তা বিস্তারিত লিখুন..." required></textarea>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label fw-bold font-sm">সাংগঠনিক দায়িত্ব পালন ও আপনার অনুভূতি (ঐচ্ছিক)</label>
                                                <textarea name="applicant_notes" class="form-control" rows="2" placeholder="আপনার শাখার কার্যক্রম এবং নিজের আত্মিক অনুভূতি সম্পর্কে কিছু লিখুন..."></textarea>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="syllabus_completed" id="checkCompleted" value="1" required style="accent-color: #0C4B36;">
                                                    <label class="form-check-label font-sm text-dark fw-semibold" for="checkCompleted">
                                                        আমি নিশ্চিত করছি যে, বর্তমান স্তরের নির্ধারিত সিলেবাস ও পাঠ্য কিতাবসমূহ আমি বিশ্বস্ততার সাথে অধ্যয়ন করেছি।
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-danger rounded-pill px-4">
                                                    <i class="fas fa-paper-plane me-1"></i> মানোন্নয়নের জন্য আবেদন দাখিল করুন
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <!-- Past Applications -->
                            <h6 class="fw-bold text-dark mb-3">বিগত মানোন্নয়ন আবেদনের ইতিহাস</h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>তারিখ</th>
                                            <th>আবেদনকৃত স্তর</th>
                                            <th>পূর্ববর্তী স্তর</th>
                                            <th>স্ট্যাটাস</th>
                                            <th>বোর্ডের মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tierPromotions as $promo)
                                            <tr>
                                                <td>{{ $promo->created_at->format('d M, Y') }}</td>
                                                <td><span class="badge bg-success">{{ $promo->target_tier_label }}</span></td>
                                                <td><span class="badge bg-secondary">{{ $promo->current_tier_label }}</span></td>
                                                <td>{!! $promo->status_badge !!}</td>
                                                <td>{{ $promo->admin_notes ?? '—' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">পূর্বে কোনো মানোন্নয়ন আবেদন দাখিল করা হয়নি।</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 6: TRAININGS & COURSES -->
                    <div class="tab-pane fade" id="tab-trainings" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-graduation-cap me-2 text-secondary"></i> কেন্দ্রীয় প্রশিক্ষণ কোর্স ও আবেদন</span>
                                <a href="{{ route('training.courses') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    <i class="fas fa-plus me-1"></i> নতুন কোর্সে আবেদন
                                </a>
                            </div>

                            @if($registrations->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>কোর্স বা স্তর</th>
                                                <th>আবেদনের তারিখ</th>
                                                <th>মোবাইল</th>
                                                <th>পদবী</th>
                                                <th class="text-end">অ্যাকশন</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($registrations as $index => $reg)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><span class="badge bg-success">{{ strtoupper($reg->course_type ?? 'কোর্স') }}</span></td>
                                                    <td>{{ $reg->created_at->format('d M, Y') }}</td>
                                                    <td>{{ $reg->mobile ?? 'N/A' }}</td>
                                                    <td>{{ $reg->designation ?? 'সদস্য' }}</td>
                                                    <td class="text-end">
                                                        <a href="{{ route('training.print', $reg->id) }}" target="_blank" class="btn btn-sm btn-light border" title="প্রিন্ট প্রিভিউ">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <a href="{{ route('training.download', $reg->id) }}" class="btn btn-sm btn-success" title="পিডিএফ ডাউনলোড">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-user-graduate fa-3x text-muted opacity-25 mb-3"></i>
                                    <h6 class="fw-bold text-secondary">কোনো প্রশিক্ষণ আবেদন পাওয়া যায়নি</h6>
                                    <p class="text-muted font-sm mb-3">শুব্বানের ৪ স্তরীয় প্রশিক্ষণ কোর্সে যুক্ত হতে এখনই আবেদন করুন।</p>
                                    <a href="{{ route('training.courses') }}" class="btn btn-success rounded-pill px-4">
                                        প্রশিক্ষণ স্তরসমূহ দেখুন
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- TAB 7: PROFILE & BIO -->
                    <div class="tab-pane fade" id="tab-profile" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-user-edit me-2 text-dark"></i> ব্যক্তিগত তথ্য ও বায়োডাটা</span>
                            </div>

                            <form action="{{ route('user.profile.update') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">পূর্ণ নাম</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">ইমেইল ঠিকানা</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">মোবাইল নম্বর</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="017xxxxxxxx">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">রক্তের গ্রুপ</label>
                                        <select name="blood_group" class="form-select">
                                            <option value="">নির্বাচন করুন</option>
                                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                                <option value="{{ $bg }}" {{ (old('blood_group', $user->blood_group) == $bg) ? 'selected' : '' }}>{{ $bg }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">পেশা / শিক্ষাগত যোগ্যতা</label>
                                        <input type="text" name="profession" class="form-control" value="{{ old('profession', $user->profession) }}" placeholder="যেমন: শিক্ষার্থী / শিক্ষক / ব্যবসায়ী">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold font-sm">শাখা / ইউনিটের নাম</label>
                                        <input type="text" name="branch_name" class="form-control" value="{{ old('branch_name', $user->branch_name) }}" placeholder="যেমন: মিরপুর শাখা, ঢাকা">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold font-sm">বর্তমান ও স্থায়ী ঠিকানা</label>
                                        <textarea name="address" class="form-control" rows="2" placeholder="গ্রাম/মহল্লা, ডাকঘর, থানা, জেলা...">{{ old('address', $user->address) }}</textarea>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-success px-4 rounded-pill">
                                            <i class="fas fa-save me-1"></i> তথ্য সংরক্ষণ করুন
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TAB 8: PASSWORD -->
                    <div class="tab-pane fade" id="tab-password" role="tabpanel">
                        <div class="dash-content-pane">
                            <div class="pane-header-title">
                                <span><i class="fas fa-key me-2 text-muted"></i> পাসওয়ার্ড ও নিরাপত্তা পরিবর্তন</span>
                            </div>

                            <form action="{{ route('user.password.update') }}" method="POST" style="max-width: 500px;">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold font-sm">বর্তমান পাসওয়ার্ড</label>
                                    <input type="password" name="current_password" class="form-control" required placeholder="বর্তমান পাসওয়ার্ড">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold font-sm">নতুন পাসওয়ার্ড</label>
                                    <input type="password" name="password" class="form-control" required placeholder="কমপক্ষে ৬ অক্ষর">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold font-sm">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="পুনরায় নতুন পাসওয়ার্ড লিখুন">
                                </div>

                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="fas fa-lock me-1"></i> পাসওয়ার্ড আপডেট করুন
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openIyanatTab() {
        const triggerEl = document.querySelector('#tab-iyanat-btn');
        bootstrap.Tab.getOrCreateInstance(triggerEl).show();
        window.scrollTo({ top: 400, behavior: 'smooth' });
    }
    function openReportTab() {
        const triggerEl = document.querySelector('#tab-reports-btn');
        bootstrap.Tab.getOrCreateInstance(triggerEl).show();
        window.scrollTo({ top: 400, behavior: 'smooth' });
    }
    function openSyllabusTab() {
        const triggerEl = document.querySelector('#tab-syllabus-btn');
        bootstrap.Tab.getOrCreateInstance(triggerEl).show();
        window.scrollTo({ top: 400, behavior: 'smooth' });
    }
    function openPromotionTab() {
        const triggerEl = document.querySelector('#tab-promotion-btn');
        bootstrap.Tab.getOrCreateInstance(triggerEl).show();
        window.scrollTo({ top: 400, behavior: 'smooth' });
    }
</script>
@endpush
