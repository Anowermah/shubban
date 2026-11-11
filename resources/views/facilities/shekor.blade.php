@extends('layouts.app')

@section('title', 'শিকড় - সাংস্কৃতিক ও যুব বিকাশ পরিষদ')

@section('content')
<!-- Hero Banner -->
<div class="page-header-banner py-5 mb-5" style="background: linear-gradient(135deg, #0C4B36 0%, #176B4E 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-bold rounded-pill">
                    <i class="fas fa-seedling me-1"></i> সংস্কৃতি ও যুব বিকাশ
                </span>
                <h1 class="display-5 fw-bold mb-3 text-white">শিকড় (Shekor)</h1>
                <p class="lead text-white-50 mb-4">
                    ইসলামী আদর্শ, ঐতিহ্য ও শিকড়ের সন্ধানে তরুণ প্রজন্মকে নৈতিক ও সাংস্কৃতিক উৎকর্ষে বিকশিত করার একটি প্রাণবন্ত প্ল্যাটফর্ম।
                </p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="fas fa-home me-1"></i>হোম</a></li>
                        <li class="breadcrumb-item"><span class="text-white-50">প্রতিষ্ঠান ও সেবা</span></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">শিকড়</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <div class="p-3 bg-white rounded-circle shadow-lg d-inline-block" style="width: 170px; height: 170px;">
                    <img src="{{ asset('images/shekor/Shekor.png') }}" alt="Shekor Logo" class="img-fluid rounded-circle p-2" style="max-height: 140px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Introduction Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-3" style="color: #0C4B36;">আমাদের পরিচয় ও উদ্দেশ্য</h2>
            <p class="text-muted fs-5 lh-lg">
                "শিকড়" হলো জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর সাংস্কৃতিক ও তরুণ বিকাশ শাখা। আধুনিক বিশ্বায়নের অপসংস্কৃতির প্রবল স্রোতে যুবসমাজ যেন নিজের ঈমান, ঐতিহ্য ও মৌলিক শিকড় ভুলে না যায়—সেই আত্মপরিচয়ের পুনরুজ্জীবনেই শিকড়ের কাজ।
            </p>
            <p class="text-muted lh-lg">
                সুস্থ বিনোদন, সাহিত্যচর্চা, ইসলামী সঙ্গীত, ক্যালিগ্রাফি এবং বুদ্ধিবৃত্তিক বিতর্কের মাধ্যমে যুবসমাজকে সৃজনশীল ও চরিত্রবান হিসেবে গড়ে তুলতে শিকড় কাজ করে থাকে।
            </p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('contact.index') }}" class="btn btn-success px-4 py-2" style="background: #0C4B36; border: none;">
                    <i class="fas fa-user-plus me-2"></i>শিকড়ে যুক্ত হোন
                </a>
                <a href="{{ route('gallery.index') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-images me-2"></i>কার্যক্রম গ্যালারি
                </a>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #f8fafc; border-left: 5px solid #FBB040 !important;">
                <h4 class="fw-bold mb-3" style="color: #0C4B36;"><i class="fas fa-feather-alt text-warning me-2"></i>আমাদের মূলমন্ত্র</h4>
                <p class="fs-6 fst-italic text-secondary mb-3">
                    "শিকড়ের সাথে নাড়ির টান, সুন্দর সংস্কৃতির জয়গান। পবিত্র ঐতিহ্যে পথ চলি, সত্য ও ন্যায়ের কথা বলি।"
                </p>
                <span class="text-muted small fw-semibold">— শিকড় যুব পরিবার</span>
            </div>
        </div>
    </div>

    <!-- Programs Grid -->
    <div class="mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #0C4B36;">কার্যক্রম ও প্রকল্পসমূহ</h2>
            <p class="text-muted">তরুণদের মেধা ও মননশীলতা বিকাশে শিকড়ের বিভিন্ন কর্মসূচি</p>
            <div class="mx-auto" style="width: 70px; height: 3px; background: #FBB040; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e8f5e9; color: #0C4B36;">
                        <i class="fas fa-microphone-alt fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">হামদ-নাত ও কিরাত আসর</h4>
                    <p class="text-muted mb-0">কুরআনের সুরলহরী এবং সহীহ আকীদাভিত্তিক বিশুদ্ধ নাশিদ ও হামদ-নাত পরিবেশনের প্রশিক্ষণ ও জাতীয় প্রতিযোগিতা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fef3c7; color: #d97706;">
                        <i class="fas fa-pen-nib fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">আরবি ও বাংলা ক্যালিগ্রাফি</h4>
                    <p class="text-muted mb-0">চারুলিপি ও ইসলামিক আর্টের মৌলিক প্রশিক্ষণ, যার মাধ্যমে তরুণেরা নান্দনিক শিল্পকলায় পারদর্শী হয়ে ওঠে।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">বিতর্ক ও বাগ্মীতা চর্চা</h4>
                    <p class="text-muted mb-0">যুক্তিবাদী চিন্তাভাবনা, সুন্দর বাচনভঙ্গি এবং ইসলামী দৃষ্টিকোণ থেকে সমসাময়িক বিষয়ের যৌক্তিক উপস্থাপনার কর্মশালা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #f3e8ff; color: #9333ea;">
                        <i class="fas fa-book-reader fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">সাহিত্য ও সৃজনশীল লেখনী</h4>
                    <p class="text-muted mb-0">গল্প, কবিতা, নিবন্ধ ও মৌলিক চিন্তাধারার ইসলামিক সাহিত্য রচনার পাঠচক্র এবং নবীন লেখকদের দিকনির্দেশনা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-campground fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">যুব সম্মেলন ও স্টাডি ট্যুর</h4>
                    <p class="text-muted mb-0">ভ্রাতৃত্বের বন্ধন জোরদার এবং ঐতিহাসিক ইসলামী নিদর্শন পরিদর্শনের লক্ষ্যে শিক্ষাসফর ও মিলনমেলা।</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 service-card transition-card">
                    <div class="icon-box mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background: #ecfdf5; color: #059669;">
                        <i class="fas fa-user-shield fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0C4B36;">নৈতিক চরিত্র ও জীবনবোধ</h4>
                    <p class="text-muted mb-0">সোশ্যাল মিডিয়া অ্যাডিকশন, অশ্লীলতা ও মাদকের কুফল থেকে তরুণদের রক্ষায় ইতিবাচক আত্মউন্নয়ন ও কাউন্সেলিং।</p>
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
