@extends('layouts.app')

@section('title', 'ইসলামিক গবেষণা কেন্দ্র - জমঈয়ত শুব্বানে আহলে হাদীস')

@section('content')
<!-- Hero Banner -->
<div class="page-header-banner py-5 mb-5" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold rounded-pill">
                    <i class="fas fa-microscope me-1"></i> তাহক্বীক ও ইসলামী গবেষণা
                </span>
                <h1 class="display-5 fw-bold mb-3 text-white">ইসলামিক গবেষণা কেন্দ্র</h1>
                <p class="lead text-white-50 mb-4">
                    কুরআন ও সুন্নাহর আলোকে বিশুদ্ধ ইলমি গবেষণা, সমসাময়িক জিজ্ঞাসা ও সমকালীন চ্যালেঞ্জ মোকাবিলায় বুদ্ধিবৃত্তিক গবেষণাকেন্দ্র।
                </p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><span class="text-white-50">প্রতিষ্ঠান ও সেবা</span></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">গবেষণা কেন্দ্র</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <div class="p-3 bg-white rounded-circle shadow-lg d-inline-block" style="width: 170px; height: 170px;">
                    <img src="{{ asset('images/members/logo_R.png') }}" alt="Research Center Logo" class="img-fluid rounded-circle p-2" style="max-height: 140px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Introduction Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-3" style="color: #0C4B36;">লক্ষ্য ও গবেষণা দর্শন</h2>
            <p class="text-muted fs-5 lh-lg">
                ইসলামিক গবেষণা কেন্দ্রটি সালাফে সালেহীনের বিশুদ্ধ বুঝ-পদ্ধতির ওপর ভিত্তি করে ইসলামী জ্ঞানের গভীর ও বস্তুনিষ্ঠ গবেষণার উদ্দেশ্যে প্রতিষ্ঠিত।
            </p>
            <p class="text-muted lh-lg">
                বর্তমান যুগের জটিল চ্যালেঞ্জ, বিজ্ঞান ও প্রযুক্তির নব নব প্রশ্ন এবং সামাজিক সমস্যার ইসলামী সমাধান বের করতে বিদগ্ধ উলামায়ে কেরাম ও গবেষকবৃন্দের সমন্বয়ে এই কেন্দ্রটি কাজ করে থাকে।
            </p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('publications.books') }}" class="btn btn-success px-4 py-2" style="background: #0C4B36; border: none;">
                    <i class="fas fa-book me-2"></i>গবেষণা প্রকাশনাসমূহ
                </a>
                <a href="{{ route('publications.articles') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-feather-alt me-2"></i>প্রবন্ধ পড়ুন
                </a>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border-left: 5px solid #FBB040 !important;">
                <h4 class="fw-bold mb-3" style="color: #0C4B36;"><i class="fas fa-feather-alt text-warning me-2"></i>আল্লাহর বাণী:</h4>
                <p class="fs-6 fst-italic text-secondary mb-3">
                    "অতএব তোমরা যদি না জানো, তবে জ্ঞানীদের নিকট জিজ্ঞাসা কর।"
                </p>
                <span class="text-muted small fw-semibold">— সূরা আন-নাহল: ৪৩</span>
            </div>
        </div>
    </div>

    <!-- Research Areas Grid -->
    <div class="mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #0C4B36;">আমাদের গবেষণা ক্ষেত্রসমূহ</h2>
            <p class="text-muted">যেসব মৌলিক ও প্রায়োগিক ক্ষেত্রে কেন্দ্রটি গবেষণা পরিচালনা করে</p>
            <div class="mx-auto" style="width: 70px; height: 3px; background: #FBB040; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e8f5e9; color: #0C4B36;">
                        <i class="fas fa-quran fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">কুরআন ও হাদিস তাহক্বীক</h4>
                    <p class="text-muted mb-0">হাদিসের সনদ ও মতন বিশ্লেষণ, যইফ ও জাল বর্ণনার বিরুদ্ধে সহীহ সুন্নাহর তাহক্বীকভিত্তিক উপস্থাপন।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fef3c7; color: #d97706;">
                        <i class="fas fa-scale-balanced fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">সমসাময়িক ফিকহি গবেষণা</h4>
                    <p class="text-muted mb-0">আধুনিক লেনদেন, ব্যাংকিং, চিকিৎসা নৈতিকতা ও প্রযুক্তিগত উদ্ভাবনে কুরআন-সুন্নাহর সঠিক হুকুম নিরূপণ।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-shield-halved fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">আকীদা সুরক্ষা ও খণ্ডন</h4>
                    <p class="text-muted mb-0">শিরক, বিদআত ও বিভ্রান্তিকর পশ্চিমা মতবাদের বিপরীতে খাঁটি তাওহীদী আকীদার দলিলভিত্তিক যৌক্তিক প্রতিষ্ঠা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-language fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">অনুবাদ ও সম্পাদনা</h4>
                    <p class="text-muted mb-0">বিশ্ববিখ্যাত সালাফী ও ইসলামিক স্কলারদের আরবি ও ইংরেজি ক্লাসিক্যাল কিতাবাদি সহজ ও প্রাঞ্জল বাংলায় অনুবাদ।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #f3e8ff; color: #9333ea;">
                        <i class="fas fa-users-gear fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">গবেষক তৈরিকরণ ফোরাম</h4>
                    <p class="text-muted mb-0">তরুণ আলেম ও মেধাবী শিক্ষার্থীদের উচ্চতর গবেষণা পদ্ধতি, মাকালাহ লিখন ও গ্রন্থ সম্পাদনায় প্রশিক্ষণ প্রদান।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #ecfdf5; color: #059669;">
                        <i class="fas fa-graduation-cap fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">জাতীয় ও আন্তর্জাতিক সেমিনার</h4>
                    <p class="text-muted mb-0">আন্তর্জাতিক ও জাতীয় পর্যায়ের গবেষকদের উপস্থিতিতে নিয়মিত দ্বীনি ও তাত্ত্বিক সেমিনারের আয়োজন।</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .transition-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f1f5f9;
    }
    .transition-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(12, 75, 54, 0.1) !important;
        border-color: #0C4B36 !important;
    }
</style>
@endpush
@endsection
