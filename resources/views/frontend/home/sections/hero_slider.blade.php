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

    <!-- App-Grade 4-Column Quick Services Grid (bKash / MyGP Inspired: Screen < 992px) -->
    <div class="mobile-app-services-section d-lg-none">
        <div class="container px-2 px-sm-3">
            <div class="app-services-card">
                <div class="app-services-grid">
                    <!-- 1. Donation -->
                    <a href="{{ route('donate.index') }}" class="app-service-item">
                        <div class="app-service-squircle rose">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <span class="app-service-label">দান করুন</span>
                    </a>

                    <!-- 2. Books -->
                    <a href="{{ route('publications.books') }}" class="app-service-item">
                        <div class="app-service-squircle amber">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="app-service-label">বই সম্ভার</span>
                    </a>

                    <!-- 3. Training -->
                    <a href="{{ route('training.courses') }}" class="app-service-item">
                        <div class="app-service-squircle indigo">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="app-service-label">প্রশিক্ষণ</span>
                    </a>

                    <!-- 4. Notice -->
                    <a href="{{ route('notice.index') }}" class="app-service-item">
                        <div class="app-service-squircle sky">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <span class="app-service-label">নোটিশ</span>
                    </a>

                    <!-- 5. As-Shifa -->
                    <a href="{{ route('facilities.as-shifa') }}" class="app-service-item">
                        <div class="app-service-squircle coral">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <span class="app-service-label">আস-শিফা</span>
                    </a>

                    <!-- 6. Research -->
                    <a href="{{ route('facilities.research-center') }}" class="app-service-item">
                        <div class="app-service-squircle teal">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <span class="app-service-label">গবেষণা</span>
                    </a>

                    <!-- 7. Leadership -->
                    <a href="{{ route('responsible.district') }}" class="app-service-item">
                        <div class="app-service-squircle violet">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <span class="app-service-label">দায়িত্বশীল</span>
                    </a>

                    <!-- 8. AI Chat Assistant -->
                    <a href="#" class="app-service-item" onclick="if(window.openShubbanAIChat){window.openShubbanAIChat();return false;}">
                        <div class="app-service-squircle emerald">
                            <i class="fas fa-robot"></i>
                        </div>
                        <span class="app-service-label">এআই সহকারী</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
