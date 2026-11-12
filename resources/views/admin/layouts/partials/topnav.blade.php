<header class="navbar admin-navbar navbar-dark sticky-top p-0 shadow-sm">
    <div class="d-flex align-items-center justify-content-between w-100 px-3 py-2">
        <!-- Logo & Brand with Universal Sidebar Toggle Button -->
        <div class="d-flex align-items-center gap-2">
            <!-- Sidebar Collapse / Expand Toggle Button (Universal for ALL devices) -->
            <button class="btn btn-sidebar-toggle d-flex align-items-center justify-content-center text-white" 
                    type="button" 
                    id="sidebarToggleBtn" 
                    aria-label="সাইডবার কোলাপ্স বা বিস্তার করুন" 
                    title="সাইডবার কোলাপ্স / বিস্তার করুন">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand Link (Mobile displays ONLY logo; Desktop displays logo + text) -->
            <a class="navbar-brand me-0 d-flex align-items-center gap-2" href="{{ route('admin.dashboard.index') }}" title="শুব্বান এডমিন ড্যাশবোর্ড">
                <img src="{{ asset('images/logo.png') }}" alt="Shubban Logo" class="brand-logo-img">
                <div class="d-none d-md-flex flex-column brand-text-wrap">
                    <span class="brand-title">শুব্বান এডমিন</span>
                    <small class="brand-subtitle">প্যানেল ও ম্যানেজমেন্ট</small>
                </div>
            </a>
        </div>
        
        <!-- Right Navigation / Actions -->
        <div class="d-flex align-items-center gap-2">
            <!-- Notifications / Contacts Quick Icon Button (Icon Only - Clean & Uniform) -->
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-notification-bell" title="যোগাযোগ বার্তা ও নোটিফিকেশন">
                <i class="fas fa-bell text-warning"></i>
            </a>

            <!-- View Site Button (Universal: Icon on mobile, Icon+text on desktop) -->
            <div class="d-flex align-items-center">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-view-site" title="মূল ওয়েবসাইট নতুন ট্যাবে দেখুন">
                    <i class="fas fa-external-link-alt me-md-1"></i> <span class="d-none d-md-inline">ওয়েবসাইট দেখুন</span>
                </a>
            </div>

            <!-- Night / Day Mode Toggle Button -->
            <button type="button" class="btn btn-mode-toggle text-white" id="adminThemeModeToggle" aria-label="নাইট/ডে মোড পরিবর্তন" title="নাইট / ডে মোড পরিবর্তন">
                <i class="fas fa-moon mode-icon-night"></i>
                <i class="fas fa-sun mode-icon-day"></i>
            </button>

            <!-- Admin Badge (Desktop & Tablet) -->
            <div class="admin-badge d-none d-md-flex align-items-center">
                <span class="avatar-circle">
                    <i class="fas fa-user-shield"></i>
                </span>
                <div class="text-start">
                    <small class="d-block text-white-50" style="font-size: 0.72rem; line-height: 1;">লগইনকৃত</small>
                    <span class="fw-bold text-white text-truncate" style="font-size: 0.88rem; max-width: 130px; display: inline-block;">{{ Auth::guard('admin')->user()->name ?? 'অ্যাডমিন' }}</span>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="nav-item text-nowrap">
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger text-white border-0 px-2 px-sm-3 rounded-pill" onclick="return confirm('আপনি কি নিশ্চিত যে লগআউট করতে চান?')">
                        <i class="fas fa-sign-out-alt me-1 text-danger"></i> <span class="d-none d-sm-inline">লগআউট</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
