@extends('layouts.app')

@section('title', 'আশ-শিফা - স্বাস্থ্য ও কল্যাণ সেবা')

@section('content')
<!-- Hero Banner -->
<div class="page-header-banner py-5 mb-5" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold rounded-pill">
                    <i class="fas fa-heartbeat me-1"></i> স্বাস্থ্য ও কল্যাণ সেবা
                </span>
                <h1 class="display-5 fw-bold mb-3 text-white">আশ-শিফা (As-Shifa)</h1>
                <p class="lead text-white-50 mb-4">
                    মানবতার কল্যাণে চিকিৎসাসেবা, স্বাস্থ্য সচেতনতা এবং জরুরি ঔষুধ সহায়তায় নিয়োজিত শুব্বানের একটি মানবিক উদ্যোগ।
                </p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><span class="text-white-50">প্রতিষ্ঠান ও সেবা</span></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">আশ-শিফা</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <div class="p-3 bg-white rounded-circle shadow-lg d-inline-block" style="width: 170px; height: 170px;">
                    <img src="{{ asset('images/members/logo_as-shifa.png') }}" alt="As-Shifa Logo" class="img-fluid rounded-circle p-2" style="max-height: 140px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Introduction Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-3" style="color: #0C4B36;">আমাদের লক্ষ্য ও দৃষ্টিভঙ্গি</h2>
            <p class="text-muted fs-5 lh-lg">
                "আশ-শিফা" হলো জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর পরিচালিত একটি জনকল্যাণমূলক স্বাস্থ্যসেবা কার্যক্রম। আধুনিক চিকিৎসাবিজ্ঞান এবং ইসলামী আদর্শের সমন্বয়ে দরিদ্র, অসহায় ও সাধারণ মানুষের কাছে মানসম্মত প্রাথমিক স্বাস্থ্যসেবা পৌঁছে দেওয়াই এর মূল উদ্দেশ্য।
            </p>
            <p class="text-muted lh-lg">
                সুস্থ দেহ ও প্রশান্ত মনই একজন মুসলমানকে আল্লাহর ইবাদতে ও সমাজ গঠনে সক্রিয় করে তোলে। সেই লক্ষ্যকে সামনে রেখে আশ-শিফা নিয়মিত মেডিকেল ক্যাম্প, বিনামূল্যে ঔষুধ সরবরাহ এবং জরুরি অ্যাম্বুলেন্স সহায়তা প্রদানে কাজ করে যাচ্ছে।
            </p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('donate.index') }}" class="btn btn-success px-4 py-2" style="background: #0C4B36; border: none;">
                    <i class="fas fa-hand-holding-heart me-2"></i>আশ-শিফায় দান করুন
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-phone-alt me-2"></i>যোগাযোগ করুন
                </a>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border-left: 5px solid #FBB040 !important;">
                <h4 class="fw-bold mb-3" style="color: #0C4B36;"><i class="fas fa-quote-left text-warning me-2"></i>রাসূলুল্লাহ ﷺ বলেছেন:</h4>
                <p class="fs-6 fst-italic text-secondary mb-3">
                    "যে ব্যক্তি কোনো মুমিনের পার্থিব বিপদসমূহের কোনো একটি বিপদ দূর করে দেবে, আল্লাহ আখিরাতে তার বিপদসমূহের একটি বিপদ দূর করে দেবেন।"
                </p>
                <span class="text-muted small fw-semibold">— সহীহ মুসলিম: ২৬৯৯</span>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #0C4B36;">আমাদের সেবাসমূহ</h2>
            <p class="text-muted">আশ-শিফা যেসকল স্বাস্থ্যসেবা ও মানবিক কার্যক্রমে সহযোগিতা করে থাকে</p>
            <div class="mx-auto" style="width: 70px; height: 3px; background: #FBB040; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e8f5e9; color: #0C4B36;">
                        <i class="fas fa-stethoscope fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">ফ্রি মেডিকেল ক্যাম্প</h4>
                    <p class="text-muted mb-0">দেশের বিভিন্ন প্রত্যন্ত অঞ্চলে বিশেষজ্ঞ চিকিৎসকদের সমন্বয়ে নিয়মিত বিনামূল্যে রোগী দেখা ও প্রেসক্রিপশন প্রদান।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fef3c7; color: #d97706;">
                        <i class="fas fa-pills fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">জরুরি ঔষুধ সহায়তা</h4>
                    <p class="text-muted mb-0">অসহায় ও দরিদ্র রোগীদের জন্য বিনামূল্যে জীবনরক্ষাকারী প্রাথমিক ঔষুধ ও আর্থিক চিকিৎসা সহায়তা ফান্ড।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-tint fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">ব্লাড ডোনেশন নেটওয়ার্ক</h4>
                    <p class="text-muted mb-0">জরুরি রক্তের প্রয়োজনে নিবেদিতপ্রাণ স্বেচ্ছাসেবী রক্তদাতাদের ডাটাবেজ এবং তাৎক্ষণিক রক্ত সংগ্রহের নেটওয়ার্ক।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-brain fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">মানসিক ও আত্মিক স্বাস্থ্য</h4>
                    <p class="text-muted mb-0">ইসলামী দৃষ্টিভঙ্গিতে কাউন্সেলিং, মানসিক চাপ নিরসন এবং রুহানি প্রশান্তির দিকনির্দেশনামূলক সেশন।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #f3e8ff; color: #9333ea;">
                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">স্বাস্থ্য সচেতনতা সেমিনার</h4>
                    <p class="text-muted mb-0">পরিষ্কার-পরিচ্ছন্নতা, স্বাস্থ্যবিধি, পুষ্টি এবং সংক্রামক রোগ প্রতিরোধে সচেতনতামূলক কর্মশালা ও প্রচারপত্র বিলি।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #ecfdf5; color: #059669;">
                        <i class="fas fa-ambulance fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">জরুরি দুর্যোগে স্বাস্থ্যসেবা</h4>
                    <p class="text-muted mb-0">বন্যা, মহামারী বা যেকোনো প্রাকৃতিক দুর্যোগে দ্রুত মেডিকেল টিম গঠন এবং দুর্গত এলাকায় ত্রাণ ও ওষুধ পৌঁছানো।</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Helpline Box -->
    <div class="card border-0 rounded-4 text-white p-4 p-md-5" style="background: linear-gradient(135deg, #0C4B36 0%, #16654c 100%);">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold text-white mb-2"><i class="fas fa-phone-volume me-2 text-warning"></i>জরুরি সেবা ও তথ্য সহায়তা</h3>
                <p class="mb-0 text-white-50 fs-6">মেডিকেল ক্যাম্প বা স্বাস্থ্যসেবা সম্পর্কিত যেকোনো অনুসন্ধানের জন্য আমাদের সাথে যোগাযোগ করুন।</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="tel:01765812261" class="btn btn-warning px-4 py-2 fw-bold rounded-pill text-dark">
                    <i class="fas fa-phone me-1"></i> ০১৭৬৫-৮১২২৬১
                </a>
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
