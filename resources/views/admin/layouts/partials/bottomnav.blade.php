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
            <div class="nav-icon-wrap">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <span class="nav-label">অনুদান</span>
        </a>

        <!-- Reports -->
        <a href="{{ route('admin.organization.reports') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.organization.reports*') ? 'active' : '' }}">
            <div class="nav-icon-wrap">
                <i class="fas fa-file-signature"></i>
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
            <div class="nav-icon-wrap">
                <i class="fas fa-bars"></i>
            </div>
            <span class="nav-label">মেনু</span>
        </button>
    </div>
</nav>
