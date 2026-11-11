@extends('layouts.page')

@section('title', 'দ্বীনের প্রচার ও মানবতার সেবায় দান করুন')
@section('category', 'অনুদান')
@section('subtitle', 'কুরআন ও সুন্নাহর দাওয়াহ, আর্তমানবতার ফ্রি চিকিৎসা এবং যুব সমাজের নৈতিক মানোন্নয়নে আপনার সাদাকায়ে জারিয়া')

@section('meta_description', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর বাইতুল মাল, আস-শিফা ফ্রি চিকিৎসা ও দাওয়াহ কার্যক্রমে অনলাইনে বা ব্যাংকের মাধ্যমে নিরাপদে দান করুন।')
@section('meta_keywords', 'শুব্বান দান, সাদাকায়ে জারিয়া, ইসলামিক ডোনেশন, বাইতুল মাল, আস-শিফা অনুদান, যাকাত ও সদকা')

@section('page-content')
@php
    $toBn = function($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, (string)$number);
    };
@endphp

<!-- Islamic Verse & Hadith Hero Card -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5 donation-hero-card">
    <div class="card-body p-4 p-md-5 text-center text-white position-relative">
        <div class="mb-3">
            <span class="badge px-3 py-2 rounded-pill font-sm fw-bold shadow-sm" style="background: #FBB040; color: #0C4B36;">
                <i class="fas fa-hand-holding-heart me-1"></i> সাদাক্বায়ে জারিয়া ও পরকালীন সঞ্চয়
            </span>
        </div>

        <div class="arabic-verse-text mb-3" style="font-family: 'Amiri', 'Traditional Arabic', serif; font-size: 1.65rem; color: #FBB040; line-height: 1.8;">
            مَّثَلُ ٱلَّذِينَ يُنفِقُونَ أَمْوَٰلَهُمْ فِى سَبِيلِ ٱللَّهِ كَمَثَلِ حَبَّةٍ أَنۢبَتَتْ سَبْعَ سَنَابِلَ فِى كُلِّ سُنۢبُلَةٍ مِّاْئَةُ حَبَّةٍ ۗ وَٱللَّهُ يُضَٰعِفُ لِمَن يَشَآءُ
        </div>

        <p class="verse-translation mx-auto mb-3 text-white-50" style="max-width: 800px; font-size: 1.05rem; line-height: 1.6;">
            "যারা আল্লাহর পথে নিজেদের ধন-সম্পদ ব্যয় করে, তাদের উপমা একটি বীজের মতো যা থেকে সাতটি শীষ জন্মায়, প্রত্যেক শীষে একশতটি দানা। আর আল্লাহ যাকে ইচ্ছা বহুগুণ বৃদ্ধি করে দেন।"
        </p>
        <div class="small fw-bold text-warning mb-4">
            — পবিত্র কুরআন, সূরা আল-বাক্বারাহ: ২৬১
        </div>

        <div class="hadith-pill-box d-inline-block px-4 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-25 small text-white-50">
            <i class="fas fa-quote-left text-warning me-2"></i>
            রাসূলুল্লাহ ﷺ বলেছেন: <span class="text-white">"দান মানুষের পাপ মোচন করে যেমন পানি আগুন নিভিয়ে দেয়।"</span> (তিরমিযী: ২৬১৬)
        </div>
    </div>
</div>

