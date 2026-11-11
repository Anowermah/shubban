<!-- ========================================================================
     5. 4-TIER YOUTH TRAINING SYSTEM (ধারাবাহিক যুব প্রশিক্ষণ পাঠ্যক্রম)
     ======================================================================== -->
<section class="py-4 py-lg-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            @if($section->badge_text)
                <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold mb-2">{{ $section->badge_text }}</span>
            @endif
            <h2 class="fw-bold fs-3 text-dark">{{ $section->title ?? '৪-স্তরীয় অনন্য প্রশিক্ষণ পাঠ্যক্রম' }}</h2>
            @if($section->subtitle)
                <p class="text-muted small mx-auto" style="max-width: 620px;">
                    {{ $section->subtitle }}
                </p>
            @endif
        </div>

        <div class="row g-3 g-lg-4">
            <!-- Tier 1: Aref -->
            <div class="col-6 col-lg-3">
                <div class="training-tier-card">
                    <span class="tier-step-badge">স্তর ০১</span>
                    <h4 class="tier-name">আরেফ</h4>
                    <p class="tier-focus">মৌলিক আক্বীদা, ফরজিয়াত ও সালাতের নির্ভুল আমল শিক্ষা।</p>
                    <a href="{{ route('training.aref') }}" class="btn-tier-action">
                        <span>সিলেবাস দেখুন</span> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- Tier 2: Saleh -->
            <div class="col-6 col-lg-3">
                <div class="training-tier-card">
                    <span class="tier-step-badge">স্তর ০২</span>
                    <h4 class="tier-name">সালেহ</h4>
                    <p class="tier-focus">আত্মশুদ্ধি, সুন্নাহর অনুশাসন, চারিত্রিক দৃঢ়তা ও মুয়ামালাত।</p>
                    <a href="{{ route('training.saleh') }}" class="btn-tier-action">
                        <span>সিলেবাস দেখুন</span> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- Tier 3: Rageb -->
            <div class="col-6 col-lg-3">
                <div class="training-tier-card">
                    <span class="tier-step-badge">স্তর ০৩</span>
                    <h4 class="tier-name">রাগেব</h4>
                    <p class="tier-focus">ইসলামি সমাজবিজ্ঞান, সমকালীন প্রেক্ষাপট ও সাংগঠনিক দক্ষতা।</p>
                    <a href="{{ route('training.rageb') }}" class="btn-tier-action">
                        <span>সিলেবাস দেখুন</span> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- Tier 4: Salek -->
            <div class="col-6 col-lg-3">
                <div class="training-tier-card">
                    <span class="tier-step-badge">স্তর ০৪</span>
                    <h4 class="tier-name">সালেক</h4>
                    <p class="tier-focus">দাওয়াহ ব্যবস্থাপনা, উম্মাহর নেতৃত্ব ও উচ্চতর গবেষণা।</p>
                    <a href="{{ route('training.salek') }}" class="btn-tier-action">
                        <span>সিলেবাস দেখুন</span> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('training.courses') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                <i class="fas fa-graduation-cap me-1"></i> সকল প্রশিক্ষণ কোর্সের তথ্য ও সিলেবাস
            </a>
        </div>
    </div>
</section>
