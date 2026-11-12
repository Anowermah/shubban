<!-- ========================================================================
     1. HERO SLIDER & NOTICE TICKER (উন্নত ও মিনমাল মোবাইল রেসপন্সিভ)
     ======================================================================== -->
<section class="hero-section">
    <div class="hero-slider-wrap">
        <div id="heroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            @if($sliders->count() > 1)
                <div class="carousel-indicators">
                    @foreach($sliders as $key => $slider)
                        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" 
                            aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                            aria-label="Slide {{ $key + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="carousel-inner">
                @forelse($sliders as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                        <div class="carousel-caption">
                            <h2>{{ $slider->title }}</h2>
                            @if($slider->subtitle)
                                <p class="d-none d-md-block">{{ $slider->subtitle }}</p>
                            @elseif($slider->description)
                                <p class="d-none d-md-block">{{ Str::limit($slider->description, 110) }}</p>
                            @endif
                            <div class="slider-btn-group">
                                @if($slider->button_text && $slider->button_link)
                                    <a href="{{ $slider->button_link }}" class="btn-slider-cta">
                                        <span>{{ $slider->button_text }}</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @else
                                    <a href="{{ route('about.introduction') }}" class="btn-slider-cta">
                                        <span>পরিচিতি দেখুন</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endif
                                <a href="{{ route('donate.index') }}" class="btn btn-sm btn-outline-warning text-white rounded-pill px-3 py-2 ms-2 fw-semibold d-none d-sm-inline-block">
                                    <i class="fas fa-hand-holding-heart me-1"></i> অনুদান দিন
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('images/slider1.jpg') }}" class="d-block w-100" alt="Shubban Banner">
                        <div class="carousel-caption">
                            <h2>জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ</h2>
                            <p class="d-none d-md-block">একটি ঐতিহ্যবাহী অরাজনৈতিক ছাত্র ও যুব আন্দোলন — যুব সমাজের আত্মশুদ্ধি ও মানবতার সেবায় নিবেদিত।</p>
                            <div class="slider-btn-group">
                                <a href="{{ route('about.introduction') }}" class="btn-slider-cta">
                                    <span>আমাদের সম্পর্কে</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($sliders->count() > 1)
                <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#heroSlider" data-bs-slide="prev" aria-label="পূর্ববর্তী">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#heroSlider" data-bs-slide="next" aria-label="পরবর্তী">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            @endif
        </div>
    </div>

    <!-- Latest Notice Ticker Strip -->
    @if(isset($notices) && $notices->isNotEmpty())
        @php $topNotice = $notices->first(); @endphp
        <div class="notice-ticker-bar">
            <div class="container px-2 px-sm-3">
                <div class="d-flex align-items-center justify-content-between gap-2 py-1">
                    <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1">
                        <span class="ticker-badge">
                            <i class="fas fa-bullhorn"></i> <span class="d-none d-sm-inline">{{ $section->badge_text ?? 'সর্বশেষ' }}</span>
                        </span>
                        <div class="ticker-content text-truncate">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#noticeModal{{ $topNotice->id }}" class="text-white text-decoration-none small fw-semibold">
                                {{ $topNotice->title }}
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        <a href="{{ route('notice.index') }}" class="badge bg-warning text-dark text-decoration-none px-2 py-1" style="font-size: 0.72rem;">
                            সকল নোটিশ <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- App-Style Minimal Quick Actions Bar (Mobile Only: Screen < 992px) -->
    <div class="mobile-quick-actions-bar d-lg-none">
        <div class="container px-2">
            <div class="quick-actions-track">
                <a href="{{ route('notice.index') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-warning-subtle text-warning-emphasis">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <span class="quick-action-title">নোটিশ</span>
                </a>
                <a href="{{ route('publications.books') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-success-subtle text-success">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <span class="quick-action-title">বই সম্ভার</span>
                </a>
                <a href="{{ route('responsible.district') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-info-subtle text-info-emphasis">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <span class="quick-action-title">দায়িত্বশীল</span>
                </a>
                <a href="{{ route('training.courses') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-primary-subtle text-primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="quick-action-title">প্রশিক্ষণ</span>
                </a>
                <a href="{{ route('donate.index') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-danger-subtle text-danger">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <span class="quick-action-title">দান করুন</span>
                </a>
                <a href="{{ route('gallery.photos') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-secondary-subtle text-secondary">
                        <i class="fas fa-images"></i>
                    </div>
                    <span class="quick-action-title">ছবি</span>
                </a>
                <a href="{{ route('gallery.videos') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-danger-subtle text-danger">
                        <i class="fab fa-youtube"></i>
                    </div>
                    <span class="quick-action-title">ভিডিও</span>
                </a>
                <a href="{{ route('contact.index') }}" class="quick-action-pill">
                    <div class="quick-action-icon bg-success-subtle text-success">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <span class="quick-action-title">যোগাযোগ</span>
                </a>
            </div>
        </div>
    </div>
</section>
