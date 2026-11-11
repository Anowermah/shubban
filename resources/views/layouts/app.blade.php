<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')</title>
    
    <!-- PWA Web App Manifest & Mobile App Meta Tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="{{ $themeSettings['primary_color'] ?? '#0C4B36' }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="শুব্বান">
    <link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/icon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/icon-72x72.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    
    <!-- SEO & Indexing Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শে যুব সমাজ বিনির্মাণ, তাওহীদের প্রচার ও সমাজ সংস্কারে নিয়োজিত অরাজনৈতিক সংগঠন জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ।')">
    <meta name="keywords" content="@yield('meta_keywords', 'শুব্বান, জমঈয়ত শুব্বান, আহলে হাদীস বাংলাদেশ, শুব্বান প্রকাশনা, ইসলামিক যুব সংগঠন, তাওহীদ, সুন্নাহ, ইসলামী বই, প্রশিক্ষণ, আহলে হাদিস')">
    <meta name="author" content="জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Meta Tags (Facebook & Social) -->
    <meta property="og:locale" content="bn_BD">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')">
    <meta property="og:description" content="@yield('meta_description', 'কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শে যুব সমাজ বিনির্মাণ ও মানবকল্যাণে জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ।')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:image:alt" content="জমঈয়ত শুব্বান লোগো">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ')">
    <meta name="twitter:description" content="@yield('meta_description', 'কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শে যুব সমাজ বিনির্মাণ ও মানবকল্যাণে জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ।')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    <!-- Structured Data (JSON-LD Organization & Website Schema) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "@id": "{{ url('/') }}/#organization",
          "name": "জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ",
          "alternateName": "Jamiat Shubban Ahl-e-Hadith Bangladesh",
          "url": "{{ url('/') }}",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+8801712345678",
            "contactType": "Office Support",
            "email": "info.shubbanbd@gmail.com",
            "areaServed": "BD"
          },
          "sameAs": [
            "https://www.facebook.com/shubban",
            "https://www.youtube.com/@ShubbanDawah"
          ]
        },
        {
          "@type": "WebSite",
          "@id": "{{ url('/') }}/#website",
          "url": "{{ url('/') }}",
          "name": "জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ",
          "publisher": {
            "@id": "{{ url('/') }}/#organization"
          },
          "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/search') }}?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
      ]
    }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : '2.1' }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}?v={{ file_exists(public_path('css/custom.css')) ? filemtime(public_path('css/custom.css')) : '2.1' }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}?v={{ file_exists(public_path('css/header.css')) ? filemtime(public_path('css/header.css')) : '2.1' }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}?v={{ file_exists(public_path('css/footer.css')) ? filemtime(public_path('css/footer.css')) : '2.1' }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}?v={{ file_exists(public_path('css/mobile.css')) ? filemtime(public_path('css/mobile.css')) : '1.0' }}" rel="stylesheet">
    <link href="{{ asset('css/theme-mode.css') }}?v={{ file_exists(public_path('css/theme-mode.css')) ? filemtime(public_path('css/theme-mode.css')) : '1.0' }}" rel="stylesheet">
    
    <!-- Dynamic Theme Variables & Anti-Flicker Script -->
    <style id="shubban-theme-variables">
        :root {
            --primary-color: {{ $themeSettings['primary_color'] ?? '#0C4B36' }};
            --secondary-color: {{ $themeSettings['accent_color'] ?? '#FBB040' }};
            --shubban-green: {{ $themeSettings['primary_color'] ?? '#0C4B36' }};
            --shubban-green-deep: {{ $themeSettings['primary_color'] ?? '#0C4B36' }};
            --shubban-gold: {{ $themeSettings['accent_color'] ?? '#FBB040' }};
        }
        html[data-theme="dark"],
        html[data-bs-theme="dark"] {
            --primary-color: #34d399 !important;
            --shubban-green: #34d399 !important;
            --shubban-green-deep: #10b981 !important;
            --header-primary: #34d399 !important;
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
    @if(app()->getLocale() == 'ar')
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Arabic', sans-serif;
            direction: rtl;
        }
    </style>
    @endif
    
    @yield('styles')
    @yield('page-styles')
    @stack('styles')
</head>
<body>
    <div class="min-h-screen">
        @include('layouts.partials.header')

        <!-- Page Content -->
        <main>
            @if(session('guest_info'))
                <div class="container mt-3">
                    <div class="alert alert-info alert-dismissible fade show rounded-3 shadow-sm border-0 d-flex align-items-center" role="alert" style="background: #e8f5ed; color: #0C4B36;">
                        <i class="fas fa-compass me-2 fs-5 text-warning"></i>
                        <div>{{ session('guest_info') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="container mt-3">
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2 text-success"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Active link detection for public navbar
            var currentUrl = window.location.href.split(/[?#]/)[0];
            $('.main-nav .nav-link').each(function() {
                var href = $(this).attr('href');
                if (href && href !== '#' && href !== 'javascript:void(0)') {
                    var cleanHref = href.split(/[?#]/)[0];
                    if (currentUrl === cleanHref) {
                        $(this).addClass('active');
                        $(this).closest('.dropdown').find('.dropdown-toggle').addClass('active');
                    }
                }
            });
            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 250) {
                    $('#backToTopBtn').addClass('show');
                } else {
                    $('#backToTopBtn').removeClass('show');
                }
            });
            $('#backToTopBtn').click(function(e) {
                e.preventDefault();
                window.scrollTo({top: 0, behavior: 'smooth'});
            });
        });
    </script>
    <script src="{{ asset('js/theme-mode.js') }}"></script>
    
    <!-- Shubban AI Assistant Floating Widget -->
    @include('frontend.partials.ai_chat_widget')
    
    <!-- PWA Manager & Service Worker Registration -->
    <script src="{{ asset('js/pwa-config.js') }}?v={{ file_exists(public_path('js/pwa-config.js')) ? filemtime(public_path('js/pwa-config.js')) : '1.0' }}"></script>
    <script src="{{ asset('js/pwa-manager.js') }}?v=1.0.0" defer></script>
    
    @yield('scripts')
    @yield('page-scripts')
    @stack('scripts')
</body>
</html>
