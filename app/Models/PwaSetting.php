<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PwaSetting extends Model
{
    protected $table = 'pwa_settings';

    protected $fillable = [
        'is_enabled',
        'app_name',
        'app_short_name',
        'app_description',
        'start_url',
        'display_mode',
        'orientation',
        'theme_color',
        'background_color',
        'app_icon',
        'enable_install_banner',
        'banner_title',
        'banner_subtitle',
        'banner_btn_text',
        'banner_delay',
        'banner_dismiss_days',
        'shortcuts',
        'offline_title',
        'offline_message',
        'cache_version',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'enable_install_banner' => 'boolean',
        'banner_delay' => 'integer',
        'banner_dismiss_days' => 'integer',
        'shortcuts' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default list of shortcuts for long-press on app icon.
     */
    public static function defaultShortcuts(): array
    {
        return [
            [
                'name' => 'অনলাইন দান',
                'short_name' => 'অনুদান',
                'url' => '/donate',
                'description' => 'দ্বীনি দাওয়াত ও মানবতার সেবায় অনুদান দিন',
                'icon' => '/icons/icon-96x96.png',
                'is_active' => true,
            ],
            [
                'name' => 'জরুরি নোটিশ',
                'short_name' => 'নোটিশ',
                'url' => '/notice',
                'description' => 'সর্বশেষ সাংগঠনিক বিজ্ঞপ্তি ও আদেশ',
                'icon' => '/icons/icon-96x96.png',
                'is_active' => true,
            ],
            [
                'name' => 'বই সম্ভার',
                'short_name' => 'বই',
                'url' => '/publications/books',
                'description' => 'শুব্বান প্রকাশিত কিতাব ও সাহিত্য',
                'icon' => '/icons/icon-96x96.png',
                'is_active' => true,
            ],
            [
                'name' => 'যোগাযোগ',
                'short_name' => 'যোগাযোগ',
                'url' => '/contact',
                'description' => 'কেন্দ্রীয় কার্যালয় ও হেল্পডেস্ক',
                'icon' => '/icons/icon-96x96.png',
                'is_active' => true,
            ],
            [
                'name' => 'রিসার্চ সেন্টার',
                'short_name' => 'রিসার্চ',
                'url' => '/facilities/research-center',
                'description' => 'কুরআন-সুন্নাহ গবেষণা ও ফতোয়া সেবা',
                'icon' => '/icons/icon-96x96.png',
                'is_active' => true,
            ],
        ];
    }

    /**
     * Default PWA configuration.
     */
    public static function defaultSettings(): array
    {
        return [
            'is_enabled' => true,
            'app_name' => 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ',
            'app_short_name' => 'শুব্বান',
            'app_description' => 'একটি ঐতিহ্যবাহী অরাজনৈতিক ছাত্র ও যুব আন্দোলন — যুব সমাজের আত্মশুদ্ধি ও মানবতার সেবায় নিবেদিত।',
            'start_url' => '/?source=pwa',
            'display_mode' => 'standalone',
            'orientation' => 'portrait-primary',
            'theme_color' => '#0C4B36',
            'background_color' => '#072e20',
            'app_icon' => null,
            'enable_install_banner' => true,
            'banner_title' => 'শুব্বান অ্যাপ ইনস্টল করুন',
            'banner_subtitle' => 'দ্রুত ব্রাউজ ও অফলাইনে পড়ার জন্য',
            'banner_btn_text' => 'ইনস্টল',
            'banner_delay' => 2,
            'banner_dismiss_days' => 7,
            'shortcuts' => self::defaultShortcuts(),
            'offline_title' => 'আপনি বর্তমানে অফলাইনে আছেন',
            'offline_message' => 'আপনার ডিভাইসে ইন্টারনেট সংযোগ পাওয়া যাচ্ছে না। অনুগ্রহ করে মোবাইল ডেটা বা ওয়াই-ফাই সংযোগ চেক করুন।',
            'cache_version' => 'v1.0.0',
        ];
    }

    /**
     * Get singleton instance with automatic seeding.
     */
    public static function getSettings(): self
    {
        $setting = self::first();
        if (!$setting) {
            $setting = self::create(self::defaultSettings());
            $setting->syncFiles();
        }
        return $setting;
    }

    /**
     * Sync and generate manifest.json, sw.js, offline.html & pwa-config.js.
     */
    public function syncFiles(): void
    {
        $this->generateManifest();
        $this->generateServiceWorker();
        $this->generateOfflinePage();
        $this->generateClientConfig();
    }

    /**
     * Generate public/manifest.json based on database settings.
     */
    public function generateManifest(): void
    {
        $activeShortcuts = [];
        if (!empty($this->shortcuts) && is_array($this->shortcuts)) {
            foreach ($this->shortcuts as $sc) {
                if (!isset($sc['is_active']) || $sc['is_active']) {
                    $activeShortcuts[] = [
                        'name' => $sc['name'] ?? 'শর্টকাট',
                        'short_name' => $sc['short_name'] ?? ($sc['name'] ?? 'শর্টকাট'),
                        'description' => $sc['description'] ?? '',
                        'url' => $sc['url'] ?? '/',
                        'icons' => [
                            [
                                'src' => $sc['icon'] ?? '/icons/icon-96x96.png',
                                'sizes' => '96x96',
                                'type' => 'image/png'
                            ]
                        ]
                    ];
                }
            }
        }

        $manifestData = [
            'name' => $this->app_name ?: 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ',
            'short_name' => $this->app_short_name ?: 'শুব্বান',
            'description' => $this->app_description ?: 'একটি ঐতিহ্যবাহী অরাজনৈতিক ছাত্র ও যুব আন্দোলন — যুব সমাজের আত্মশুদ্ধি ও মানবতার সেবায় নিবেদিত।',
            'start_url' => $this->start_url ?: '/?source=pwa',
            'id' => $this->start_url ?: '/?source=pwa',
            'scope' => '/',
            'display' => $this->display_mode ?: 'standalone',
            'orientation' => $this->orientation ?: 'portrait-primary',
            'background_color' => $this->background_color ?: '#072e20',
            'theme_color' => $this->theme_color ?: '#0C4B36',
            'lang' => 'bn',
            'dir' => 'ltr',
            'categories' => ['education', 'books', 'religion', 'social'],
            'icons' => [
                ['src' => '/icons/icon-72x72.png', 'sizes' => '72x72', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-96x96.png', 'sizes' => '96x96', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-128x128.png', 'sizes' => '128x128', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-144x144.png', 'sizes' => '144x144', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-152x152.png', 'sizes' => '152x152', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-192x192.png', 'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-maskable-192x192.png', 'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'maskable'],
                ['src' => '/icons/icon-384x384.png', 'sizes' => '384x384', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-512x512.png', 'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => '/icons/icon-maskable-512x512.png', 'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'maskable'],
            ],
            'shortcuts' => $activeShortcuts,
            'prefer_related_applications' => false,
        ];

        file_put_contents(public_path('manifest.json'), json_encode($manifestData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Generate public/sw.js with current cache version.
     */
    public function generateServiceWorker(): void
    {
        $version = $this->cache_version ?: 'v1.0.0';
        $swTemplate = <<<JS
const CACHE_NAME = 'shubban-pwa-{$version}';
const RUNTIME_CACHE = 'shubban-runtime-{$version}';

// Core assets to pre-cache immediately on install
const PRECACHE_ASSETS = [
    '/offline.html',
    '/manifest.json',
    '/icons/icon-72x72.png',
    '/icons/icon-96x96.png',
    '/icons/icon-144x144.png',
    '/icons/icon-192x192.png',
    '/icons/icon-512x512.png',
    '/icons/apple-touch-icon.png',
    '/favicon.png',
    '/css/theme-mode.css',
    '/js/theme-mode.js',
    '/js/pwa-config.js',
    '/images/logo.png'
];

// Install Event - Pre-cache core shell
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return Promise.allSettled(
                    PRECACHE_ASSETS.map(url => cache.add(url).catch(err => {
                        console.warn('[SW] Could not pre-cache:', url, err);
                    }))
                );
            })
            .then(() => self.skipWaiting())
    );
});

// Activate Event - Clean up outdated caches
self.addEventListener('activate', event => {
    const currentCaches = [CACHE_NAME, RUNTIME_CACHE];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (!currentCaches.includes(cacheName)) {
                        console.log('[SW] Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Event
self.addEventListener('fetch', event => {
    const request = event.request;

    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    const url = new URL(request.url);

    // Skip non-http protocols
    if (!url.protocol.startsWith('http')) {
        return;
    }

    // HTML Navigation requests -> Network First, Fallback to Cache, then Offline.html
    if (request.mode === 'navigate' || (request.headers.get('accept') && request.headers.get('accept').includes('text/html'))) {
        event.respondWith(
            fetch(request)
                .then(networkResponse => {
                    if (networkResponse && networkResponse.status === 200) {
                        const responseClone = networkResponse.clone();
                        caches.open(RUNTIME_CACHE).then(cache => {
                            cache.put(request, responseClone);
                        });
                    }
                    return networkResponse;
                })
                .catch(async () => {
                    const cachedResponse = await caches.match(request);
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    return caches.match('/offline.html');
                })
        );
        return;
    }

    // Static Assets (CSS, JS, Fonts, Images) -> Stale While Revalidate
    if (
        request.destination === 'style' ||
        request.destination === 'script' ||
        request.destination === 'font' ||
        request.destination === 'image' ||
        url.pathname.startsWith('/icons/') ||
        url.pathname.startsWith('/fonts/') ||
        url.pathname.startsWith('/css/') ||
        url.pathname.startsWith('/js/')
    ) {
        event.respondWith(
            caches.match(request).then(cachedResponse => {
                const fetchPromise = fetch(request).then(networkResponse => {
                    if (networkResponse && networkResponse.status === 200) {
                        const responseClone = networkResponse.clone();
                        caches.open(RUNTIME_CACHE).then(cache => {
                            cache.put(request, responseClone);
                        });
                    }
                    return networkResponse;
                }).catch(() => cachedResponse);

                return cachedResponse || fetchPromise;
            })
        );
        return;
    }

    // Default Fallback
    event.respondWith(
        caches.match(request).then(cachedResponse => {
            return cachedResponse || fetch(request);
        })
    );
});

// Push Notification Support
self.addEventListener('push', event => {
    let data = { title: 'জমঈয়ত শুব্বান', body: 'নতুন সাংগঠনিক আপডেট প্রকাশিত হয়েছে।' };
    if (event.data) {
        try {
            data = event.data.json();
        } catch (e) {
            data.body = event.data.text();
        }
    }

    const options = {
        body: data.body,
        icon: '/icons/icon-192x192.png',
        badge: '/icons/icon-72x72.png',
        vibrate: [100, 50, 100],
        data: {
            url: data.url || '/'
        }
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('notificationclick', event => {
    event.notification.close();
    const targetUrl = event.notification.data ? event.notification.data.url : '/';
    event.waitUntil(
        clients.openWindow(targetUrl)
    );
});
JS;

        file_put_contents(public_path('sw.js'), $swTemplate);
    }

    /**
     * Generate public/offline.html with custom text & colors.
     */
    public function generateOfflinePage(): void
    {
        $title = htmlspecialchars($this->offline_title ?: 'আপনি বর্তমানে অফলাইনে আছেন', ENT_QUOTES, 'UTF-8');
        $msg = nl2br(htmlspecialchars($this->offline_message ?: 'আপনার ডিভাইসে ইন্টারনেট সংযোগ পাওয়া যাচ্ছে না। অনুগ্রহ করে মোবাইল ডেটা বা ওয়াই-ফাই সংযোগ চেক করুন।', ENT_QUOTES, 'UTF-8'));
        $themeColor = $this->theme_color ?: '#0C4B36';
        $bgColor = $this->background_color ?: '#072e20';

        $offlineHtml = <<<HTML
<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="{$themeColor}">
    <title>{$title} - জমঈয়ত শুব্বান</title>
    <link rel="icon" type="image/png" href="/icons/icon-96x96.png">
    <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png">
    <style>
        @font-face {
            font-family: 'Bornomala';
            src: url('/fonts/Bornomala.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Bornomala', 'Kalpurush', system-ui, -apple-system, sans-serif;
        }
        body {
            background: linear-gradient(135deg, {$bgColor} 0%, {$themeColor} 60%, #041810 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #ffffff;
        }
        .offline-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1.5px solid #FBB040;
            border-radius: 24px;
            padding: 40px 30px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
            animation: fadeIn 0.4s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logo-wrap {
            width: 84px;
            height: 84px;
            margin: 0 auto 20px;
            background: #ffffff;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.3);
            border: 2px solid #FBB040;
        }
        .logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        h1 {
            font-size: 1.55rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #FBB040;
        }
        p {
            font-size: 0.96rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 24px;
        }
        .btn-retry {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #FBB040;
            color: #072e20;
            border: none;
            padding: 12px 32px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(251, 176, 64, 0.35);
            transition: all 0.2s ease;
        }
        .btn-retry:hover {
            transform: scale(1.04);
            background: #ffbe53;
        }
        .tip-box {
            margin-top: 25px;
            padding: 12px;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.22);
            font-size: 0.84rem;
            color: rgba(255, 255, 255, 0.75);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 14px;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="offline-card">
        <div class="logo-wrap">
            <img src="/icons/icon-96x96.png" alt="Shubban Logo">
        </div>

        <div class="status-badge">
            <span class="dot"></span>
            <span>সংযোগ বিচ্ছিন্ন</span>
        </div>

        <h1>{$title}</h1>
        <p>{$msg}</p>

        <button type="button" class="btn-retry" onclick="checkConnection()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
            </svg>
            <span>পুনরায় চেষ্টা করুন</span>
        </button>

        <div class="tip-box">
            💡 <strong>টিপস:</strong> ইন্টারনেট ফিরে এলে পেজটি স্বয়ংক্রিয়ভাবে পুনরায় লোড হবে।
        </div>
    </div>

    <script>
        function checkConnection() {
            if (navigator.onLine) {
                window.location.reload();
            } else {
                alert('এখনো কোনো ইন্টারনেট সংযোগ পাওয়া যায়নি। সংযোগ পরীক্ষা করে আবার চেষ্টা করুন।');
            }
        }
        window.addEventListener('online', function() {
            window.location.reload();
        });
    </script>
</body>
</html>
HTML;

        file_put_contents(public_path('offline.html'), $offlineHtml);
    }

    /**
     * Generate public/js/pwa-config.js for client manager.
     */
    public function generateClientConfig(): void
    {
        $config = [
            'is_enabled' => (bool)$this->is_enabled,
            'enable_banner' => (bool)$this->enable_install_banner,
            'banner_title' => $this->banner_title ?: 'শুব্বান অ্যাপ ইনস্টল করুন',
            'banner_subtitle' => $this->banner_subtitle ?: 'দ্রুত ব্রাউজ ও অফলাইনে পড়ার জন্য',
            'banner_btn_text' => $this->banner_btn_text ?: 'ইনস্টল',
            'banner_delay' => (int)($this->banner_delay ?? 2),
            'banner_dismiss_days' => (int)($this->banner_dismiss_days ?? 7),
            'cache_version' => $this->cache_version ?: 'v1.0.0',
        ];

        $js = "window.SHUBBAN_PWA_CONFIG = " . json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . ";\n";
        file_put_contents(public_path('js/pwa-config.js'), $js);
    }

    /**
     * Re-generate all PNG icons from a source file.
     */
    public static function generateIconsFromSource(string $srcFilePath): bool
    {
        if (!file_exists($srcFilePath)) {
            return false;
        }

        $src = @imagecreatefromstring(file_get_contents($srcFilePath));
        if (!$src) {
            return false;
        }

        $origW = imagesx($src);
        $origH = imagesy($src);
        $targetDir = public_path('icons');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $sizes = [72, 96, 128, 144, 152, 180, 192, 384, 512];
        $setting = self::getSettings();
        $hex = ltrim($setting->theme_color ?: '#0C4B36', '#');
        $bgR = hexdec(substr($hex, 0, 2));
        $bgG = hexdec(substr($hex, 2, 2));
        $bgB = hexdec(substr($hex, 4, 2));

        foreach ($sizes as $size) {
            // Regular
            $img = imagecreatetruecolor($size, $size);
            imagealphablending($img, false);
            imagesavealpha($img, true);
            $trans = imagecolorallocatealpha($img, 0, 0, 0, 127);
            imagefill($img, 0, 0, $trans);
            imagealphablending($img, true);

            $scale = min($size / $origW, $size / $origH);
            $newW = (int)round($origW * $scale);
            $newH = (int)round($origH * $scale);
            $dstX = (int)round(($size - $newW) / 2);
            $dstY = (int)round(($size - $newH) / 2);

            imagecopyresampled($img, $src, $dstX, $dstY, 0, 0, $newW, $newH, $origW, $origH);
            imagepng($img, "{$targetDir}/icon-{$size}x{$size}.png", 9);
            imagedestroy($img);

            // Maskable
            if (in_array($size, [192, 512])) {
                $mImg = imagecreatetruecolor($size, $size);
                $bgColor = imagecolorallocate($mImg, $bgR, $bgG, $bgB);
                imagefill($mImg, 0, 0, $bgColor);

                $mPad = (int)round($size * 0.18);
                $mInner = $size - ($mPad * 2);
                $mScale = min($mInner / $origW, $mInner / $origH);
                $mNewW = (int)round($origW * $mScale);
                $mNewH = (int)round($origH * $mScale);
                $mDstX = (int)round(($size - $mNewW) / 2);
                $mDstY = (int)round(($size - $mNewH) / 2);

                $white = imagecolorallocate($mImg, 255, 255, 255);
                $radius = (int)round($size * 0.76);
                $center = (int)round($size / 2);
                imagefilledellipse($mImg, $center, $center, $radius, $radius, $white);

                $gold = imagecolorallocate($mImg, 251, 176, 64);
                imagearc($mImg, $center, $center, $radius + 4, $radius + 4, 0, 360, $gold);

                imagecopyresampled($mImg, $src, $mDstX, $mDstY, 0, 0, $mNewW, $mNewH, $origW, $origH);
                imagepng($mImg, "{$targetDir}/icon-maskable-{$size}x{$size}.png", 9);
                imagedestroy($mImg);
            }
        }

        @copy("{$targetDir}/icon-180x180.png", "{$targetDir}/apple-touch-icon.png");
        @copy("{$targetDir}/icon-96x96.png", public_path('favicon.png'));
        imagedestroy($src);

        return true;
    }
}
