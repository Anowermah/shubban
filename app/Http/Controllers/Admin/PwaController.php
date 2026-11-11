<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PwaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PwaController extends Controller
{
    /**
     * Display PWA Settings and Health Audit.
     */
    public function index()
    {
        $pwa = PwaSetting::getSettings();

        // PWA Health Audit Checklist
        $manifestPath = public_path('manifest.json');
        $swPath = public_path('sw.js');
        $offlinePath = public_path('offline.html');
        $icon192 = public_path('icons/icon-192x192.png');
        $icon512 = public_path('icons/icon-512x512.png');
        $maskable192 = public_path('icons/icon-maskable-192x192.png');

        $health = [
            'manifest_ok' => file_exists($manifestPath) && json_decode(file_get_contents($manifestPath)) !== null,
            'sw_ok' => file_exists($swPath) && filesize($swPath) > 500,
            'offline_ok' => file_exists($offlinePath) && filesize($offlinePath) > 500,
            'icons_ok' => file_exists($icon192) && file_exists($icon512) && file_exists($maskable192),
            'https_ok' => request()->isSecure() || in_array(request()->getHost(), ['127.0.0.1', 'localhost']),
            'total_score' => 100,
        ];

        return view('admin.pwa.index', compact('pwa', 'health'));
    }

    /**
     * Update PWA configuration and sync files.
     */
    public function update(Request $request)
    {
        $pwa = PwaSetting::getSettings();

        $validated = $request->validate([
            'app_name' => 'required|string|max:100',
            'app_short_name' => 'required|string|max:40',
            'app_description' => 'nullable|string|max:500',
            'start_url' => 'required|string|max:100',
            'display_mode' => 'required|in:standalone,fullscreen,minimal-ui,browser',
            'orientation' => 'required|in:portrait-primary,any,landscape',
            'theme_color' => ['required', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'background_color' => ['required', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'app_icon' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'banner_title' => 'required|string|max:100',
            'banner_subtitle' => 'nullable|string|max:200',
            'banner_btn_text' => 'required|string|max:30',
            'banner_delay' => 'required|integer|min:0|max:60',
            'banner_dismiss_days' => 'required|integer|min:1|max:90',
            'offline_title' => 'required|string|max:150',
            'offline_message' => 'nullable|string|max:500',
            'shortcuts' => 'nullable|array',
        ]);

        $pwa->is_enabled = $request->has('is_enabled');
        $pwa->enable_install_banner = $request->has('enable_install_banner');
        $pwa->app_name = $validated['app_name'];
        $pwa->app_short_name = $validated['app_short_name'];
        $pwa->app_description = $validated['app_description'];
        $pwa->start_url = $validated['start_url'];
        $pwa->display_mode = $validated['display_mode'];
        $pwa->orientation = $validated['orientation'];
        $pwa->theme_color = $validated['theme_color'];
        $pwa->background_color = $validated['background_color'];
        $pwa->banner_title = $validated['banner_title'];
        $pwa->banner_subtitle = $validated['banner_subtitle'];
        $pwa->banner_btn_text = $validated['banner_btn_text'];
        $pwa->banner_delay = (int)$validated['banner_delay'];
        $pwa->banner_dismiss_days = (int)$validated['banner_dismiss_days'];
        $pwa->offline_title = $validated['offline_title'];
        $pwa->offline_message = $validated['offline_message'];

        // Process shortcuts
        if ($request->has('shortcuts') && is_array($request->shortcuts)) {
            $formattedShortcuts = [];
            foreach ($request->shortcuts as $sc) {
                if (!empty($sc['name']) && !empty($sc['url'])) {
                    $formattedShortcuts[] = [
                        'name' => trim($sc['name']),
                        'short_name' => trim($sc['short_name'] ?? $sc['name']),
                        'url' => trim($sc['url']),
                        'description' => trim($sc['description'] ?? ''),
                        'icon' => '/icons/icon-96x96.png',
                        'is_active' => isset($sc['is_active']) && ($sc['is_active'] == '1' || $sc['is_active'] === true),
                    ];
                }
            }
            $pwa->shortcuts = $formattedShortcuts;
        }

        // Upload custom app icon and generate sizes
        if ($request->hasFile('app_icon')) {
            $file = $request->file('app_icon');
            $iconPath = $file->storeAs('pwa', 'app-master-icon.png', 'public');
            $pwa->app_icon = $iconPath;
            PwaSetting::generateIconsFromSource(storage_path('app/public/' . $iconPath));
        }

        $pwa->save();
        $pwa->syncFiles();

        return redirect()->route('admin.pwa.index')
            ->with('success', 'পিডব্লিউএ (PWA) কনফিগারেশন ও সেটিংস সফলভাবে সংরক্ষিত হয়েছে।');
    }

    /**
     * Re-generate all PWA icon sizes.
     */
    public function regenerateIcons()
    {
        $pwa = PwaSetting::getSettings();
        $src = null;

        if ($pwa->app_icon && file_exists(storage_path('app/public/' . $pwa->app_icon))) {
            $src = storage_path('app/public/' . $pwa->app_icon);
        } elseif (file_exists(public_path('images/logo.png'))) {
            $src = public_path('images/logo.png');
        } elseif (file_exists(public_path('images/main-shubban-logo.png'))) {
            $src = public_path('images/main-shubban-logo.png');
        }

        if ($src && PwaSetting::generateIconsFromSource($src)) {
            $pwa->syncFiles();
            return redirect()->route('admin.pwa.index')
                ->with('success', 'সকল মাপের (৭২x৭২ থেকে ৫১২x৫১২ মাস্কেবল) পিডব্লিউএ আইকন সফলভাবে পুনর্নির্মাণ করা হয়েছে।');
        }

        return redirect()->route('admin.pwa.index')
            ->with('error', 'আইকন রি-জেনারেট করা যায়নি। মূল লোগো ইমেজ পাওয়া যায়নি।');
    }

    /**
     * Bump Cache Version to force update on all clients.
     */
    public function bumpCache()
    {
        $pwa = PwaSetting::getSettings();
        
        // Bump version number (e.g. v1.0.0 -> v1.0.1 or timestamp)
        $current = $pwa->cache_version ?: 'v1.0.0';
        if (preg_match('/v(\d+)\.(\d+)\.(\d+)/', $current, $matches)) {
            $newPatch = (int)$matches[3] + 1;
            $newVersion = "v{$matches[1]}.{$matches[2]}.{$newPatch}";
        } else {
            $newVersion = 'v1.0.' . time();
        }

        $pwa->cache_version = $newVersion;
        $pwa->save();
        $pwa->syncFiles();

        return redirect()->route('admin.pwa.index')
            ->with('success', "সার্ভিস ওয়ার্কার ক্যাশ ভার্সন সফলভাবে আপডেট করা হয়েছে ({$newVersion})। সকল ইনস্টল করা ডিভাইস ও ভিজিটররা নতুন ক্যাশ ও কোড গ্রহণ করবে।");
    }

    /**
     * Reset PWA to Factory Settings.
     */
    public function reset()
    {
        PwaSetting::truncate();
        $pwa = PwaSetting::getSettings();
        $pwa->syncFiles();

        return redirect()->route('admin.pwa.index')
            ->with('success', 'পিডব্লিউএ (PWA) কনফিগারেশন ডিফল্ট ফ্যাক্টরি সেটিংসে রিসেট করা হয়েছে।');
    }
}
