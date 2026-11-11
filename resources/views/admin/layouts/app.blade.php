<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Dashboard</title>
    
    <!-- PWA Web App Manifest & App Icons -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="{{ $themeSettings['primary_color'] ?? '#0C4B36' }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="শুব্বান অ্যাডমিন">
    <link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/icon-96x96.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://banglawebfonts.pages.dev/css/bornomala.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}?v={{ file_exists(public_path('css/admin.css')) ? filemtime(public_path('css/admin.css')) : '2.1' }}" rel="stylesheet">
    <link href="{{ asset('css/theme-mode.css') }}?v={{ file_exists(public_path('css/theme-mode.css')) ? filemtime(public_path('css/theme-mode.css')) : '1.0' }}" rel="stylesheet">
    
    <!-- Dynamic Theme Variables & Anti-Flicker Script -->
    <style id="shubban-theme-variables">
        :root {
            --admin-primary: {{ $themeSettings['primary_color'] ?? '#0C4B36' }};
            --admin-accent: {{ $themeSettings['accent_color'] ?? '#FBB040' }};
            --primary-color: {{ $themeSettings['primary_color'] ?? '#0C4B36' }};
            --secondary-color: {{ $themeSettings['accent_color'] ?? '#FBB040' }};
        }
        html[data-theme="dark"],
        html[data-bs-theme="dark"] {
            --admin-primary: #34d399 !important;
            --primary-color: #34d399 !important;
            --admin-primary-dark: #f8fafc !important;
            --admin-text-main: #f1f5f9 !important;
            --admin-text-muted: #94a3b8 !important;
        }
    </style>
    <script>
        window.SHUBBAN_DEFAULT_MODE = "{{ $themeSettings['default_mode'] ?? 'light' }}";
        (function() {
            try {
                var saved = localStorage.getItem('shubban_display_mode');
                var mode = saved || window.SHUBBAN_DEFAULT_MODE || 'light';
                if (mode === 'auto') {
                    mode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.setAttribute('data-theme', mode);
                document.documentElement.setAttribute('data-bs-theme', mode);
            } catch (e) {}
        })();
    </script>
    
    @yield('styles')
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Top Navigation -->
        @include('admin.layouts.partials.topnav')
        
        <!-- Mobile Sidebar Backdrop Overlay -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                @include('admin.layouts.partials.sidebar')
                
                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Mobile Bottom Navigation Bar -->
        @include('admin.layouts.partials.bottomnav')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/theme-mode.js') }}"></script>
    
    <!-- Rich Text Editor (TinyMCE) -->
    @include('admin.layouts.partials.tinymce')
    
    <!-- PWA Service Worker & App Installation Manager -->
    <script src="{{ asset('js/pwa-config.js') }}?v={{ file_exists(public_path('js/pwa-config.js')) ? filemtime(public_path('js/pwa-config.js')) : '1.0' }}"></script>
    <script src="{{ asset('js/pwa-manager.js') }}?v=1.0.0" defer></script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>