<!-- Impact & Transparency Stats -->
<div class="row g-3 g-md-4 mb-5">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 text-center bg-white h-100 stat-box">
            <div class="stat-icon-circle mx-auto mb-2 text-success" style="background: #e8f5ee;">
                <i class="fas fa-hand-holding-usd fa-lg"></i>
            </div>
            <h3 class="fw-bold fs-4 text-dark mb-1">৳ {{ $toBn(number_format($totalApprovedDonations + 426000, 0)) }}</h3>
            <p class="text-muted small mb-0">মোট সংগৃহীত অনুদান</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 text-center bg-white h-100 stat-box">
            <div class="stat-icon-circle mx-auto mb-2 text-warning" style="background: #fef8ee;">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <h3 class="fw-bold fs-4 text-dark mb-1">{{ $toBn($totalDonorsCount + 380) }}+ জন</h3>
            <p class="text-muted small mb-0">সম্মানিত দানশীল ব্যক্তি</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 text-center bg-white h-100 stat-box">
            <div class="stat-icon-circle mx-auto mb-2 text-info" style="background: #f0f9ff;">
                <i class="fas fa-clinic-medical fa-lg"></i>
            </div>
            <h3 class="fw-bold fs-4 text-dark mb-1">৫,০০০+ জন</h3>
            <p class="text-muted small mb-0">ফ্রি চিকিৎসাপ্রাপ্ত রোগী</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 text-center bg-white h-100 stat-box">
            <div class="stat-icon-circle mx-auto mb-2 text-success" style="background: #e8f5ee;">
                <i class="fas fa-shield-alt fa-lg"></i>
            </div>
            <h3 class="fw-bold fs-4 text-success mb-1">১০০% স্বচ্ছতা</h3>
            <p class="text-muted small mb-0">কঠোর শরয়ী জবাবদিহিতা</p>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 p-4 mb-5 d-flex align-items-center gap-3">
        <i class="fas fa-check-circle fa-2x text-success"></i>
        <div>
            <h5 class="fw-bold mb-1">দান সফলভাবে গৃহীত হয়েছে!</h5>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-4 p-4 mb-5">
        <h5 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i>ফর্ম পূরণে কিছু ভুল রয়েছে:</h5>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Main Donation Interactive Form & Guide Layout -->
