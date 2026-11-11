// Shubban Portal - Night / Day Mode Toggle Script
(function () {
    // 1. Determine Initial Theme Mode
    function getPreferredMode() {
        try {
            const saved = localStorage.getItem('shubban_display_mode');
            if (saved === 'dark' || saved === 'light') {
                return saved;
            }
        } catch (e) {}

        const defaultMode = window.SHUBBAN_DEFAULT_MODE || 'light';
        if (defaultMode === 'auto') {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        return defaultMode;
    }

    // 2. Apply Mode to Document Element
    function applyThemeMode(mode) {
        document.documentElement.setAttribute('data-theme', mode);
        document.documentElement.setAttribute('data-bs-theme', mode);
        if (document.body) {
            document.body.setAttribute('data-theme', mode);
        }
        try {
            localStorage.setItem('shubban_display_mode', mode);
        } catch (e) {}
    }

    // Apply immediately to prevent flicker
    const initialMode = getPreferredMode();
    applyThemeMode(initialMode);

    // 3. Toggle Function
    window.toggleShubbanThemeMode = function () {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const newMode = current === 'dark' ? 'light' : 'dark';
        applyThemeMode(newMode);
        return newMode;
    };

    // 4. Attach Event Listeners on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
        // Re-apply in case body was not ready during early execution
        const activeMode = getPreferredMode();
        applyThemeMode(activeMode);

        // Bind all theme mode toggle buttons
        const toggleButtons = document.querySelectorAll('#globalThemeModeToggle, #adminThemeModeToggle, #mobileThemeModeToggle, .btn-mode-toggle');
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                window.toggleShubbanThemeMode();
            });
        });

        // Listen for OS system theme changes if set to auto
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
                const saved = localStorage.getItem('shubban_display_mode');
                if (!saved || saved === 'auto') {
                    applyThemeMode(e.matches ? 'dark' : 'light');
                }
            });
        }
    });
})();
