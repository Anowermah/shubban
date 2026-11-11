<?php

namespace App\Providers;

use App\Models\Notice;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share notices with header
        View::composer('layouts.partials.header', function ($view) {
            try {
                $notices = Notice::where('status', 1)
                    ->latest()
                    ->take(5)
                    ->get();
                
                $view->with('notices', $notices);
            } catch (\Exception $e) {
                $view->with('notices', collect([]));
            }
        });
    }

    public function register()
    {
        //
    }
}
