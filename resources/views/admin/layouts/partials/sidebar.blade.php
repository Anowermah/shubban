<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar" aria-label="Admin Navigation">
    <div class="position-sticky sidebar-inner">
        <!-- Mobile Drawer Header (Visible only on mobile inside drawer) -->
        <div class="sidebar-mobile-header d-flex align-items-center justify-content-between p-3 border-bottom border-secondary-subtle d-md-none">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo" style="height: 32px; width: auto; background: #fff; padding: 2px; border-radius: 4px;">
                <span class="fw-bold text-white fs-6">শুব্বান অ্যাডমিন মেনু</span>
            </div>
            <button type="button" class="btn btn-sm btn-outline-light rounded-circle border-0" id="sidebarCloseBtn" aria-label="মেনু বন্ধ করুন" style="width: 34px; height: 34px;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Admin Mini Profile Card with Desktop Collapse Action -->
        <div class="sidebar-user-card p-3 mb-2 border-bottom border-dark">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 overflow-hidden">
                    <div class="sidebar-avatar-circle">
                        <i class="fas fa-user-shield"></i>
                        <span class="online-indicator" title="অনলাইন"></span>
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-white fw-bold text-truncate" style="font-size: 0.95rem;">
                            {{ Auth::guard('admin')->user()->name ?? 'অ্যাডমিনিস্ট্রেটর' }}
                        </div>
                        <span class="badge bg-warning text-dark fw-semibold" style="font-size: 0.7rem; padding: 2px 6px;">
                            সুপার অ্যাডমিন
                        </span>
                    </div>
                </div>
                <!-- Desktop Sidebar Collapse Button -->
                <button type="button" class="btn btn-sm btn-outline-light border-0 d-none d-md-flex align-items-center justify-content-center" id="sidebarDesktopCollapseBtn" title="সাইডবার কোলাপ্স করুন" style="width: 28px; height: 28px; border-radius: 6px; background: rgba(255,255,255,0.08);">
                    <i class="fas fa-angles-left"></i>
                </button>
            </div>
        </div>

        <ul class="nav flex-column sidebar-nav-list">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span>ড্যাশবোর্ড</span>
                </a>
            </li>

            <!-- AI Site Co-Pilot -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.ai-copilot*') ? 'active' : '' }}" 
                   href="{{ route('admin.ai-copilot.index') }}">
                    <i class="fas fa-wand-magic-sparkles text-warning"></i>
                    <span>এআই সাইট কো-পাইলট</span>
                    <span class="badge bg-danger ms-auto font-xs fw-bold">AI PRO</span>
                </a>
            </li>

            <!-- Website Content -->
            <h6 class="sidebar-heading"><span>ওয়েবসাইট কনটেন্ট</span></h6>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.homepage*') ? 'active' : '' }}" 
                   href="{{ route('admin.homepage.index') }}">
                    <i class="fas fa-layer-group text-warning"></i>
                    <span>হোমপেজ কন্ট্রোল</span>
                    <span class="badge bg-success-subtle text-success ms-auto font-xs">নতুন</span>
                </a>
            </li>

            <!-- AI Chat Assistant Menu -->
            <li class="nav-item">
                <a href="#aiChatSubmenu" data-bs-toggle="collapse" data-bs-target="#aiChatSubmenu" role="button"
                   class="nav-link {{ request()->routeIs('admin.ai-chat*') ? 'active' : '' }}"
                   aria-expanded="{{ request()->routeIs('admin.ai-chat*') ? 'true' : 'false' }}">
                    <i class="fas fa-robot text-info"></i>
                    <span>এআই চ্যাট সহকারী</span>
                    <span class="badge bg-warning text-dark font-xs ms-1">AI</span>
                    <i class="fas fa-angle-down ms-auto arrow-icon" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="collapse nav flex-column {{ request()->routeIs('admin.ai-chat*') ? 'show' : '' }}" id="aiChatSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('admin.ai-chat.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.ai-chat.index') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h"></i>
                            <span>কনট্রোল ও সেটিংস</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ai-chat.knowledge.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.ai-chat.knowledge*') ? 'active' : '' }}">
                            <i class="fas fa-book-reader"></i>
                            <span>নলেজ বেস Q&A</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ai-chat.logs.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.ai-chat.logs*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>চ্যাট লগ হিস্ট্রি</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}" 
                   href="{{ route('admin.sliders.index') }}">
                    <i class="fas fa-images"></i>
                    <span>হোম স্লাইডার</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.news*') ? 'active' : '' }}" 
                   href="{{ route('admin.news.index') }}">
                    <i class="fas fa-newspaper"></i>
                    <span>সংবাদ ও খবরাখবর</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.notices*') ? 'active' : '' }}" 
                   href="{{ route('admin.notices.index') }}">
                    <i class="fas fa-bell"></i>
                    <span>জরুরি নোটিশ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.activities*') ? 'active' : '' }}" 
                   href="{{ route('admin.activities.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>সাংগঠনিক কার্যক্রম</span>
                </a>
            </li>

            <!-- Publications -->
            <h6 class="sidebar-heading"><span>প্রকাশনা ও সাহিত্য</span></h6>
            
            <li class="nav-item">
                <a href="#publicationSubmenu" data-bs-toggle="collapse" data-bs-target="#publicationSubmenu" role="button"
                   class="nav-link {{ request()->routeIs('admin.publications*') ? 'active' : '' }}"
                   aria-expanded="{{ request()->routeIs('admin.publications*') ? 'true' : 'false' }}">
                    <i class="fas fa-book-open"></i>
                    <span>প্রকাশনাসমূহ</span>
                    <i class="fas fa-angle-down ms-auto arrow-icon" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="collapse nav flex-column {{ request()->routeIs('admin.publications*') ? 'show' : '' }}" id="publicationSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('admin.publications.books.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.publications.books*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            <span>বই সম্ভার</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.publications.magazines.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.publications.magazines*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper"></i>
                            <span>মাসিক ম্যাগাজিন</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.publications.articles.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.publications.articles*') ? 'active' : '' }}">
                            <i class="fas fa-feather-alt"></i>
                            <span>গবেষণা প্রবন্ধ</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Gallery & Media -->
            <h6 class="sidebar-heading"><span>মিডিয়া ও গ্যালারি</span></h6>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}" 
                   href="{{ route('admin.media.index') }}">
                    <i class="fas fa-photo-video text-warning"></i>
                    <span>মিডিয়া ফাইল ম্যানেজার</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.photos*') ? 'active' : '' }}" 
                   href="{{ route('admin.photos.index') }}">
                    <i class="fas fa-camera"></i>
                    <span>ফটো গ্যালারি</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.videos*') ? 'active' : '' }}" 
                   href="{{ route('admin.videos.index') }}">
                    <i class="fas fa-video"></i>
                    <span>ভিডিও গ্যালারি</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.gallery-archives*') ? 'active' : '' }}" 
                   href="{{ route('admin.gallery-archives.index') }}">
                    <i class="fas fa-archive"></i>
                    <span>ঐতিহাসিক আর্কাইভ</span>
                </a>
            </li>

            <!-- Training -->
            <h6 class="sidebar-heading"><span>প্রশিক্ষণ কোর্স ও সিলেবাস</span></h6>

            <li class="nav-item">
                <a href="#trainingSubmenu" data-bs-toggle="collapse" data-bs-target="#trainingSubmenu" role="button"
                   class="nav-link {{ request()->routeIs('admin.training*') ? 'active' : '' }}"
                   aria-expanded="{{ request()->routeIs('admin.training*') ? 'true' : 'false' }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>প্রশিক্ষণ রেজিস্ট্রেশন</span>
                    <i class="fas fa-angle-down ms-auto arrow-icon" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="collapse nav flex-column {{ request()->routeIs('admin.training*') ? 'show' : '' }}" id="trainingSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('admin.training.aref.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.training.aref*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>আরেফ প্রশিক্ষণ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.training.rageb.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.training.rageb*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>রাগেব প্রশিক্ষণ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.training.salek.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.training.salek*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>সালেক প্রশিক্ষণ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.training.saleh.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.training.saleh*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>সালেহ প্রশিক্ষণ</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Organization & Management -->
            <h6 class="sidebar-heading"><span>সংগঠন ও দায়িত্বশীল</span></h6>

            <li class="nav-item">
                <a href="#managementSubmenu" data-bs-toggle="collapse" data-bs-target="#managementSubmenu" role="button"
                   class="nav-link {{ request()->routeIs('admin.management*') ? 'active' : '' }}"
                   aria-expanded="{{ request()->routeIs('admin.management*') ? 'true' : 'false' }}">
                    <i class="fas fa-sitemap"></i>
                    <span>দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ</span>
                    <i class="fas fa-angle-down ms-auto arrow-icon" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="collapse nav flex-column {{ request()->routeIs('admin.management*') ? 'show' : '' }}" id="managementSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('admin.management.central') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <span>কেন্দ্রীয় কমিটি</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.management.district') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <span>জেলা দায়িত্বশীল</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.management.upazila') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <span>উপজেলা দায়িত্বশীল</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.management.thana') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <span>থানা দায়িত্বশীল</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.management.branch') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <span>শাখা দায়িত্বশীল</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.officials*') ? 'active' : '' }}" 
                   href="{{ route('admin.officials.index') }}">
                    <i class="fas fa-user-tie"></i>
                    <span>কর্মকর্তাবৃন্দ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.committee*') ? 'active' : '' }}" 
                   href="{{ route('admin.committee.index') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>কমিটি পরিষদ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.departments*') ? 'active' : '' }}" 
                   href="{{ route('admin.departments.index') }}">
                    <i class="fas fa-building"></i>
                    <span>বিভাগসমূহ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.members*') ? 'active' : '' }}" 
                   href="{{ route('admin.members.index') }}">
                    <i class="fas fa-id-card"></i>
                    <span>সদস্য তালিকা</span>
                </a>
            </li>

            <!-- Organizational Affairs (with live counts) -->
            <h6 class="sidebar-heading"><span>সাংগঠনিক কার্যক্রম ও মনিটরিং</span></h6>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.organization.promotions*') ? 'active' : '' }}" 
                   href="{{ route('admin.organization.promotions') }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-layer-group text-warning"></i>
                        <span>মানোন্নয়ন আবেদন</span>
                    </div>
                    @if(isset($adminBadges['pending_promotions']) && $adminBadges['pending_promotions'] > 0)
                        <span class="badge bg-warning text-dark rounded-pill">{{ $adminBadges['pending_promotions'] }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.organization.reports*') ? 'active' : '' }}" 
                   href="{{ route('admin.organization.reports') }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-file-signature text-info"></i>
                        <span>কর্মসূচি প্রতিবেদন</span>
                    </div>
                    @if(isset($adminBadges['pending_reports']) && $adminBadges['pending_reports'] > 0)
                        <span class="badge bg-info text-dark rounded-pill">{{ $adminBadges['pending_reports'] }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.organization.iyanats*') ? 'active' : '' }}" 
                   href="{{ route('admin.organization.iyanats') }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-hand-holding-usd text-success"></i>
                        <span>মাসিক এয়ানত আদায়</span>
                    </div>
                    @if(isset($adminBadges['pending_iyanats']) && $adminBadges['pending_iyanats'] > 0)
                        <span class="badge bg-success-subtle text-success rounded-pill">{{ $adminBadges['pending_iyanats'] }}</span>
                    @endif
                </a>
            </li>

            <!-- Donations & Contacts -->
            <h6 class="sidebar-heading"><span>অনুদান ও যোগাযোগ</span></h6>

            <li class="nav-item">
                <a href="#donationsSubmenu" data-bs-toggle="collapse" data-bs-target="#donationsSubmenu" role="button"
                   class="nav-link {{ request()->routeIs('admin.donations*') ? 'active' : '' }}"
                   aria-expanded="{{ request()->routeIs('admin.donations*') ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-hand-holding-usd text-success"></i>
                        <span>অনুদান ব্যবস্থাপনা</span>
                    </div>
                    <div class="ms-auto d-flex align-items-center gap-2">
                        @if(isset($adminBadges['pending_donations']) && $adminBadges['pending_donations'] > 0)
                            <span class="badge bg-warning text-dark rounded-pill">{{ $adminBadges['pending_donations'] }}</span>
                        @endif
                        <i class="fas fa-angle-down arrow-icon" style="font-size: 0.75rem;"></i>
                    </div>
                </a>
                <ul class="collapse nav flex-column {{ request()->routeIs('admin.donations*') ? 'show' : '' }}" id="donationsSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('admin.donations.index') }}" 
                           class="nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.donations.index') || request()->routeIs('admin.donations.show') ? 'active' : '' }}">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-list-alt"></i>
                                <span>অনুদানের খতিয়ান</span>
                            </div>
                            @if(isset($adminBadges['pending_donations']) && $adminBadges['pending_donations'] > 0)
                                <span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.7rem;">পেন্ডিং</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.donations.create') }}" 
                           class="nav-link {{ request()->routeIs('admin.donations.create') ? 'active' : '' }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>নতুন দান এন্ট্রি</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.donations.causes.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.donations.causes*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>দান খাত / ফান্ডসমূহ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.donations.accounts') }}" 
                           class="nav-link {{ request()->routeIs('admin.donations.accounts') ? 'active' : '' }}">
                            <i class="fas fa-wallet"></i>
                            <span>পেমেন্ট গেটওয়ে ও ব্যাংক</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" 
                   href="{{ route('admin.contacts.index') }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>যোগাযোগ বার্তা</span>
                    </div>
                    @if(isset($adminBadges['unread_contacts']) && $adminBadges['unread_contacts'] > 0)
                        <span class="badge bg-danger rounded-pill">{{ $adminBadges['unread_contacts'] }}</span>
                    @endif
                </a>
            </li>

            <!-- Settings -->
            <h6 class="sidebar-heading"><span>সেটিংস ও প্রশাসন</span></h6>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.theme*') ? 'active' : '' }}" 
                   href="{{ route('admin.theme.index') }}">
                    <i class="fas fa-palette text-warning"></i>
                    <span>কালার থিম ও মোড</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.page-access*') ? 'active' : '' }}" 
                   href="{{ route('admin.page-access.index') }}">
                    <i class="fas fa-user-lock text-warning"></i>
                    <span>পেজ অ্যাক্সেস কন্ট্রোল</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users-access*') ? 'active' : '' }}" 
                   href="{{ route('admin.users-access.index') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>ইউজার ও রোলস</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.profile*') ? 'active' : '' }}" 
                   href="{{ route('admin.profile') }}">
                    <i class="fas fa-user-circle"></i>
                    <span>প্রোফাইল</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pwa*') ? 'active' : '' }}" 
                   href="{{ route('admin.pwa.index') }}">
                    <i class="fas fa-mobile-alt text-warning"></i>
                    <span>পিডব্লিউএ (PWA) কন্ট্রোল</span>
                    <span class="badge bg-success-subtle text-success ms-auto font-xs">অ্যাপ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" 
                   href="{{ route('admin.settings') }}">
                    <i class="fas fa-sliders-h"></i>
                    <span>ওয়েবসাইট সেটিংস</span>
                </a>
            </li>
        </ul>

        <!-- Mobile Quick Actions in Drawer Footer -->
        <div class="sidebar-mobile-footer p-3 border-top border-dark d-md-none mt-3">
            <div class="d-grid gap-2">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-light text-start">
                    <i class="fas fa-external-link-alt me-2 text-warning"></i> ওয়েবসাইট দেখুন
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger w-100 text-start" onclick="return confirm('আপনি কি নিশ্চিত যে লগআউট করতে চান?')">
                        <i class="fas fa-sign-out-alt me-2"></i> লগআউট করুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