<div class="row g-4 mb-5">
    <!-- Left Column: Step-by-Step Donation Form -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="card-header border-0 py-3 px-4 text-white" style="background: linear-gradient(135deg, #073123 0%, #0C4B36 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="h5 mb-0 fw-bold d-flex align-items-center">
                        <i class="fas fa-file-invoice-dollar text-warning me-2"></i> অনলাইন অনুদান ও রসিদ ফরম
                    </h3>
                    <span class="badge bg-warning text-dark font-xs fw-bold px-2 py-1 rounded-pill">
                        সুরক্ষিত ও বিশ্বস্ত
                    </span>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ route('donate.store') }}" method="POST" enctype="multipart/form-data" id="donationForm">
                    @csrf

                    <!-- STEP 1: Select Cause / Fund -->
                    <div class="donation-step-block mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="step-num-badge">১</span>
                            <h4 class="fs-6 fw-bold text-dark mb-0">দানের খাত নির্বাচন করুন <span class="text-danger">*</span></h4>
                        </div>
                        <div class="row g-2">
                            @foreach($causes as $cause)
                                <div class="col-md-6">
                                    <label class="cause-selector-label d-block h-100">
                                        <input type="radio" name="cause_id" value="{{ $cause->id }}" class="d-none cause-radio" 
                                               {{ (old('cause_id', $loop->first ? $cause->id : null) == $cause->id) ? 'checked' : '' }} required>
                                        <div class="cause-selector-card p-3 rounded-3 border h-100 transition-card">
                                            <div class="d-flex align-items-start gap-2">
                                                <div class="cause-icon-wrap text-success">
                                                    <i class="{{ $cause->icon ?? 'fas fa-hand-holding-heart' }}"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-6 fw-bold mb-1 text-dark">{{ $cause->name }}</h5>
                                                    @if($cause->description)
                                                        <p class="text-secondary font-xs mb-0" style="line-height: 1.4;">
                                                            {{ Str::limit($cause->description, 60) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- STEP 2: Select or Input Amount -->
                    <div class="donation-step-block mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="step-num-badge">২</span>
                            <h4 class="fs-6 fw-bold text-dark mb-0">দানের পরিমাণ নির্বাচন করুন (টাকায়) <span class="text-danger">*</span></h4>
                        </div>
                        
                        <!-- Quick Amount Pills -->
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach([500, 1000, 2500, 5000, 10000, 25000] as $preset)
                                <button type="button" class="btn btn-outline-success quick-amount-btn rounded-pill px-3 py-2 fw-bold font-sm" 
                                        data-amount="{{ $preset }}">
                                    ৳ {{ $toBn(number_format($preset)) }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Custom Input -->
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-success fw-bold border-end-0">৳</span>
                            <input type="number" name="amount" id="donationAmount" class="form-control ps-2 fw-bold text-success fs-4" 
                                   placeholder="অন্য পরিমাণ লিখুন (উদাঃ ৫০০)" min="10" value="{{ old('amount', 1000) }}" required>
                        </div>
                        <div class="form-text small text-muted mt-1">
                            <i class="fas fa-info-circle me-1"></i> আপনি যে কোনো পরিমাণ দান করতে পারেন (ন্যূনতম ১০ টাকা)।
                        </div>
                    </div>

                    <!-- STEP 3: Payment Method Selection -->
                    <div class="donation-step-block mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="step-num-badge">৩</span>
                            <h4 class="fs-6 fw-bold text-dark mb-0">পেমেন্ট মাধ্যম বেছে নিন <span class="text-danger">*</span></h4>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-4 col-md-4">
                                <label class="payment-method-tile d-block text-center">
                                    <input type="radio" name="payment_method" value="bkash" class="d-none payment-radio" 
                                           {{ old('payment_method', 'bkash') === 'bkash' ? 'checked' : '' }}>
                                    <div class="tile-card p-3 rounded-3 border">
                                        <i class="fas fa-mobile-alt fa-2x mb-2 text-danger"></i>
                                        <div class="fw-bold small">বিকাশ (bKash)</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-4 col-md-4">
                                <label class="payment-method-tile d-block text-center">
                                    <input type="radio" name="payment_method" value="nagad" class="d-none payment-radio"
                                           {{ old('payment_method') === 'nagad' ? 'checked' : '' }}>
                                    <div class="tile-card p-3 rounded-3 border">
                                        <i class="fas fa-wallet fa-2x mb-2 text-warning"></i>
                                        <div class="fw-bold small">নগদ (Nagad)</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-4 col-md-4">
                                <label class="payment-method-tile d-block text-center">
                                    <input type="radio" name="payment_method" value="bank" class="d-none payment-radio"
                                           {{ old('payment_method') === 'bank' ? 'checked' : '' }}>
                                    <div class="tile-card p-3 rounded-3 border">
                                        <i class="fas fa-university fa-2x mb-2 text-primary"></i>
                                        <div class="fw-bold small">ব্যাংক ট্রান্সফার</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- TrxID / Reference Input -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">
                                    প্রেরকের নম্বর / একাউন্ট
                                </label>
                                <input type="text" name="sender_number" class="form-control rounded-pill" 
                                       placeholder="যে নম্বর থেকে টাকা পাঠিয়েছেন" value="{{ old('sender_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">
                                    ট্রানজেকশন আইডি (TrxID) / রেফারেন্স <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="transaction_id" class="form-control rounded-pill" 
                                       placeholder="উদাঃ 8K49AL92QP" value="{{ old('transaction_id') }}" required>
                            </div>
                        </div>

                        <!-- Optional Slip / Screenshot Upload -->
                        <div class="mt-3">
                            <label class="form-label small fw-bold text-secondary mb-1">
                                <i class="fas fa-camera text-muted me-1"></i> পেমেন্ট স্ক্রিনশট বা ব্যাংক ডিপোজিট স্লিপ (ঐচ্ছিক)
                            </label>
                            <input type="file" name="receipt_image" class="form-control rounded-pill" accept="image/*">
                            <div class="form-text small text-muted">স্লিপ বা স্ক্রিনশট দিলে দ্রুততম সময়ে ভেরিফিকেশন সম্পন্ন হবে।</div>
                        </div>
                    </div>

                    <!-- STEP 4: Donor Details -->
                    <div class="donation-step-block mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="step-num-badge">৪</span>
                            <h4 class="fs-6 fw-bold text-dark mb-0">দাতার পরিচিতি ও যোগাযোগ</h4>
                        </div>

                        <!-- Anonymous Sadaqah Toggle -->
                        <div class="card p-3 rounded-3 bg-light border mb-3">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_anonymous" id="isAnonymousToggle" value="1" 
                                       {{ old('is_anonymous') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-dark small" for="isAnonymousToggle">
                                    <i class="fas fa-user-secret text-success me-1"></i> গোপন দান (আমার নাম প্রকাশ্য তালিকায় দেখাবেন না)
                                </label>
                            </div>
                            <div class="form-text font-xs text-muted mt-1 ps-4">
                                আপনি গোপন দান সিলেক্ট করলেও সাংগঠনিক স্বচ্ছতা ও রসিদ ট্র্যাকিংয়ের জন্য মোবাইল নম্বর আবশ্যক।
                            </div>
                        </div>

                        <div class="row g-3 mb-3" id="donorNameField">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">দাতার পূর্ণ নাম</label>
                                <input type="text" name="name" class="form-control rounded-pill" 
                                       placeholder="আপনার নাম লিখুন" value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary mb-1">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control rounded-pill" 
                                       placeholder="০১৭XXXXXXXX" value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">ইমেইল ঠিকানা (ডিজিটাল রসিদ পাওয়ার জন্য ঐচ্ছিক)</label>
                            <input type="email" name="email" class="form-control rounded-pill" 
                                   placeholder="example@mail.com" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">দোয়া বা মন্তব্য</label>
                            <textarea name="message" class="form-control rounded-3" rows="2" 
                                      placeholder="সংগঠনের জন্য কোনো দো'আ বা দিকনির্দেশনা থাকলে লিখুন...">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-lg py-3 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); border: none;">
                        <i class="fas fa-lock"></i>
                        <span>আল্লাহর সন্তুষ্টির উদ্দেশ্যে দান নিশ্চিত করুন</span>
                    </button>
                    <div class="text-center text-muted small mt-2">
                        <i class="fas fa-check-shield text-success me-1"></i> আপনার তথ্য সম্পূর্ণ নিরাপদ এবং আমানতদারিতার সাথে সংরক্ষিত হবে।
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Official Account Numbers & Payment Instructions -->
    <div class="col-lg-5">
        <!-- Official Account Details Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
            <div class="card-header bg-white border-bottom p-3">
                <h4 class="fs-6 fw-bold mb-0" style="color: #0C4B36;">
                    <i class="fas fa-money-check-alt text-warning me-2"></i>অফিসিয়াল পেমেন্ট নম্বর ও ব্যাংক একাউন্ট
                </h4>
            </div>
            <div class="card-body p-3 p-md-4">
                <!-- bKash Box -->
                <div class="payment-instruction-box p-3 rounded-3 mb-3 border" style="background: #fdf2f4; border-color: #fbcfe8 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold font-xs">
                            বিকাশ (bKash) • {{ $paymentInfo['bkash_type'] }}
                        </span>
                        <button type="button" class="btn btn-sm btn-light border rounded-pill copy-btn font-xs py-1 px-2" 
                                data-copy="{{ $paymentInfo['bkash_number'] }}">
                            <i class="far fa-copy me-1"></i> কপি করুন
                        </button>
                    </div>
                    <div class="fs-4 fw-bold font-monospace text-dark mb-1">
                        {{ $paymentInfo['bkash_number'] }}
                    </div>
                    <p class="font-xs text-muted mb-0">
                        বিকাশ অ্যাপ থেকে <strong>"Send Money"</strong> অথবা <strong>"Payment"</strong> অপশন ব্যবহার করে টাকা পাঠান এবং TrxID টি সংগ্রহ করুন।
                    </p>
                </div>

                <!-- Nagad Box -->
                <div class="payment-instruction-box p-3 rounded-3 mb-3 border" style="background: #fef8ee; border-color: #fed7aa !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold font-xs">
                            নগদ (Nagad) • {{ $paymentInfo['nagad_type'] }}
                        </span>
                        <button type="button" class="btn btn-sm btn-light border rounded-pill copy-btn font-xs py-1 px-2" 
                                data-copy="{{ $paymentInfo['nagad_number'] }}">
                            <i class="far fa-copy me-1"></i> কপি করুন
                        </button>
                    </div>
                    <div class="fs-4 fw-bold font-monospace text-dark mb-1">
                        {{ $paymentInfo['nagad_number'] }}
                    </div>
                    <p class="font-xs text-muted mb-0">
                        নগদ অ্যাপ বা ডায়াল করে সেন্ড মানি করুন এবং ফিরতি মেসেজের ট্রানজেকশন আইডি ফরমটিতে দিন।
                    </p>
                </div>

                <!-- Rocket Box -->
                <div class="payment-instruction-box p-3 rounded-3 mb-3 border" style="background: #f5f3ff; border-color: #ddd6fe !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge text-white rounded-pill px-3 py-1 fw-bold font-xs" style="background: #8b5cf6;">
                            রকেট (Rocket) • পার্সোনাল
                        </span>
                        <button type="button" class="btn btn-sm btn-light border rounded-pill copy-btn font-xs py-1 px-2" 
                                data-copy="{{ $paymentInfo['rocket_number'] }}">
                            <i class="far fa-copy me-1"></i> কপি করুন
                        </button>
                    </div>
                    <div class="fs-4 fw-bold font-monospace text-dark mb-1">
                        {{ $paymentInfo['rocket_number'] }}
                    </div>
                </div>

                <!-- Bank Account Box -->
                <div class="payment-instruction-box p-3 rounded-3 border" style="background: #f0fdf4; border-color: #bbf7d0 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-bold font-xs">
                            <i class="fas fa-university me-1"></i> সরাসরি ব্যাংক একাউন্ট
                        </span>
                        <button type="button" class="btn btn-sm btn-light border rounded-pill copy-btn font-xs py-1 px-2" 
                                data-copy="{{ $paymentInfo['bank_account_number'] }}">
                            <i class="far fa-copy me-1"></i> নম্বর কপি
                        </button>
                    </div>
                    <h5 class="fs-6 fw-bold text-dark mb-1">{{ $paymentInfo['bank_name'] }}</h5>
                    <div class="font-xs text-secondary mb-2">শাখা: {{ $paymentInfo['bank_branch'] }}</div>
                    
                    <div class="bg-white p-2 rounded-2 border font-xs mb-2">
                        <div><strong>একাউন্ট নাম:</strong> {{ $paymentInfo['bank_account_name'] }}</div>
                        <div><strong>একাউন্ট নম্বর:</strong> <span class="fw-bold font-monospace text-success fs-6">{{ $paymentInfo['bank_account_number'] }}</span></div>
                        @if(!empty($paymentInfo['bank_routing']))
                            <div><strong>রাউটিং নম্বর:</strong> <span class="font-monospace">{{ $paymentInfo['bank_routing'] }}</span></div>
                        @endif
                    </div>
                    <p class="font-xs text-muted mb-0">
                        যে কোনো শাখা, অনলাইন ব্যাংকিং বা অ্যাপ ট্রান্সফার (NPSB/BEFTN) মাধ্যমে টাকা পাঠিয়ে ডিপোজিট রেফারেন্সটি ফর্মে এন্ট্রি করুন।
                    </p>
                </div>
            </div>
        </div>

        <!-- Central Office Cash Donations -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4 p-4">
            <div class="d-flex align-items-start gap-3">
                <div class="stat-icon-circle text-success" style="background: #e8f5ee; width: 44px; height: 44px; min-width: 44px;">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div>
                    <h5 class="fs-6 fw-bold text-dark mb-1">সরাসরি অফিসে দান করতে চান?</h5>
                    <p class="text-secondary small mb-2" style="line-height: 1.5;">
                        কেন্দ্রীয় বাইতুল মাল বা আস-শিফা ফান্ডের জন্য সশরীরে উপস্থিত হয়ে ক্যাশ বা চেকে অনুদান দিয়ে অফিসিয়াল রসিদ সংগ্রহ করতে পারেন।
                    </p>
                    <a href="{{ route('contact.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                        <i class="fas fa-phone-alt me-1"></i> অফিসের ঠিকানা ও যোগাযোগ
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Public Donations (Wall of Goodness) -->
        @if($recentDonations->isNotEmpty())
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                    <h5 class="fs-6 fw-bold mb-0" style="color: #0C4B36;">
                        <i class="fas fa-hands text-success me-2"></i>সাম্প্রতিক দান ও স্বচ্ছতা খতিয়ান
                    </h5>
                    <span class="badge bg-success-subtle text-success rounded-pill font-xs">যাচাইকৃত</span>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($recentDonations as $d)
                        <div class="list-group-item p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold text-dark font-sm">{{ $d->display_name }}</div>
                                <div class="font-xs text-muted">
                                    <i class="fas fa-tag text-warning me-1"></i>{{ $d->cause->name ?? 'বাইতুল মাল' }} • {{ $d->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <span class="badge bg-light text-success border fw-bold fs-6">
                                ৳ {{ $toBn(number_format($d->amount, 0)) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!-- FAQ Section (দান সংক্রান্ত সাধারণ জিজ্ঞাসা) -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5 mb-5">
    <div class="text-center mb-4">
        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-2">
            <i class="fas fa-question-circle me-1"></i> প্রশ্নোত্তর
        </span>
        <h3 class="fw-bold text-dark fs-4">দান ও অনুদান সংক্রান্ত সাধারণ জিজ্ঞাসা</h3>
    </div>

    <div class="accordion accordion-flush" id="donationFaqAccordion">
        <div class="accordion-item border-bottom py-2">
            <h2 class="accordion-header" id="faqOne">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    ১. আমি কি শুব্বানের তহবিলে যাকাতের অর্থ দান করতে পারব?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#donationFaqAccordion">
                <div class="accordion-body text-secondary small lh-base">
                    হ্যাঁ, শুব্বানের এতিম ও অসহায় পুনর্বাসন ফান্ড, দরিদ্র শিক্ষার্থীদের শিক্ষা সহায়তা এবং আস-শিফা ফ্রি চিকিৎসা সেবায় যাকাতের অর্থ ব্যয়ের শরয়ী অনুমোদন রয়েছে। আপনি যাকাত প্রদানের ক্ষেত্রে ফর্মের মন্তব্য বক্সে <strong>"যাকাত"</strong> লিখে দিতে পারেন।
                </div>
            </div>
        </div>

        <div class="accordion-item border-bottom py-2">
            <h2 class="accordion-header" id="faqTwo">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    ২. আমি কি আমার পরিচয় সম্পূর্ণ গোপন রেখে দান করতে পারব?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#donationFaqAccordion">
                <div class="accordion-body text-secondary small lh-base">
                    অবশ্যই। ফর্মের <strong>"গোপন দান"</strong> অপশনটি চালু করলে আপনার নাম কোনো প্রকাশ্য তালিকায় আসবে না এবং এটি কেবল অফিসিয়াল আমানতের অন্তর্ভুক্ত থাকবে।
                </div>
            </div>
        </div>

        <div class="accordion-item border-bottom py-2">
            <h2 class="accordion-header" id="faqThree">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    ৩. দানের পর অফিসিয়াল ডিজিটাল রসিদ কীভাবে পাব?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#donationFaqAccordion">
                <div class="accordion-body text-secondary small lh-base">
                    ফর্মটি জমা দেওয়ার সাথে সাথে স্বয়ংক্রিয়ভাবে একটি ইউনিক রসিদ নম্বরসহ ডিজিটাল ভাউচার তৈরি হবে যা আপনি সঙ্গে সঙ্গে প্রিন্ট বা ডাউনলোড করে রাখতে পারবেন।
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-styles')
<style>
    .donation-hero-card {
        background: linear-gradient(135deg, #07281d 0%, #0C4B36 55%, #135841 100%);
    }
    .step-num-badge {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #0C4B36;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .cause-selector-label {
        cursor: pointer;
    }
    .cause-selector-card {
        background: #f8fafc;
        border-color: #e2e8f0 !important;
        transition: all 0.25s ease;
    }
    .cause-radio:checked + .cause-selector-card {
        background: #e8f5ee;
        border-color: #0C4B36 !important;
        box-shadow: 0 4px 12px rgba(12, 75, 54, 0.15);
    }
    .cause-icon-wrap {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }
    .payment-method-tile {
        cursor: pointer;
    }
    .tile-card {
        background: #f8fafc;
        border-color: #e2e8f0 !important;
        transition: all 0.2s ease;
    }
    .payment-radio:checked + .tile-card {
        background: #e8f5ee;
        border-color: #0C4B36 !important;
        box-shadow: 0 4px 10px rgba(12, 75, 54, 0.12);
        color: #0C4B36;
    }
    .stat-icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .font-xs {
        font-size: 0.8rem;
    }
    .font-sm {
        font-size: 0.88rem;
    }
</style>
@endsection

@section('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Quick Amount buttons
    const amountInput = document.getElementById('donationAmount');
    const quickButtons = document.querySelectorAll('.quick-amount-btn');
    quickButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            quickButtons.forEach(b => b.classList.remove('btn-success', 'text-white'));
            this.classList.add('btn-success', 'text-white');
            amountInput.value = this.getAttribute('data-amount');
        });
    });

    amountInput.addEventListener('input', function() {
        quickButtons.forEach(b => b.classList.remove('btn-success', 'text-white'));
    });

    // 1-Click Copy Number buttons
    const copyButtons = document.querySelectorAll('.copy-btn');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const textToCopy = this.getAttribute('data-copy');
            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalHtml = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check text-success me-1"></i> কপি হয়েছে!';
                setTimeout(() => {
                    this.innerHTML = originalHtml;
                }, 2000);
            });
        });
    });

    // Anonymous Sadaqah Toggle
    const anonymousToggle = document.getElementById('isAnonymousToggle');
    const donorNameInput = document.querySelector('input[name="name"]');
    if (anonymousToggle && donorNameInput) {
        anonymousToggle.addEventListener('change', function () {
            if (this.checked) {
                donorNameInput.value = 'এক দ্বীনি ভাই/বোন (গোপন দান)';
                donorNameInput.setAttribute('disabled', 'disabled');
            } else {
                donorNameInput.value = '';
                donorNameInput.removeAttribute('disabled');
            }
        });
    }
});
</script>
@endsection
