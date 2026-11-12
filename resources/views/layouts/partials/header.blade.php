<!-- ==========================================================================
     DESKTOP HEADER (Screen >= 992px)
     ========================================================================== -->
<div class="desktop-header-wrap d-none d-lg-block">
    <!-- Top Bar -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center gy-2">
                <div class="col-lg-5 col-12 text-center text-lg-start">
                    <div class="header-contact">
                        <a href="mailto:{{ __('messages.email_address') }}" class="me-3">
                            <i class="fas fa-envelope"></i> {{ __('messages.email_address') }}
                        </a>
                        <a href="tel:{{ __('messages.phone_number') }}">
                            <i class="fas fa-phone"></i> {{ __('messages.phone_number') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <div class="d-flex justify-content-center justify-content-lg-end align-items-center flex-wrap gap-3">
                        <div class="social-links">
                            <a href="https://www.facebook.com/shubban" target="_blank" rel="noopener noreferrer" title="{{ __('messages.facebook') }}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" title="{{ __('messages.twitter') }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.youtube.com/@ShubbanDawah" target="_blank" rel="noopener noreferrer" title="{{ __('messages.youtube') }}">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" title="{{ __('messages.instagram') }}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                        <div class="language-selector">
                            <a href="{{ route('language.switch', 'bn') }}" class="{{ app()->getLocale() == 'bn' ? 'active' : '' }}">{{ __('messages.bengali') }}</a>
                            <span class="separator">|</span>
                            <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">{{ __('messages.english') }}</a>
                            <span class="separator">|</span>
                            <a href="{{ route('language.switch', 'ar') }}" class="{{ app()->getLocale() == 'ar' ? 'active' : '' }}" dir="rtl">{{ __('messages.arabic') }}</a>
                        </div>
                        
                        @if(!isset($themeSettings['enable_theme_switcher']) || $themeSettings['enable_theme_switcher'])
                            <!-- Night / Day Mode Toggle (Desktop) -->
                            <button type="button" class="btn btn-mode-toggle" id="globalThemeModeToggle" aria-label="নাইট/ডে মোড পরিবর্তন" title="নাইট / ডে মোড পরিবর্তন">
                                <i class="fas fa-moon mode-icon-night"></i>
                                <i class="fas fa-sun mode-icon-day"></i>
                            </button>
                        @endif

                        <!-- Guest & User Auth Controls -->
                        <div class="header-auth-status ms-1 ps-2 border-start border-light border-opacity-25">
                            @auth
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-sm btn-outline-light dropdown-toggle px-2 py-1 rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.82rem; border-color: rgba(255,255,255,0.35);">
                                        <i class="fas fa-user-circle text-warning me-1"></i> {{ Str::limit(Auth::user()->name, 12) }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-1" style="min-width: 210px; z-index: 1060;">
                                        <li class="px-3 py-2 border-bottom bg-light">
                                            <span class="d-block fw-bold text-dark font-sm">{{ Auth::user()->name }}</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</small>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('user.dashboard') }}">
                                                <i class="fas fa-tachometer-alt me-2 text-success"></i> আমার ড্যাশবোর্ড
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('user.profile') }}">
                                                <i class="fas fa-user-cog me-2 text-primary"></i> তথ্য ও পাসওয়ার্ড
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item py-2 text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i> লগআউট
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="topbar-auth-links d-inline-flex align-items-center gap-2">
                                    <span class="badge rounded-pill bg-white text-dark px-2 py-1" style="font-size: 0.75rem; font-weight: 500; opacity: 0.95;" title="আপনি বর্তমানে গেস্ট হিসেবে ব্রাউজ করছেন">
                                        <i class="fas fa-user text-muted me-1"></i> গেস্ট
                                    </span>
                                    <a href="{{ route('login') }}" class="btn btn-sm text-white px-2 py-1 rounded" style="font-size: 0.8rem; background: rgba(255,255,255,0.18); text-decoration: none;">
                                        <i class="fas fa-sign-in-alt me-1"></i> লগইন
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-sm text-dark px-2 py-1 rounded fw-bold" style="font-size: 0.8rem; background: #FBB040; text-decoration: none;">
                                        <i class="fas fa-user-plus me-1"></i> নিবন্ধন
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header py-3">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-lg-8 col-12 text-center text-lg-start">
                    <a href="{{ url('/') }}" class="logo-container d-inline-flex flex-column flex-sm-row align-items-center text-center text-sm-start text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo" class="logo-img me-sm-3 mb-2 mb-sm-0">
                        <div class="logo-text">
                            <h1 class="org-title-bn">{{ __('messages.organization_name_bn') }}</h1>
                            <h2 class="org-title-en">{{ __('messages.organization_name_en') }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="header-actions justify-content-center justify-content-lg-end">
                        <div class="search-box w-100" style="max-width: 320px;">
                            <form action="{{ route('search') }}" method="GET" class="position-relative">
                                <input type="text" name="q" class="form-control rounded-pill pe-5" placeholder="{{ __('messages.search_placeholder') }}" required style="padding: 9px 45px 9px 18px;">
                                <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-1 border-0" style="color: #0C4B36 !important;" aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Navigation Bar -->
        <nav class="navbar navbar-expand-lg main-nav mt-3">
            <div class="container">
                <div class="collapse navbar-collapse show" id="desktopMainNavbar">
                    <ul class="navbar-nav">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fas fa-home"></i> <span>{{ __('messages.home') }}</span>
                            </a>
                        </li>

                        <!-- About Us -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('about*') || request()->is('facilities*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-info-circle"></i> <span>{{ __('messages.about_us') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('about.introduction') }}"><i class="fas fa-users"></i> {{ __('messages.introduction') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('about.history') }}"><i class="fas fa-history"></i> {{ __('messages.history') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('about.goals') }}"><i class="fas fa-bullseye"></i> {{ __('messages.goals') }}</a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item" href="{{ route('facilities.research-center') }}"><i class="fas fa-microscope"></i> {{ __('messages.research_center') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('facilities.shekor') }}"><i class="fas fa-seedling"></i> {{ __('messages.shekor') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('facilities.as-shifa') }}"><i class="fas fa-heartbeat"></i> {{ __('messages.as_shifa') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('facilities.maktabah') }}"><i class="fas fa-book-reader"></i> {{ __('messages.maktabah') }}</a></li>
                            </ul>
                        </li>

                        <!-- Gallery -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('gallery*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-images"></i> <span>{{ __('messages.gallery') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('gallery.photos') }}"><i class="fas fa-image"></i> {{ __('messages.photo_gallery') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('gallery.videos') }}"><i class="fas fa-video"></i> {{ __('messages.video_gallery') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('gallery.archives') }}"><i class="fas fa-archive"></i> {{ __('messages.archive') }}</a></li>
                            </ul>
                        </li>

                        <!-- Publications -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('publications*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-book"></i> <span>{{ __('messages.publications') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('publications.books') }}"><i class="fas fa-book"></i> {{ __('messages.books') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('publications.magazines') }}"><i class="fas fa-newspaper"></i> {{ __('messages.magazines') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('publications.articles') }}"><i class="fas fa-feather-alt"></i> {{ __('messages.articles') }}</a></li>
                            </ul>
                        </li>

                        <!-- Responsible / Management -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('responsible*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-users-cog"></i> <span>{{ __('messages.responsible_persons') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('responsible.central') }}"><i class="fas fa-building"></i> {{ __('messages.central_responsible') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('responsible.district') }}"><i class="fas fa-city"></i> {{ __('messages.district_responsible') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('responsible.upazila') }}"><i class="fas fa-map-marker-alt"></i> {{ __('messages.upazila_responsible') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('responsible.thana') }}"><i class="fas fa-map-pin"></i> {{ __('messages.thana_responsible') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('responsible.branch') }}"><i class="fas fa-code-branch"></i> {{ __('messages.branch_responsible') }}</a></li>
                            </ul>
                        </li>

                        <!-- Events / Activities -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('events*') || request()->is('activities*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i> <span>{{ __('messages.events') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('activities.index') }}"><i class="fas fa-tasks"></i> সকল কার্যক্রম</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.upcoming') }}"><i class="fas fa-calendar-day"></i> {{ __('messages.upcoming_events') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.past') }}"><i class="fas fa-calendar-check"></i> {{ __('messages.past_events') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.annual') }}"><i class="fas fa-star"></i> {{ __('messages.annual_events') }}</a></li>
                            </ul>
                        </li>

                        <!-- Central Committee & Structure -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('central*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-building"></i> <span>{{ __('messages.central_office') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('central/committee') }}"><i class="fas fa-users"></i> {{ __('messages.committee') }}</a></li>
                                <li><a class="dropdown-item" href="{{ url('central/departments') }}"><i class="fas fa-sitemap"></i> {{ __('messages.departments') }}</a></li>
                                <li><a class="dropdown-item" href="{{ url('central/officials') }}"><i class="fas fa-user-tie"></i> {{ __('messages.officials') }}</a></li>
                            </ul>
                        </li>

                        <!-- Training -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('training*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fas fa-graduation-cap"></i> <span>{{ __('messages.training') }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('training.courses') }}"><i class="fas fa-book-reader"></i> {{ __('messages.training_courses') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('training.aref') }}"><i class="fas fa-user-graduate"></i> {{ __('messages.aref_training') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('training.rageb') }}"><i class="fas fa-user-graduate"></i> {{ __('messages.rageb_training') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('training.salek') }}"><i class="fas fa-user-graduate"></i> {{ __('messages.salek_training') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('training.saleh') }}"><i class="fas fa-user-graduate"></i> {{ __('messages.saleh_training') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('training.self-development') }}"><i class="fas fa-brain"></i> {{ __('messages.self_development') }}</a></li>
                            </ul>
                        </li>

                        <!-- Contact Us -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                                <i class="fas fa-envelope"></i> <span>{{ __('messages.contact_us') }}</span>
                            </a>
                        </li>

                        <!-- Donate -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('donate*') ? 'active' : '' }}" href="{{ route('donate.index') }}">
                                <i class="fas fa-hand-holding-heart"></i> <span>{{ __('messages.donate') }}</span>
                            </a>
                        </li>   
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>

<!-- ==========================================================================
     MOBILE MODERN HEADER BAR (Screen < 992px)
     ========================================================================== -->
<header class="mobile-header-bar sticky-top d-lg-none">
    <a href="{{ url('/') }}" class="mobile-brand" title="জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ">
        <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo" class="mobile-brand-img">
    </a>

    <div class="mobile-header-actions">
        @if(!isset($themeSettings['enable_theme_switcher']) || $themeSettings['enable_theme_switcher'])
            <!-- Mobile Night / Day Toggle -->
            <button type="button" class="btn-mode-toggle" id="mobileThemeModeToggle" aria-label="নাইট/ডে মোড" title="নাইট/ডে মোড">
                <i class="fas fa-moon mode-icon-night"></i>
                <i class="fas fa-sun mode-icon-day"></i>
            </button>
        @endif

        <!-- Search Trigger Button -->
        <button type="button" class="btn-mobile-search" data-bs-toggle="modal" data-bs-target="#mobileSearchModal" aria-label="অনুসন্ধান">
            <i class="fas fa-search"></i>
        </button>

        <!-- Quick Donate Pill -->
        <a href="{{ route('donate.index') }}" class="btn-mobile-donate">
            <i class="fas fa-hand-holding-heart"></i> দান
        </a>

        <!-- User / Auth Quick Button -->
        @auth
            <a href="{{ route('user.dashboard') }}" class="btn-mobile-auth text-decoration-none" title="আমার ড্যাশবোর্ড" style="width: 34px; height: 34px; border-radius: 50%; background: #0C4B36; color: #FBB040; display: inline-flex; align-items: center; justify-content: center; font-size: 0.88rem; font-weight: bold; border: 1.5px solid #FBB040;">
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-mobile-auth text-decoration-none" title="লগইন বা গেস্ট" style="width: 34px; height: 34px; border-radius: 50%; background: #eef5f1; color: #0C4B36; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; border: 1px solid #c0d8cb;">
                <i class="fas fa-user"></i>
            </a>
        @endauth

        <!-- Offcanvas Drawer Toggle -->
        <button type="button" class="btn-mobile-menu-toggle" data-bs-toggle="offcanvas" data-bs-target="#mobileDrawer" aria-controls="mobileDrawer" aria-label="মেনু খুলুন">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- ==========================================================================
     MOBILE SEARCH MODAL
     ========================================================================== -->
<div class="modal fade mobile-search-modal" id="mobileSearchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header py-3 px-3" style="background: linear-gradient(90deg, #07281d 0%, #0C4B36 100%);">
                <h5 class="modal-title fs-6 text-white fw-bold">
                    <i class="fas fa-search text-warning me-2"></i> ওয়েবসাইট অনুসন্ধান
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form action="{{ route('search') }}" method="GET" class="position-relative mb-3">
                    <input type="text" name="q" class="form-control form-control-lg rounded-pill pe-5" placeholder="বই, নোটিশ, কার্যক্রম বা বিষয় খুঁজুন..." autofocus required style="font-size: 0.95rem; padding-left: 18px;">
                    <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-2 rounded-circle" style="background: #0C4B36; color: #fff; width: 38px; height: 38px; padding: 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <div class="small fw-semibold text-muted mb-2">জনপ্রিয় অনুসন্ধান:</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('search', ['q' => 'বই']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">বইসমূহ</a>
                    <a href="{{ route('search', ['q' => 'প্রশিক্ষণ']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">প্রশিক্ষণ</a>
                    <a href="{{ route('search', ['q' => 'আস-শিফা']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">আস-শিফা</a>
                    <a href="{{ route('search', ['q' => 'শেকড়']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">শেকড়</a>
                    <a href="{{ route('search', ['q' => 'সম্মেলন']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">সম্মেলন</a>
                    <a href="{{ route('search', ['q' => 'নোটিশ']) }}" class="badge bg-light text-dark border text-decoration-none py-2 px-3 rounded-pill">নোটিশ</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     OFFCANVAS MOBILE APP DRAWER
     ========================================================================== -->
<div class="offcanvas offcanvas-start mobile-app-drawer" tabindex="-1" id="mobileDrawer" aria-labelledby="mobileDrawerLabel">
    <!-- Drawer Header -->
    <div class="mobile-drawer-header">
        <a href="{{ url('/') }}" class="drawer-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo">
            <div>
                <h5 class="drawer-brand-title" id="mobileDrawerLabel">জমঈয়ত শুব্বান</h5>
                <span class="drawer-brand-sub">আহলে হাদীস বাংলাদেশ</span>
            </div>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Drawer Body -->
    <div class="mobile-drawer-body">
        <!-- Drawer User/Guest Card -->
        <div class="drawer-user-card mb-3">
            @auth
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: linear-gradient(135deg, #072b1f 0%, #0C4B36 100%); color: #fff;">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <div style="width: 40px; height: 40px; background: #FBB040; color: #0C4B36; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; flex-shrink: 0;">
                            {{ mb_substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <div class="fw-bold text-truncate" style="font-size: 0.92rem;">{{ Auth::user()->name }}</div>
                            <small class="text-truncate d-block" style="font-size: 0.75rem; opacity: 0.85;">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 py-1 flex-shrink-0 ms-2" style="font-size: 0.78rem;">
                        ড্যাশবোর্ড
                    </a>
                </div>
            @else
                <div class="p-3 rounded-3 border" style="background: #f7faf8; border-color: #c9ddd1 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge rounded-pill bg-success text-white px-2 py-1" style="font-size: 0.72rem;">
                            <i class="fas fa-user-shield me-1"></i> গেস্ট মোড সক্রিয়
                        </span>
                        <span class="text-muted" style="font-size: 0.75rem;">অতিথি ব্রাউজার</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-success flex-fill rounded-pill py-1 fw-bold" style="font-size: 0.82rem;">
                            <i class="fas fa-sign-in-alt me-1"></i> লগইন
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-success flex-fill rounded-pill py-1 text-white fw-bold" style="font-size: 0.82rem; background: #0C4B36;">
                            <i class="fas fa-user-plus me-1"></i> নিবন্ধন
                        </a>
                    </div>
                </div>
            @endauth
        </div>

        <!-- In-Drawer Search Box -->
        <div class="drawer-search-box">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" placeholder="ওয়েবসাইটে খুঁজুন..." required>
                <button type="submit" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Menu Navigation List -->
        <ul class="drawer-menu-list">
            <!-- Home -->
            <li class="drawer-menu-item">
                <a href="{{ url('/') }}" class="drawer-menu-link {{ request()->is('/') ? 'active' : '' }}">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-home"></i> <span>হোম</span>
                    </span>
                </a>
            </li>

            <!-- About Us Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerAboutSub" role="button" aria-expanded="false" aria-controls="drawerAboutSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-info-circle"></i> <span>আমাদের সম্পর্কে</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerAboutSub">
                    <a href="{{ route('about.introduction') }}" class="drawer-sub-link"><i class="fas fa-users"></i> পরিচিতি</a>
                    <a href="{{ route('about.history') }}" class="drawer-sub-link"><i class="fas fa-history"></i> ইতিহাস</a>
                    <a href="{{ route('about.goals') }}" class="drawer-sub-link"><i class="fas fa-bullseye"></i> লক্ষ্য ও উদ্দেশ্য</a>
                    <a href="{{ route('facilities.research-center') }}" class="drawer-sub-link"><i class="fas fa-microscope"></i> শুব্বান রিসার্চ সেন্টার</a>
                    <a href="{{ route('facilities.shekor') }}" class="drawer-sub-link"><i class="fas fa-seedling"></i> শেকড়</a>
                    <a href="{{ route('facilities.as-shifa') }}" class="drawer-sub-link"><i class="fas fa-heartbeat"></i> আস-শিফা (মেডিকেল)</a>
                    <a href="{{ route('facilities.maktabah') }}" class="drawer-sub-link"><i class="fas fa-book-reader"></i> মাকতাবাতুশ শুব্বান</a>
                </div>
            </li>

            <!-- Publications Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerPubSub" role="button" aria-expanded="false" aria-controls="drawerPubSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-book-open"></i> <span>প্রকাশনা ও সাহিত্য</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerPubSub">
                    <a href="{{ route('publications.books') }}" class="drawer-sub-link"><i class="fas fa-book"></i> বই সমূহ</a>
                    <a href="{{ route('publications.magazines') }}" class="drawer-sub-link"><i class="fas fa-newspaper"></i> মাসিক ম্যাগাজিন</a>
                    <a href="{{ route('publications.articles') }}" class="drawer-sub-link"><i class="fas fa-feather-alt"></i> গবেষণা প্রবন্ধ ও নিবন্ধ</a>
                </div>
            </li>

            <!-- Training Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerTrainSub" role="button" aria-expanded="false" aria-controls="drawerTrainSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-graduation-cap"></i> <span>যুব প্রশিক্ষণ</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerTrainSub">
                    <a href="{{ route('training.courses') }}" class="drawer-sub-link"><i class="fas fa-book-reader"></i> সকল প্রশিক্ষণ কোর্স</a>
                    <a href="{{ route('training.aref') }}" class="drawer-sub-link"><i class="fas fa-user-graduate"></i> স্তর ০১: আরেফ</a>
                    <a href="{{ route('training.saleh') }}" class="drawer-sub-link"><i class="fas fa-user-graduate"></i> স্তর ০২: সালেহ</a>
                    <a href="{{ route('training.rageb') }}" class="drawer-sub-link"><i class="fas fa-user-graduate"></i> স্তর ০৩: রাগেব</a>
                    <a href="{{ route('training.salek') }}" class="drawer-sub-link"><i class="fas fa-user-graduate"></i> স্তর ০৪: সালেক</a>
                </div>
            </li>

            <!-- Responsible Persons Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerRespSub" role="button" aria-expanded="false" aria-controls="drawerRespSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-users-cog"></i> <span>দায়িত্বশীল পরিষদ</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerRespSub">
                    <a href="{{ route('responsible.central') }}" class="drawer-sub-link"><i class="fas fa-building"></i> কেন্দ্রীয় দায়িত্বশীল</a>
                    <a href="{{ route('responsible.district') }}" class="drawer-sub-link"><i class="fas fa-city"></i> জেলা দায়িত্বশীল</a>
                    <a href="{{ route('responsible.upazila') }}" class="drawer-sub-link"><i class="fas fa-map-marker-alt"></i> উপজেলা দায়িত্বশীল</a>
                    <a href="{{ route('responsible.branch') }}" class="drawer-sub-link"><i class="fas fa-code-branch"></i> শাখা দায়িত্বশীল</a>
                </div>
            </li>

            <!-- Activities Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerActSub" role="button" aria-expanded="false" aria-controls="drawerActSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-calendar-check"></i> <span>কার্যক্রম ও ইভেন্ট</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerActSub">
                    <a href="{{ route('activities.index') }}" class="drawer-sub-link"><i class="fas fa-tasks"></i> সকল কার্যক্রম</a>
                    <a href="{{ route('events.upcoming') }}" class="drawer-sub-link"><i class="fas fa-calendar-day"></i> আসন্ন ইভেন্ট</a>
                    <a href="{{ route('events.past') }}" class="drawer-sub-link"><i class="fas fa-history"></i> বিগত ইভেন্ট</a>
                    <a href="{{ route('events.annual') }}" class="drawer-sub-link"><i class="fas fa-star"></i> বার্ষিক সম্মেলন</a>
                </div>
            </li>

            <!-- Gallery Submenu -->
            <li class="drawer-menu-item">
                <a class="drawer-menu-link collapsed" data-bs-toggle="collapse" href="#drawerGalSub" role="button" aria-expanded="false" aria-controls="drawerGalSub">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-images"></i> <span>গ্যালারি ও মিডিয়া</span>
                    </span>
                    <i class="fas fa-chevron-down drawer-chevron"></i>
                </a>
                <div class="collapse drawer-submenu-collapse" id="drawerGalSub">
                    <a href="{{ route('gallery.photos') }}" class="drawer-sub-link"><i class="fas fa-image"></i> ফটো গ্যালারি</a>
                    <a href="{{ route('gallery.videos') }}" class="drawer-sub-link"><i class="fas fa-video"></i> ভিডিও গ্যালারি</a>
                    <a href="{{ route('gallery.archives') }}" class="drawer-sub-link"><i class="fas fa-archive"></i> ঐতিহাসিক ফটো আর্কাইভ</a>
                </div>
            </li>

            <!-- Notice Board -->
            <li class="drawer-menu-item">
                <a href="{{ route('notice.index') }}" class="drawer-menu-link {{ request()->is('notice*') ? 'active' : '' }}">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-bell"></i> <span>নোটিশ বোর্ড</span>
                    </span>
                </a>
            </li>

            <!-- Contact Us -->
            <li class="drawer-menu-item">
                <a href="{{ route('contact.index') }}" class="drawer-menu-link {{ request()->is('contact*') ? 'active' : '' }}">
                    <span class="drawer-menu-link-left">
                        <i class="fas fa-envelope"></i> <span>যোগাযোগ ও অফিস</span>
                    </span>
                </a>
            </li>
        </ul>

        <!-- Quick Action Donate Card -->
        <div class="drawer-actions-card">
            <a href="{{ route('donate.index') }}" class="btn-drawer-donate">
                <i class="fas fa-hand-holding-heart"></i> এক ক্লিকে অনুদান দিন
            </a>
            <div class="drawer-contacts-row">
                <a href="tel:01712345678" class="drawer-contact-btn">
                    <i class="fas fa-phone-alt"></i> কল করুন
                </a>
                <a href="mailto:info.shubbanbd@gmail.com" class="drawer-contact-btn">
                    <i class="fas fa-envelope"></i> ইমেইল
                </a>
            </div>
        </div>

        <!-- Language Selector inside Drawer -->
        <div class="drawer-lang-wrap">
            <a href="{{ route('language.switch', 'bn') }}" class="drawer-lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}">বাংলা</a>
            <a href="{{ route('language.switch', 'en') }}" class="drawer-lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
            <a href="{{ route('language.switch', 'ar') }}" class="drawer-lang-btn {{ app()->getLocale() == 'ar' ? 'active' : '' }}" dir="rtl">العربية</a>
        </div>

        <!-- Social Media Links -->
        <div class="drawer-social-links">
            <a href="https://www.facebook.com/shubban" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com/@ShubbanDawah" target="_blank" rel="noopener noreferrer" title="YouTube"><i class="fab fa-youtube"></i></a>
            <a href="#" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>

<!-- ==========================================================================
     MODERN FLOATING MOBILE BOTTOM NAVIGATION BAR (Screen < 992px)
     ========================================================================== -->
<div class="mobile-bottom-bar d-lg-none">
    <!-- 1. Home -->
    <a href="{{ url('/') }}" class="bottom-nav-item {{ request()->is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>হোম</span>
    </a>

    <!-- 2. Notices -->
    <a href="{{ route('notice.index') }}" class="bottom-nav-item {{ request()->is('notice*') ? 'active' : '' }}">
        <i class="fas fa-bell"></i>
        <span>নোটিশ</span>
    </a>

    <!-- 3. Prominent Center Donate Button -->
    <a href="{{ route('donate.index') }}" class="bottom-nav-item center-donate">
        <div class="donate-circle-btn">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <span>অনুদান</span>
    </a>

    <!-- 4. Publications / Books -->
    <a href="{{ route('publications.books') }}" class="bottom-nav-item {{ request()->is('publications*') ? 'active' : '' }}">
        <i class="fas fa-book"></i>
        <span>বইসমূহ</span>
    </a>

    <!-- 5. Drawer Menu Trigger -->
    <a href="#mobileDrawer" data-bs-toggle="offcanvas" class="bottom-nav-item">
        <i class="fas fa-bars"></i>
        <span>মেনু</span>
    </a>
</div>

<!-- Floating Back to Top Button -->
<a href="#" class="btn-back-to-top" id="backToTopBtn" aria-label="উপরে যান">
    <i class="fas fa-chevron-up"></i>
</a>
