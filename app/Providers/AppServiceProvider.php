<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Set default pagination view
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.shubban');
        \Illuminate\Pagination\Paginator::defaultSimpleView('vendor.pagination.shubban');

        // Set default locale from session if exists
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
        
        // Set RTL/LTR direction based on locale
        view()->share('direction', in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr');

        // Share theme settings across all views
        view()->composer('*', function ($view) {
            try {
                $themeSettings = \App\Models\Setting::getThemeSettings();
            } catch (\Throwable $e) {
                $themeSettings = [
                    'theme_key' => 'emerald',
                    'primary_color' => '#0C4B36',
                    'accent_color' => '#FBB040',
                    'default_mode' => 'light',
                    'enable_theme_switcher' => true,
                ];
            }
            $view->with('themeSettings', $themeSettings);
        });

        // Share pending counts with all admin views
        view()->composer(['admin.*', 'admin.layouts.*', 'admin.layouts.partials.*'], function ($view) {
            try {
                $adminBadges = [
                    'pending_donations' => \App\Models\Donation::where('status', 'pending')->count(),
                    'pending_promotions' => \App\Models\TierPromotion::where('status', 'pending')->count(),
                    'pending_reports' => \App\Models\ProgramReport::where('status', 'submitted')->count(),
                    'pending_iyanats' => \App\Models\Iyanat::where('status', 'pending')->count(),
                    'unread_contacts' => \App\Models\Contact::where('status', false)->count(),
                ];
                $adminBadges['total_pending'] = array_sum($adminBadges);
            } catch (\Throwable $e) {
                $adminBadges = [
                    'pending_donations' => 0,
                    'pending_promotions' => 0,
                    'pending_reports' => 0,
                    'pending_iyanats' => 0,
                    'unread_contacts' => 0,
                    'total_pending' => 0,
                ];
            }
            $view->with('adminBadges', $adminBadges);
        });
    }
}
