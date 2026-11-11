<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::first();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $validated = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'site_description' => ['required', 'string'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'contact_address' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            // Store new logo
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('admin.settings')
            ->with('success', 'সেটিংস আপডেট করা হয়েছে।');
    }

    public function social(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $validated = $request->validate([
            'facebook_url' => ['nullable', 'url'],
            'twitter_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
        ]);

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('admin.settings')
            ->with('success', 'সামাজিক মিডিয়া লিংক আপডেট করা হয়েছে।');
    }

    /**
     * Display the Theme & Appearance Manager.
     */
    public function theme()
    {
        $settings = Setting::first() ?? new Setting();
        $presets = Setting::getPresets();
        return view('admin.theme.index', compact('settings', 'presets'));
    }

    /**
     * Update Color Theme and Night/Day Mode Settings.
     */
    public function updateTheme(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $validated = $request->validate([
            'color_theme' => ['required', 'string'],
            'primary_color' => ['required', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'accent_color' => ['required', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'default_mode' => ['required', 'in:light,dark,auto'],
            'enable_theme_switcher' => ['nullable'],
        ], [
            'primary_color.regex' => 'প্রাইমারি কালার অবশ্যই একটি বৈধ হেক্স কোড (#RRGGBB) হতে হবে।',
            'accent_color.regex' => 'একসেন্ট কালার অবশ্যই একটি বৈধ হেক্স কোড (#RRGGBB) হতে হবে।',
        ]);

        $settings->color_theme = $validated['color_theme'];
        $settings->primary_color = $validated['primary_color'];
        $settings->accent_color = $validated['accent_color'];
        $settings->default_mode = $validated['default_mode'];
        $settings->enable_theme_switcher = $request->has('enable_theme_switcher');
        $settings->save();

        return redirect()->route('admin.theme.index')
            ->with('success', 'ওয়েবসাইটের কালার থিম ও নাইট/ডে মোড সফলভাবে সংরক্ষিত হয়েছে।');
    }
}
