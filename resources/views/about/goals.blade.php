@extends('layouts.page')

@section('title', 'আদর্শ ও লক্ষ্য-উদ্দেশ্য')

@section('page-content')
<div class="goals-page-wrap">
    <!-- Main Objective (মূল লক্ষ্য) Featured Hero Card -->
    <div class="card main-goal-card mb-5 border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5 text-center position-relative">
            <div class="goal-top-badge mb-3">
                <span class="badge px-3 py-2 rounded-pill font-sm fw-bold shadow-sm" style="background: #FBB040; color: #0C4B36;">
                    <i class="fas fa-bullseye me-1"></i> শুব্বানের মূল লক্ষ্য
                </span>
            </div>
            
            <div class="arabic-shahada-text mb-3" style="font-family: 'Amiri', 'Traditional Arabic', serif; font-size: 1.6rem; color: #FBB040; letter-spacing: 0.5px;">
                لَا إِلَٰهَ إِلَّا ٱللَّٰهُ مُحَمَّدٌ رَّسُولُ ٱللَّٰهِ
            </div>

            <h2 class="main-goal-title fw-bold text-white mb-3" style="font-size: 1.55rem; line-height: 1.6;">
                কালেমা <span style="color: #FBB040;">"লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"</span>-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।
            </h2>

            <p class="text-white-50 font-sm mx-auto mb-0" style="max-width: 750px;">
                জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ একটি দ্বীনী, অরাজনৈতিক, দাওয়াতী ও যুবকল্যাণমূলক সংগঠন। তরুণ প্রজন্মকে তাওহীদ ও সুন্নাহর আলোকে গড়ে তোলাই আমাদের প্রধান ব্রত।
            </p>
        </div>
    </div>

    <!-- Five-Point Core Program (পাঁচ দফা কর্মসূচি) Section -->
    <div class="five-programs-section mb-5">
        <div class="text-center mb-4">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill fw-bold mb-2">
                <i class="fas fa-layer-group me-1"></i> কর্মপদ্ধতি ও মিশন
            </span>
            <h3 class="fw-bold text-dark fs-3">পাঁচ দফা কর্মসূচি</h3>
            <p class="text-muted small mx-auto" style="max-width: 650px;">
                সমাজ ও যুব শক্তির সামগ্রিক পরিবর্তনের লক্ষ্যে শুব্বানের গৃহীত ৫টি মৌলিক কর্মপন্থা
            </p>
        </div>

        <div class="row g-3 g-lg-4">
            <!-- 1. আকীদাহ সংশোধন -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="program-card h-100">
                    <div class="program-card-header d-flex justify-content-between align-items-center mb-3">
                        <div class="program-icon-box icon-green">
                            <i class="fas fa-quran"></i>
                        </div>
                        <span class="program-number-badge">দফা ০১</span>
                    </div>
                    <h4 class="program-card-title text-success fw-bold">আকীদাহ সংশোধন</h4>
                    <p class="program-card-text text-secondary">
                        তাওহীদ ও রিসালাতে মুহাম্মাদী সম্পর্কে সঠিক জ্ঞানার্জন ও অনুশীলন।
                    </p>
                    <div class="program-card-footer mt-auto pt-2">
                        <small class="text-muted font-xs"><i class="fas fa-check-circle text-success me-1"></i> শিরক ও বিদ‘আত মুক্ত জীবন গঠন</small>
                    </div>
                </div>
            </div>

            <!-- 2. দাওয়াহ ও তাবলীগ -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="program-card h-100">
                    <div class="program-card-header d-flex justify-content-between align-items-center mb-3">
                        <div class="program-icon-box icon-blue">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <span class="program-number-badge">দফা ০২</span>
                    </div>
                    <h4 class="program-card-title text-primary fw-bold">দাওয়াহ ও তাবলীগ</h4>
                    <p class="program-card-text text-secondary">
                        ছাত্র ও যুব সমাজের নিকট ইসলামের দাওয়াত প্রদান।
                    </p>
                    <div class="program-card-footer mt-auto pt-2">
                        <small class="text-muted font-xs"><i class="fas fa-check-circle text-primary me-1"></i> তরুণদের মাঝে ইসলামের আলো ছড়ানো</small>
                    </div>
                </div>
            </div>

            <!-- 3. সংগঠন ও ব্যবস্থাপনা -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="program-card h-100">
                    <div class="program-card-header d-flex justify-content-between align-items-center mb-3">
                        <div class="program-icon-box icon-amber">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <span class="program-number-badge">দফা ০৩</span>
                    </div>
                    <h4 class="program-card-title text-warning-emphasis fw-bold">সংগঠন ও ব্যবস্থাপনা</h4>
                    <p class="program-card-text text-secondary">
                        ইসলামী সমাজ প্রতিষ্ঠার লক্ষ্যে যুব সমাজকে ঐক্যবদ্ধ করা।
                    </p>
                    <div class="program-card-footer mt-auto pt-2">
                        <small class="text-muted font-xs"><i class="fas fa-check-circle text-warning me-1"></i> নিয়মানুবর্তিতা ও সুসংহত নেতৃত্ব</small>
                    </div>
                </div>
            </div>

            <!-- 4. শিক্ষণ ও প্রশিক্ষণ -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="program-card h-100">
                    <div class="program-card-header d-flex justify-content-between align-items-center mb-3">
                        <div class="program-icon-box icon-teal">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="program-number-badge">দফা ০৪</span>
                    </div>
                    <h4 class="program-card-title fw-bold" style="color: #0d9488;">শিক্ষণ ও প্রশিক্ষণ</h4>
                    <p class="program-card-text text-secondary">
                        যুব শক্তিকে সুসংগঠিত করার লক্ষ্যে ইসলামের মূলনীতি সম্পর্কে সঠিক জ্ঞানদান।
                    </p>
                    <div class="program-card-footer mt-auto pt-2">
                        <small class="text-muted font-xs"><i class="fas fa-check-circle text-teal me-1"></i> রাগেব, আরেফ, সালেক ও সালেহ স্তর প্রশিক্ষণ</small>
                    </div>
                </div>
            </div>

            <!-- 5. সমাজ সংস্কার -->
            <div class="col-12 col-md-12 col-lg-6">
                <div class="program-card h-100">
                    <div class="program-card-header d-flex justify-content-between align-items-center mb-3">
                        <div class="program-icon-box icon-purple">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <span class="program-number-badge">দফা ০৫</span>
                    </div>
                    <h4 class="program-card-title fw-bold" style="color: #7e22ce;">সমাজ সংস্কার</h4>
                    <p class="program-card-text text-secondary">
                        অনৈসলামিক রীতিনীতি প্রতিহত করে কুরআন-সুন্নাহভিত্তিক সমাজ প্রতিষ্ঠা।
                    </p>
                    <div class="program-card-footer mt-auto pt-2">
                        <small class="text-muted font-xs"><i class="fas fa-check-circle me-1" style="color: #7e22ce;"></i> অবক্ষয় প্রতিরোধ ও জনকল্যাণমূলক সমাজসেবা</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Methodology & Pillars (সাংগঠনিক কর্মপদ্ধতির বৈশিষ্ট্য) -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4" style="background: #fbfdfc; border: 1px solid #e1ece6 !important;">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-2">আমাদের বৈশিষ্ট্য</span>
                <h3 class="fw-bold text-dark mb-3">কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শ</h3>
                <p class="text-secondary font-sm mb-3" style="line-height: 1.7;">
                    জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ কোনো ব্যক্তিপূজা বা দলীয় সংকীর্ণতায় বিশ্বাস করে না। আমাদের প্রতিটি কাজের একমাত্র ভিত্তি হলো পবিত্র কুরআন এবং রাসূলুল্লাহ (সা.)-এর বিশুদ্ধ হাদীস। আমরা যুব সমাজকে এমনভাবে গড়ে তুলতে চাই যেন তারা সমাজে দ্বীনের আলোকবর্তিকা হয়ে আত্মপ্রকাশ করতে পারে।
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('about.introduction') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-users me-1"></i> বিস্তারিত পরিচিতি
                    </a>
                    <a href="{{ route('training.courses') }}" class="btn btn-sm btn-success rounded-pill px-3">
                        <i class="fas fa-graduation-cap me-1"></i> প্রশিক্ষণ সিলেবাস
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-3 border text-center shadow-xs">
                            <i class="fas fa-balance-scale text-success fa-2x mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1 font-sm">দলীলভিত্তিক ইত্তেবা</h6>
                            <small class="text-muted font-xs">অন্ধ অনুকরণ বর্জন ও সুন্নাহর অনুসরণ</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-3 border text-center shadow-xs">
                            <i class="fas fa-heart text-danger fa-2x mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1 font-sm">আত্মশুদ্ধি ও তাকওয়া</h6>
                            <small class="text-muted font-xs">নৈতিক চরিত্র গঠন ও গুনাহ বর্জন</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-3 border text-center shadow-xs">
                            <i class="fas fa-hand-holding-heart text-warning fa-2x mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1 font-sm">নিঃস্বার্থ মানবসেবা</h6>
                            <small class="text-muted font-xs">চিকিৎসা, রক্তদান ও ত্রাণ কার্যক্রম</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-3 border text-center shadow-xs">
                            <i class="fas fa-book-open text-primary fa-2x mb-2"></i>
                            <h6 class="fw-bold text-dark mb-1 font-sm">উচ্চতর গবেষণা</h6>
                            <small class="text-muted font-xs">শুব্বান রিসার্চ সেন্টার ও প্রকাশনা</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Bottom Strip -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-2">
        <a href="{{ route('about.introduction') }}" class="text-decoration-none text-muted font-sm">
            <i class="fas fa-arrow-left me-1"></i> পরিচিতি পেজে যান
        </a>
        <a href="{{ route('donate.index') }}" class="btn btn-warning text-dark fw-bold rounded-pill px-4 shadow-sm">
            <i class="fas fa-hand-holding-heart me-1"></i> আমাদের কার্যক্রমে সহযোগিতা করুন
        </a>
    </div>
