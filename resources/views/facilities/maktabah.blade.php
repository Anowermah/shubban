@extends('layouts.app')

@section('title', 'মাকতাবাতুশ শুব্বান - কেন্দ্রীয় পাঠাগার ও রিসোর্স সেন্টার')

@section('content')
<!-- Hero Banner -->
<div class="page-header-banner py-5 mb-5" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold rounded-pill">
                    <i class="fas fa-book-reader me-1"></i> কেন্দ্রীয় পাঠাগার
                </span>
                <h1 class="display-5 fw-bold mb-3 text-white">মাকতাবাতুশ শুব্বান</h1>
                <p class="lead text-white-50 mb-4">
                    ইসলামী জ্ঞানের সমৃদ্ধ ভাণ্ডার, আধুনিক রেফারেন্স কালেকশন ও নিরিবিলি অধ্যয়নের এক অনন্য পরিবেশ।
                </p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><span class="text-white-50">প্রতিষ্ঠান ও সেবা</span></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">মাকতাবাতুশ শুব্বান</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <div class="p-3 bg-white rounded-circle shadow-lg d-inline-block text-success" style="width: 170px; height: 170px; display: flex !important; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="fas fa-book-open fa-5x" style="color: #0C4B36;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Introduction Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-3" style="color: #0C4B36;">জ্ঞান অর্জনের উন্মুক্ত দুয়ার</h2>
            <p class="text-muted fs-5 lh-lg">
                "মাকতাবাতুশ শুব্বান" জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর একটি সমৃদ্ধ গবেষণা পাঠাগার। গবেষক, শিক্ষক, শিক্ষার্থী এবং সাধারণ জ্ঞানপিপাসুদের দ্বীনি পিপাসা নিবারণে হাজারো নির্ভরযোগ্য ইসলামিক কিতাব এবং রেফারেন্স বই নিয়ে এটি পরিচালিত হচ্ছে।
            </p>
            <p class="text-muted lh-lg">
                এখানে ক্লাসিক্যাল আরবি কিতাবাদির পাশাপাশি আধুনিক বাংলা ও ইংরেজি সাহিত্যের দুর্লভ সংকলন সংরক্ষিত রয়েছে। মনোরম ও শান্ত পরিবেশে অধ্যয়নের জন্য রয়েছে প্রশস্ত রিডিং রুম ও ওয়াইফাই সুবিধা।
            </p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('publications.books') }}" class="btn btn-success px-4 py-2" style="background: #0C4B36; border: none;">
                    <i class="fas fa-book me-2"></i>অনলাইন কিতাবসমূহ
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-map-marker-alt me-2"></i>পাঠাগারে আসুন
                </a>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border-left: 5px solid #FBB040 !important;">
                <h4 class="fw-bold mb-3" style="color: #0C4B36;"><i class="fas fa-clock text-warning me-2"></i>পাঠাগারের সময়সূচী</h4>
                <ul class="list-unstyled mb-0 text-muted lh-lg">
                    <li><strong class="text-dark">শনিবার - বৃহস্পতিবার:</strong> সকাল ৯:০০ - রাত ৮:০০</li>
                    <li><strong class="text-dark">শুক্রবার:</strong> বিকাল ৩:০০ - রাত ৮:০০</li>
                    <li><strong class="text-dark">স্থান:</strong> জমঈয়ত ভবন, ৭৯/ক/৩, উত্তর যাত্রাবাড়ি, ঢাকা</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Collections Grid -->
    <div class="mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #0C4B36;">আমাদের গ্রন্থ সম্ভার</h2>
            <p class="text-muted">পাঠাগারে সংরক্ষিত বিভিন্ন বিভাগের কিতাব ও গবেষণাপত্র</p>
            <div class="mx-auto" style="width: 70px; height: 3px; background: #FBB040; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e8f5e9; color: #0C4B36;">
                        <i class="fas fa-quran fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">তাফসির ও কুরআন বিজ্ঞান</h4>
                    <p class="text-muted mb-0">তাফসিরে ইবনে কাসির, কুরতুবি, তাবারিসহ বিশ্বখ্যাত প্রাচীন ও আধুনিক তাফসির গ্রন্থসমূহের মূল আরবি ও অনুবাদ সংকলন।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fef3c7; color: #d97706;">
                        <i class="fas fa-scroll fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">সহীহ হাদিস ও শরহ</h4>
                    <p class="text-muted mb-0">কুতুবুস সিত্তাহ (বুখারী, মুসলিম, আবু দাউদ, তিরমিযী, নাসাঈ, ইবনে মাজাহ) এবং তাদের প্রামাণ্য বিশ্লেষণ ও ব্যাখ্যাগ্রন্থ।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-scale-unbalanced fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">আকীদা ও ফিকহুস সুন্নাহ</h4>
                    <p class="text-muted mb-0">তাওহীদ, সালাফী মানহাজ, বিদআত বর্জন এবং দলিলভিত্তিক বিশুদ্ধ ফিকহি মাসআলার ওপর গুরুত্বপূর্ণ কিতাব সম্ভার।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #f3e8ff; color: #9333ea;">
                        <i class="fas fa-landmark fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">ইতিহাস ও জীবনী</h4>
                    <p class="text-muted mb-0">নবী-রাসূলগণের সিরাত, সাহাবায়ে কেরামের আত্মত্যাগ, তাবেঈন ও আহলে হাদীস মনীষীদের জীবনচরিত ও ইতিহাস।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-laptop fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">ডিজিটাল রিসোর্স কর্নার</h4>
                    <p class="text-muted mb-0">শামেলা (المكتبة الشاملة) সফটওয়্যার সমৃদ্ধ কম্পিউটার, ই-বুক এবং অডিও লেকচার কালেকশন নিয়ে ডিজিটাল সুবিধা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #ecfdf5; color: #059669;">
                        <i class="fas fa-print fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">ফটোকপি ও রেফারেন্স সেবা</h4>
                    <p class="text-muted mb-0">গবেষকদের জন্য প্রয়োজনীয় পাতা ফটোকপি ও স্ক্যান করার সুবিধাসহ নিজস্ব ল্যাপটপ নিয়ে কাজ করার সুযোগ।</p>
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
