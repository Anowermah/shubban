@extends('layouts.page')

@section('title', 'শুব্বান পরিচিতি')

@section('page-content')
<div class="content-wrapper">
    <div class="container py-5">
        <!-- Quranic Verses Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">"যখন যুবকরা গুহায় আশ্রয় নিল তখন তারা বলেছিল, হে আমাদের রব। আপনি নিজ থেকে আমাদেরকে অনুগ্রহ দান করুন এবং আমাদের জন্য আমাদের কাজকর্ম সঠিকভাবে পরিচালনার ব্যবস্থা করুন।"</p>
                    <footer class="blockquote-footer mt-2">সূরা আল-কাহফ: ১০ ও ১১</footer>
                </blockquote>
            </div>
        </div>

        <!-- Main Content Sections -->
        <div class="row">
            <!-- Identity Section -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">শুব্বান পরিচিতি</h2>
                        <h4 class="text-primary mb-3">হে যুবক! তোমার পরিচয় জানো কি?</h4>
                        <p>মহান আল্লাহর সুন্দরতম সৃষ্টি মানুষ, অপর দিকে মানুষ মহান আল্লাহর দাস। বিশ্বের সব আয়োজন, সব নিয়ামত এই মানুষেরই প্রয়োজনে। মানুষ বিশ্বের সব আয়োজন, সব নিয়ামত এই মানুষেরই প্রয়োজনে। </p>
                    </div>
                </div>
            </div>

            <!-- Historical Background -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">ঐতিহাসিক ধারাবাহিকতা</h3>
                        <p>১৯৮৯ সালের ২৮ ডিসেম্বর রাজধানী ঢাকার ঐতিহ্যবাহী বংশাল বড় জামে মসজিদে "জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ" আত্মপ্রকাশ করে। বর্তমানে এর সদর দফতর ঢাকার উত্তর যাত্রাবাড়িতে জমঈয়ত ভবনে অবস্থিত।</p>
                    </div>
                </div>
            </div>

            <!-- Objectives Section -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                            <div>
                                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-1">আদর্শ ও লক্ষ্য</span>
                                <h3 class="card-title fw-bold text-dark mb-0">আমাদের মূল লক্ষ্য ও পাঁচ দফা কর্মসূচি</h3>
                            </div>
                            <a href="{{ route('about.goals') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                পূর্ণাঙ্গ লক্ষ্য পেজ <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <!-- মূল লক্ষ্য বক্স -->
                        <div class="p-4 rounded-4 mb-4 text-white" style="background: linear-gradient(135deg, #072e20 0%, #0C4B36 100%); border: 1.5px solid #FBB040;">
                            <span class="badge bg-warning text-dark font-xs fw-bold px-2 py-1 mb-2">
                                <i class="fas fa-bullseye me-1"></i> মূল লক্ষ্য
                            </span>
                            <h4 class="fw-bold mb-2 text-white" style="font-size: 1.3rem; line-height: 1.6;">
                                কালেমা <span style="color: #FBB040;">"লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"</span>-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।
                            </h4>
                        </div>

                        <!-- পাঁচ দফা কর্মসূচি গ্রিড -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fas fa-layer-group text-success me-2"></i>পাঁচ দফা কর্মসূচি:</h5>
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-4">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #e8f5ed; color: #0C4B36; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                            <i class="fas fa-quran"></i>
                                        </div>
                                        <span class="fw-bold text-success">০১. আকীদাহ সংশোধন</span>
                                    </div>
                                    <p class="text-secondary font-sm mb-0">তাওহীদ ও রিসালাতে মুহাম্মাদী সম্পর্কে সঠিক জ্ঞানার্জন ও অনুশীলন।</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #e6f2fa; color: #1565c0; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <span class="fw-bold text-primary">০২. দাওয়াহ ও তাবলীগ</span>
                                    </div>
                                    <p class="text-secondary font-sm mb-0">ছাত্র ও যুব সমাজের নিকট ইসলামের দাওয়াত প্রদান।</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #fff8e7; color: #d99014; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <span class="fw-bold text-warning-emphasis">০৩. সংগঠন ও ব্যবস্থাপনা</span>
                                    </div>
                                    <p class="text-secondary font-sm mb-0">ইসলামী সমাজ প্রতিষ্ঠার লক্ষ্যে যুব সমাজকে ঐক্যবদ্ধ করা।</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #e6fffa; color: #0d9488; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <span class="fw-bold" style="color: #0d9488;">০৪. শিক্ষণ ও প্রশিক্ষণ</span>
                                    </div>
                                    <p class="text-secondary font-sm mb-0">যুব শক্তিকে সুসংগঠিত করার লক্ষ্যে ইসলামের মূলনীতি সম্পর্কে সঠিক জ্ঞানদান।</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #f3e8fa; color: #7e22ce; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                            <i class="fas fa-hands-helping"></i>
                                        </div>
                                        <span class="fw-bold" style="color: #7e22ce;">০৫. সমাজ সংস্কার</span>
                                    </div>
                                    <p class="text-secondary font-sm mb-0">অনৈসলামিক রীতিনীতি প্রতিহত করে কুরআন-সুন্নাহভিত্তিক সমাজ প্রতিষ্ঠা।</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">যোগাযোগ</h3>
                        <p><strong>জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</strong></p>
                        <p>৭৯/ক/৩, উত্তর যাত্রাবাড়ি, ঢাকা-১২০৪</p>
                        <p>মোবাইল: ০১৭৬৫-৮১২২৬১, ০১৯৫৫-৬০০৫২৩</p>
                        <p>ইমেইল: info.shubbanbd@gmail.com</p>
                        <p>ওয়েবসাইট: www.shubbanbd.org</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
