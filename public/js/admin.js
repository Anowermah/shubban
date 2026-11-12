// Shubban Admin Portal - Universal Sidebar Collapse & Interaction JS
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebarMenu');
    const backdrop = document.getElementById('sidebarBackdrop');
    const universalToggleBtn = document.getElementById('sidebarToggleBtn');
    const desktopCollapseBtn = document.getElementById('sidebarDesktopCollapseBtn');
    const mobileCloseBtn = document.getElementById('sidebarCloseBtn');
    const bottomMenuBtn = document.getElementById('mobileDrawerMenuBtn');

    // 1. Restore saved sidebar collapse state from localStorage on Desktop
    if (window.innerWidth >= 768) {
        try {
            const isCollapsed = localStorage.getItem('shubban_admin_sidebar_collapsed') === 'true';
            if (isCollapsed) {
                document.body.classList.add('sidebar-collapsed');
            }
        } catch (e) {
            console.error('LocalStorage error:', e);
        }
    }

    // 2. Open / Close Mobile Drawer
    function openMobileDrawer() {
        if (!sidebar) return;
        sidebar.classList.add('show', 'is-open');
        if (backdrop) backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
        if (!sidebar) return;
        sidebar.classList.remove('show', 'is-open');
        if (backdrop) backdrop.classList.remove('show');
        document.body.style.overflow = '';
    }

    // 3. Desktop Sidebar Toggle (Collapse / Expand)
    function toggleDesktopSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
        const isCollapsed = document.body.classList.contains('sidebar-collapsed');
        try {
            localStorage.setItem('shubban_admin_sidebar_collapsed', isCollapsed ? 'true' : 'false');
        } catch (e) {
            console.error('LocalStorage error:', e);
        }
    }

    // 4. Universal Toggle Button Click Handler (Handles both Desktop & Mobile)
    function handleUniversalToggle(e) {
        if (e) e.preventDefault();
        if (window.innerWidth < 768) {
            if (sidebar && sidebar.classList.contains('show')) {
                closeMobileDrawer();
            } else {
                openMobileDrawer();
            }
        } else {
            toggleDesktopSidebar();
        }
    }

    if (universalToggleBtn) {
        universalToggleBtn.addEventListener('click', handleUniversalToggle);
    }

    // 5. Desktop dedicated collapse button inside sidebar
    if (desktopCollapseBtn) {
        desktopCollapseBtn.addEventListener('click', function (e) {
            e.preventDefault();
            toggleDesktopSidebar();
        });
    }

    // 6. Mobile bottom bar "মেনু" button
    if (bottomMenuBtn) {
        bottomMenuBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (sidebar && sidebar.classList.contains('show')) {
                closeMobileDrawer();
            } else {
                openMobileDrawer();
            }
        });
    }

    // 7. Mobile close button inside sidebar drawer
    if (mobileCloseBtn) {
        mobileCloseBtn.addEventListener('click', function (e) {
            e.preventDefault();
            closeMobileDrawer();
        });
    }

    // 8. Click on backdrop to close mobile drawer
    if (backdrop) {
        backdrop.addEventListener('click', function () {
            closeMobileDrawer();
        });
    }

    // 9. Press Escape key to close mobile drawer or collapse
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (sidebar && sidebar.classList.contains('show')) {
                closeMobileDrawer();
            }
        }
    });

    // 10. Close mobile drawer on navigation link click
    if (sidebar) {
        const directNavLinks = sidebar.querySelectorAll('.nav-link:not([data-bs-toggle="collapse"])');
        directNavLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth < 768) {
                    closeMobileDrawer();
                }
            });
        });
    }

    // 11. Submenu Accordion Collapse Handling
    const submenuToggles = document.querySelectorAll('.sidebar [data-bs-toggle="collapse"]');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            // Let Bootstrap handle the collapse, animate arrow on complete
            const arrow = this.querySelector('.arrow-icon');
            const targetSelector = this.getAttribute('data-bs-target') || this.getAttribute('href');
            if (!targetSelector) return;

            const targetElement = document.querySelector(targetSelector);
            if (targetElement) {
                // Listen to Bootstrap collapse events
                targetElement.addEventListener('shown.bs.collapse', function () {
                    if (arrow) arrow.style.transform = 'rotate(180deg)';
                    toggle.setAttribute('aria-expanded', 'true');
                }, { once: true });

                targetElement.addEventListener('hidden.bs.collapse', function () {
                    if (arrow) arrow.style.transform = 'rotate(0deg)';
                    toggle.setAttribute('aria-expanded', 'false');
                }, { once: true });
            }
        });
    });

    // 12. Auto-expand any submenu if a child link is active
    const activeSubLinks = document.querySelectorAll('.sidebar .collapse .nav-link.active');
    activeSubLinks.forEach(link => {
        const submenu = link.closest('.collapse');
        if (submenu) {
            submenu.classList.add('show');
            const toggle = document.querySelector(`[data-bs-target="#${submenu.id}"], [href="#${submenu.id}"]`);
            if (toggle) {
                toggle.setAttribute('aria-expanded', 'true');
                const arrow = toggle.querySelector('.arrow-icon');
                if (arrow) {
                    arrow.style.transform = 'rotate(180deg)';
                }
            }
        }
    });

    // 13. Mobile Touch Swipe-to-close drawer
    if (sidebar) {
        let touchStartX = 0;
        let touchEndX = 0;

        sidebar.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sidebar.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) {
                closeMobileDrawer();
            }
        }, { passive: true });
    }

    // 14. Mobile Scroll to Top Button
    const backToTopBtn = document.getElementById('adminBackToTopBtn');
    if (backToTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 200) {
                backToTopBtn.style.display = 'inline-flex';
                backToTopBtn.style.alignItems = 'center';
                backToTopBtn.style.justifyContent = 'center';
            } else {
                backToTopBtn.style.display = 'none';
            }
        }, { passive: true });

        backToTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
