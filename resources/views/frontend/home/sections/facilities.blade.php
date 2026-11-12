<!-- ========================================================================
     4. SPECIALIZED FACILITIES (৪টি মূল অঙ্গ-প্রতিষ্ঠান)
     ======================================================================== -->
<section class="py-4 py-lg-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                @if($section->badge_text)
                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1 rounded-pill fw-bold mb-1">{{ $section->badge_text }}</span>
                @endif
                <h2 class="fw-bold fs-3 text-dark mb-0">{{ $section->title ?? 'আমাদের মূল বিভাগ ও শাখা' }}</h2>
                @if($section->subtitle)
                    <p class="text-muted small mb-0 mt-1">{{ $section->subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('about.introduction') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                বিস্তারিত পরিচিতি <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3 g-lg-4 mobile-swipe-track facilities-swipe-track">
            <!-- Research Center -->
            <div class="col-6 col-lg-3">
                <div class="facility-card">
                    <div class="facility-header">
                        <div class="facility-icon research">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h3 class="facility-title">শুব্বান রিসার্চ সেন্টার</h3>
                    </div>
                    <p class="facility-desc">কুরআন-সুন্নাহ ভিত্তিক গবেষণামূলক প্রবন্ধ, সমকালীন সমস্যার শরয়ী সমাধান ও ফতোয়া সেবা।</p>
                    <a href="{{ route('facilities.research-center') }}" class="btn-facility-link">
                        <span>প্রবেশ করুন</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Shekor -->
            <div class="col-6 col-lg-3">
                <div class="facility-card">
                    <div class="facility-header">
                        <div class="facility-icon shekor">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h3 class="facility-title">শেকড়</h3>
                    </div>
                    <p class="facility-desc">ছাত্র ও যুবসমাজের মেধা বিকাশ, সুস্থ সাংস্কৃতিক বিনির্মাণ ও দাওয়াতি কার্যক্রমের প্লাটফর্ম।</p>
                    <a href="{{ route('facilities.shekor') }}" class="btn-facility-link">
                        <span>প্রবেশ করুন</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- As-Shifa -->
            <div class="col-6 col-lg-3">
                <div class="facility-card">
                    <div class="facility-header">
                        <div class="facility-icon shifa">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3 class="facility-title">আস-শিফা</h3>
                    </div>
                    <p class="facility-desc">বিনামূল্যে চিকিৎসা ক্যাম্প, ঔষধ বিতরণ, রক্তদান নেটওয়ার্ক ও দুর্যোগকালীন জরুরি মানবিক সেবা।</p>
                    <a href="{{ route('facilities.as-shifa') }}" class="btn-facility-link">
                        <span>প্রবেশ করুন</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Maktabah -->
            <div class="col-6 col-lg-3">
                <div class="facility-card">
                    <div class="facility-header">
                        <div class="facility-icon maktabah">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="facility-title">মাকতাবাতুশ শুব্বান</h3>
                    </div>
                    <p class="facility-desc">ইসলামি সাহিত্য ও পাণ্ডুলিপির সমৃদ্ধ কেন্দ্রীয় পাঠাগার এবং কিতাব প্রকাশনা প্রদর্শনী কেন্দ্র।</p>
                    <a href="{{ route('facilities.maktabah') }}" class="btn-facility-link">
                        <span>প্রবেশ করুন</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
