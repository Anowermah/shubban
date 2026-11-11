<!-- ========================================================================
     1. HERO SLIDER & NOTICE TICKER
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
                                <p>{{ $slider->subtitle }}</p>
                            @elseif($slider->description)
                                <p>{{ Str::limit($slider->description, 110) }}</p>
                            @endif
                            <div>
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
                                <a href="{{ route('donate.index') }}" class="btn btn-sm btn-outline-warning text-white rounded-pill px-3 py-2 ms-2 fw-semibold">
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
                            <p>একটি ঐতিহ্যবাহী অরাজনৈতিক ছাত্র ও যুব আন্দোলন — যুব সমাজের আত্মশুদ্ধি ও মানবতার সেবায় নিবেদিত।</p>
                            <a href="{{ route('about.introduction') }}" class="btn-slider-cta">
                                <span>আমাদের সম্পর্কে</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($sliders->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev" aria-label="পূর্ববর্তী">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next" aria-label="পরবর্তী">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            @endif
        </div>
    </div>

    <!-- Latest Notice Ticker Strip -->
    @if(isset($notices) && $notices->isNotEmpty())
        @php $topNotice = $notices->first(); @endphp
        <div class="notice-ticker-bar">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1">
                        <span class="ticker-badge">
                            <i class="fas fa-bullhorn"></i> {{ $section->badge_text ?? 'সর্বশেষ নোটিশ' }}
                        </span>
                        <div class="ticker-content text-truncate">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#noticeModal{{ $topNotice->id }}">
                                {{ $topNotice->title }}
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-white-50 small d-none d-md-inline">
                            <i class="far fa-calendar-alt me-1"></i> {{ $topNotice->created_at->format('d/m/Y') }}
                        </span>
                        <a href="{{ route('notice.index') }}" class="badge bg-warning text-dark text-decoration-none px-2 py-1">
                            সকল নোটিশ <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
