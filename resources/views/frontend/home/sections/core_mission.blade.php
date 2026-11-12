<!-- ========================================================================
     3. CORE MISSION & IDENTITY (আদর্শ, লক্ষ্য ও পাঁচ দফা কর্মসূচি)
     ======================================================================== -->
@php
    $extra = $section->extra_config ?? [];
    $motto = $extra['motto'] ?? 'কালেমা "লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।';
@endphp
<section class="py-4 py-lg-5 bg-white border-bottom">
    <div class="container">
        <div class="text-center mb-3">
            @if($section->badge_text)
                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold mb-2">{{ $section->badge_text }}</span>
            @endif
            <h2 class="fw-bold fs-3 text-dark mb-1">{{ $section->title ?? 'আমাদের মূল লক্ষ্য ও পাঁচ দফা কর্মসূচি' }}</h2>
            @if($section->subtitle)
                <p class="text-muted small mx-auto" style="max-width: 600px;">
                    {{ $section->subtitle }}
                </p>
            @endif
        </div>

        <!-- মূল লক্ষ্য হাইলাইট ব্যানার -->
        <div class="main-objective-box text-center p-3 p-md-4 rounded-4 mb-4 shadow-sm" style="background: linear-gradient(135deg, #072e20 0%, #0C4B36 100%); color: #fff; border: 1.5px solid #FBB040;">
            <div class="small fw-bold text-warning mb-1">
                <i class="fas fa-bullseye me-1"></i> মূল লক্ষ্য
            </div>
            <h3 class="fw-bold mb-1 text-white" style="font-size: 1.25rem; line-height: 1.6;">
                {!! str_replace('"লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"', '<span style="color: #FBB040;">"লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"</span>', e($motto)) !!}
            </h3>
        </div>

        <!-- পাঁচ দফা কর্মসূচি (৫টি স্তম্ভ - মোবাইলে মসৃণ সোয়াইপযোগ্য ট্র্যাক) -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mobile-swipe-track">
            <!-- ১. আকীদাহ সংশোধন -->
            <div class="col">
                <div class="pillar-card text-center h-100">
                    <span class="badge bg-light text-success border font-xs mb-2">দফা ০১</span>
                    <div class="pillar-icon text-success">
                        <i class="fas fa-quran"></i>
                    </div>
                    <h4 class="pillar-title">আকীদাহ সংশোধন</h4>
                    <p class="pillar-text">তাওহীদ ও রিসালাতে মুহাম্মাদী সম্পর্কে সঠিক জ্ঞানার্জন ও অনুশীলন।</p>
                </div>
            </div>

            <!-- ২. দাওয়াহ ও তাবলীগ -->
            <div class="col">
                <div class="pillar-card text-center h-100">
                    <span class="badge bg-light text-primary border font-xs mb-2">দফা ০২</span>
                    <div class="pillar-icon text-primary">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h4 class="pillar-title">দাওয়াহ ও তাবলীগ</h4>
                    <p class="pillar-text">ছাত্র ও যুব সমাজের নিকট ইসলামের দাওয়াত প্রদান।</p>
                </div>
            </div>

            <!-- ৩. সংগঠন ও ব্যবস্থাপনা -->
            <div class="col">
                <div class="pillar-card text-center h-100">
                    <span class="badge bg-light text-warning border font-xs mb-2">দফা ০৩</span>
                    <div class="pillar-icon text-warning">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <h4 class="pillar-title">সংগঠন ও ব্যবস্থাপনা</h4>
                    <p class="pillar-text">ইসলামী সমাজ প্রতিষ্ঠার লক্ষ্যে যুব সমাজকে ঐক্যবদ্ধ করা।</p>
                </div>
            </div>

            <!-- ৪. শিক্ষণ ও প্রশিক্ষণ -->
            <div class="col">
                <div class="pillar-card text-center h-100">
                    <span class="badge bg-light text-teal border font-xs mb-2" style="color: #0d9488;">দফা ০৪</span>
                    <div class="pillar-icon" style="color: #0d9488;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4 class="pillar-title">শিক্ষণ ও প্রশিক্ষণ</h4>
                    <p class="pillar-text">যুব শক্তিকে সুসংগঠিত করার লক্ষ্যে ইসলামের মূলনীতি সম্পর্কে সঠিক জ্ঞানদান।</p>
                </div>
            </div>

            <!-- ৫. সমাজ সংস্কার -->
            <div class="col">
                <div class="pillar-card text-center h-100">
                    <span class="badge bg-light text-purple border font-xs mb-2" style="color: #7e22ce;">দফা ০৫</span>
                    <div class="pillar-icon" style="color: #7e22ce;">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4 class="pillar-title">সমাজ সংস্কার</h4>
                    <p class="pillar-text">অনৈসলামিক রীতিনীতি প্রতিহত করে কুরআন-সুন্নাহভিত্তিক সমাজ প্রতিষ্ঠা।</p>
                </div>
            </div>
        </div>

        <!-- বিস্তারিত লিঙ্ক -->
        <div class="text-center mt-3 pt-2">
            <a href="{{ route('about.goals') }}" class="btn btn-sm btn-outline-success rounded-pill px-4 fw-semibold">
                পূর্ণাঙ্গ লক্ষ্য ও কর্মপন্থা <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
