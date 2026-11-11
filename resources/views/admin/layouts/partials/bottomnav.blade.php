<!-- Admin Mobile Bottom Navigation Bar (Visible only on mobile screens < 768px) -->
<nav class="admin-bottom-nav d-md-none" aria-label="Mobile Bottom Navigation">
    <div class="bottom-nav-container">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard.index') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
            <div class="nav-icon-wrap">
                <i class="fas fa-th-large"></i>
            </div>
            <span class="nav-label">ড্যাশবোর্ড</span>
        </a>

        <!-- Donations -->
        <a href="{{ route('admin.donations.index') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.donations*') ? 'active' : '' }}">
            <div class="nav-icon-wrap position-relative">
                <i class="fas fa-hand-holding-usd"></i>
                @if(isset($adminBadges['pending_donations']) && $adminBadges['pending_donations'] > 0)
                    <span class="nav-badge">{{ $adminBadges['pending_donations'] }}</span>
                @endif
            </div>
            <span class="nav-label">অনুদান</span>
        </a>

        <!-- Reports -->
        <a href="{{ route('admin.organization.reports') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.organization.reports*') ? 'active' : '' }}">
            <div class="nav-icon-wrap position-relative">
                <i class="fas fa-file-signature"></i>
                @if(isset($adminBadges['pending_reports']) && $adminBadges['pending_reports'] > 0)
                    <span class="nav-badge">{{ $adminBadges['pending_reports'] }}</span>
                @endif
            </div>
            <span class="nav-label">প্রতিবেদন</span>
        </a>

        <!-- Notices -->
        <a href="{{ route('admin.notices.index') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.notices*') ? 'active' : '' }}">
            <div class="nav-icon-wrap">
                <i class="fas fa-bell"></i>
            </div>
            <span class="nav-label">নোটিশ</span>
        </a>

        <!-- Menu Drawer Toggle -->
        <button type="button" class="bottom-nav-item border-0 bg-transparent" id="mobileDrawerMenuBtn" aria-label="সব মেনু দেখুন">
            <div class="nav-icon-wrap position-relative">
                <i class="fas fa-bars"></i>
                @if(isset($adminBadges['total_pending']) && $adminBadges['total_pending'] > 0)
                    <span class="nav-badge bg-warning text-dark">{{ $adminBadges['total_pending'] }}</span>
                @endif
            </div>
            <span class="nav-label">মেনু</span>
        </button>
    </div>
</nav>