</div>
@endsection

@section('page-styles')
<style>
    .main-goal-card {
        background: linear-gradient(135deg, #072e20 0%, #0C4B36 50%, #135d43 100%);
        box-shadow: 0 15px 35px rgba(12, 75, 54, 0.18);
        border: 2px solid #FBB040 !important;
    }
    .program-card {
        background: #ffffff;
        border: 1px solid #e1ece6;
        border-radius: 16px;
        padding: 24px 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
    }
    .program-card:hover {
        transform: translateY(-4px);
        border-color: #0C4B36;
        box-shadow: 0 10px 25px rgba(12, 75, 54, 0.08);
    }
    .program-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
    }
    .icon-green { background: #e8f5ed; color: #0C4B36; }
    .icon-blue { background: #e6f2fa; color: #1565c0; }
    .icon-amber { background: #fff8e7; color: #d99014; }
    .icon-teal { background: #e6fffa; color: #0d9488; }
    .icon-purple { background: #f3e8fa; color: #7e22ce; }

    .program-number-badge {
        font-size: 0.75rem;
        font-weight: 700;
        background: #f1f5f3;
        color: #4b6357;
        padding: 4px 10px;
        border-radius: 50px;
        border: 1px solid #dce8e1;
    }
    .program-card-title {
        font-size: 1.15rem;
        margin-bottom: 8px;
    }
    .program-card-text {
        font-size: 0.92rem;
        line-height: 1.55;
        margin-bottom: 12px;
    }
    .shadow-xs {
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
</style>
@endsection
