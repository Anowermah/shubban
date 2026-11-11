/**
 * Shubban Progressive Web App (PWA) Client-side Manager
 * Handles Service Worker registration, Install Prompts & Offline Network Alerts.
 */
(function () {
    'use strict';

    const config = window.SHUBBAN_PWA_CONFIG || {
        is_enabled: true,
        enable_banner: true,
        banner_title: 'শুব্বান অ্যাপ ইনস্টল করুন',
        banner_subtitle: 'দ্রুত ব্রাউজ ও অফলাইনে পড়ার জন্য',
        banner_btn_text: 'ইনস্টল',
        banner_delay: 2,
        banner_dismiss_days: 7,
        cache_version: 'v1.0.0'
    };

    if (!config.is_enabled) {
        return;
    }

    // 1. Register Service Worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js?v=' + (config.cache_version || '1.0.0'), { scope: '/' })
                .then(function (registration) {
                    console.log('[PWA] Service Worker registered with scope:', registration.scope);
                    
                    // Check for updates
                    registration.onupdatefound = function () {
                        const installingWorker = registration.installing;
                        if (installingWorker) {
                            installingWorker.onstatechange = function () {
                                if (installingWorker.state === 'installed') {
                                    if (navigator.serviceWorker.controller) {
                                        console.log('[PWA] New version installed! Ready to activate.');
                                    }
                                }
                            };
                        }
                    };
                })
                .catch(function (error) {
                    console.warn('[PWA] Service Worker registration failed:', error);
                });
        });
    }

    // 2. Install App Banner Logic
    if (!config.enable_banner) {
        return;
    }

    let deferredPrompt = null;
    const DISMISS_KEY = 'shubban_pwa_install_dismissed';

    // Check if already in standalone display mode
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches ||
                         window.navigator.standalone === true;

    window.addEventListener('beforeinstallprompt', function (e) {
        e.preventDefault();
        deferredPrompt = e;

        // Check dismissal memory based on configured days
        const dismissDays = parseInt(config.banner_dismiss_days, 10) || 7;
        const dismissedTime = localStorage.getItem(DISMISS_KEY);
        if (dismissedTime && (Date.now() - parseInt(dismissedTime, 10)) < (dismissDays * 24 * 60 * 60 * 1000)) {
            return;
        }

        if (!isStandalone) {
            const delayMs = (parseInt(config.banner_delay, 10) || 2) * 1000;
            setTimeout(showInstallBanner, delayMs);
        }
    });

    function showInstallBanner() {
        if (document.getElementById('shubbanPwaBanner')) {
            return;
        }

        const banner = document.createElement('div');
        banner.id = 'shubbanPwaBanner';
        banner.innerHTML = `
            <style>
                #shubbanPwaBanner {
                    position: fixed;
                    bottom: 20px;
                    left: 20px;
                    max-width: 420px;
                    width: calc(100vw - 40px);
                    background: #ffffff;
                    border: 1.5px solid #FBB040;
                    border-radius: 16px;
                    padding: 12px 16px;
                    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.22);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 12px;
                    z-index: 1060;
                    animation: pwaSlideUp 0.3s ease-out;
                    font-family: inherit;
                }
                [data-theme="dark"] #shubbanPwaBanner {
                    background: #1e293b;
                    border-color: #FBB040;
                    color: #f8fafc;
                }
                @keyframes pwaSlideUp {
                    from { transform: translateY(100px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
                .pwa-banner-icon {
                    width: 44px;
                    height: 44px;
                    border-radius: 10px;
                    flex-shrink: 0;
                    background: #0C4B36;
                    padding: 3px;
                }
                .pwa-banner-icon img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
                .pwa-banner-text {
                    flex: 1;
                    min-width: 0;
                }
                .pwa-banner-title {
                    font-size: 0.88rem;
                    font-weight: 700;
                    margin: 0;
                    line-height: 1.3;
                    color: #0C4B36;
                }
                [data-theme="dark"] .pwa-banner-title {
                    color: #FBB040;
                }
                .pwa-banner-sub {
                    font-size: 0.76rem;
                    color: #64748b;
                    margin: 2px 0 0;
                    line-height: 1.2;
                }
                [data-theme="dark"] .pwa-banner-sub {
                    color: #94a3b8;
                }
                .pwa-banner-actions {
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    flex-shrink: 0;
                }
                .btn-pwa-install {
                    background: #0C4B36;
                    color: #ffffff;
                    border: none;
                    padding: 6px 14px;
                    border-radius: 20px;
                    font-size: 0.8rem;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background 0.2s;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                }
                .btn-pwa-install:hover {
                    background: #FBB040;
                    color: #072e20;
                }
                .btn-pwa-dismiss {
                    background: transparent;
                    border: none;
                    color: #94a3b8;
                    font-size: 1rem;
                    padding: 4px 6px;
                    cursor: pointer;
                    line-height: 1;
                }
                .btn-pwa-dismiss:hover {
                    color: #ef4444;
                }
            </style>
            <div class="d-flex align-items-center gap-2 flex-grow-1 overflow-hidden">
                <div class="pwa-banner-icon">
                    <img src="/icons/icon-96x96.png" alt="Shubban">
                </div>
                <div class="pwa-banner-text">
                    <div class="pwa-banner-title">${config.banner_title || 'শুব্বান অ্যাপ ইনস্টল করুন'}</div>
                    <div class="pwa-banner-sub">${config.banner_subtitle || 'দ্রুত ব্রাউজ ও অফলাইনে পড়ার জন্য'}</div>
                </div>
            </div>
            <div class="pwa-banner-actions">
                <button type="button" class="btn-pwa-install" id="btnPwaInstallAction">
                    <span>${config.banner_btn_text || 'ইনস্টল'}</span>
                </button>
                <button type="button" class="btn-pwa-dismiss" id="btnPwaDismissAction" title="পরে">
                    ✕
                </button>
            </div>
        `;

        document.body.appendChild(banner);

        document.getElementById('btnPwaInstallAction').addEventListener('click', function () {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then(function (choiceResult) {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('[PWA] User accepted the install prompt');
                    }
                    deferredPrompt = null;
                    banner.remove();
                });
            }
        });

        document.getElementById('btnPwaDismissAction').addEventListener('click', function () {
            localStorage.setItem(DISMISS_KEY, Date.now().toString());
            banner.remove();
        });
    }

    // Installed event listener
    window.addEventListener('appinstalled', function () {
        console.log('[PWA] Shubban application installed successfully!');
        const banner = document.getElementById('shubbanPwaBanner');
        if (banner) banner.remove();
    });

    // 3. Online/Offline Network Status Indicators
    function showNetworkToast(isOnline) {
        let toast = document.getElementById('shubbanNetworkToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'shubbanNetworkToast';
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                padding: 8px 18px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 600;
                z-index: 1070;
                box-shadow: 0 8px 24px rgba(0,0,0,0.25);
                display: flex;
                align-items: center;
                gap: 8px;
                transition: opacity 0.3s ease;
                pointer-events: none;
            `;
            document.body.appendChild(toast);
        }

        if (isOnline) {
            toast.style.background = '#0C4B36';
            toast.style.color = '#ffffff';
            toast.style.border = '1px solid #22c55e';
            toast.innerHTML = '<span>✅</span> <span>ইন্টারনেট সংযোগ পুনরায় সংযুক্ত হয়েছে</span>';
            setTimeout(() => {
                if (toast) toast.remove();
            }, 3000);
        } else {
            toast.style.background = '#dc2626';
            toast.style.color = '#ffffff';
            toast.style.border = '1px solid #f87171';
            toast.innerHTML = '<span>⚠️</span> <span>আপনি বর্তমানে অফলাইনে আছেন</span>';
        }
    }

    window.addEventListener('online', () => showNetworkToast(true));
    window.addEventListener('offline', () => showNetworkToast(false));
})();
