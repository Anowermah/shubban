<!-- ========================================================================
     2. STATS AT A GLANCE (এক নজরে শুব্বানের সাংগঠনিক শক্তি)
     ======================================================================== -->
@php
    $extra = $section->extra_config ?? [];
    $s1Num = $extra['stat1_num'] ?? '৬৪+';
    $s1Lbl = $extra['stat1_label'] ?? 'জেলা ও উপজেলা শাখা';
    $s2Num = $extra['stat2_num'] ?? '১০,০০০+';
    $s2Lbl = $extra['stat2_label'] ?? 'যুব সদস্য ও কর্মী';
    $s3Num = $extra['stat3_num'] ?? '১৭+';
    $s3Lbl = $extra['stat3_label'] ?? 'প্রকাশিত গ্রন্থ ও পত্রিকা';
    $s4Num = $extra['stat4_num'] ?? '৪ স্তর';
    $s4Lbl = $extra['stat4_label'] ?? 'ধারাবাহিক যুব প্রশিক্ষণ';
@endphp
<section class="stats-section py-2 py-md-4">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <div>
                        <h3 class="stat-number">{{ $s1Num }}</h3>
                        <p class="stat-label">{{ $s1Lbl }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h3 class="stat-number">{{ $s2Num }}</h3>
                        <p class="stat-label">{{ $s2Lbl }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div>
                        <h3 class="stat-number">{{ $s3Num }}</h3>
                        <p class="stat-label">{{ $s3Lbl }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h3 class="stat-number">{{ $s4Num }}</h3>
                        <p class="stat-label">{{ $s4Lbl }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
