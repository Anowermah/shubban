<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PageAccessControl;

class CheckPageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip admin routes, assets, and auth routes
        if (
            $request->is('admin*') ||
            $request->is('api*') ||
            $request->is('login') ||
            $request->is('register') ||
            $request->is('logout') ||
            $request->is('guest') ||
            $request->is('_ignition*')
        ) {
            return $next($request);
        }

        // Fetch active restricted page rules with defensive check
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('page_access_controls')) {
                return $next($request);
            }

            $restrictedRules = PageAccessControl::where('is_active', true)
                ->where('access_level', '!=', PageAccessControl::ACCESS_PUBLIC)
                ->get();
        } catch (\Throwable $e) {
            return $next($request);
        }

        if (!$restrictedRules || $restrictedRules->isEmpty()) {
            return $next($request);
        }

        $currentRouteName = $request->route() ? $request->route()->getName() : null;
        $currentPath = trim($request->path(), '/');

        foreach ($restrictedRules as $rule) {
            $isMatch = false;

            // Match by route name if set
            if ($currentRouteName && $rule->route_name && $currentRouteName === $rule->route_name) {
                $isMatch = true;
            }

            // Match by URL pattern
            if (!$isMatch && $rule->route_pattern) {
                $pattern = trim($rule->route_pattern, '/');
                if ($request->is($pattern)) {
                    $isMatch = true;
                }
            }

            if ($isMatch) {
                $user = Auth::guard('web')->user();

                // If user doesn't have access
                if (!$rule->userCanAccess($user)) {
                    // If user is a Guest (not logged in)
                    if (!$user) {
                        if ($request->expectsJson()) {
                            return response()->json([
                                'message' => 'এই পেজটি দেখার জন্য লগইন আবশ্যক।',
                            ], 401);
                        }

                        $message = $rule->custom_message ?: 'এই পেজটি দেখার জন্য অ্যাকাউন্টে লগইন করতে হবে। গেস্ট হিসেবে এই পেজে প্রবেশের অনুমতি নেই।';

                        return redirect()->guest(route('login'))
                            ->with('login_warning', $message);
                    }

                    // User is logged in, but lacks required role/category
                    $levels = PageAccessControl::getAccessLevels();
                    $levelInfo = $levels[$rule->access_level] ?? null;
                    $levelLabel = $levelInfo ? $levelInfo['label'] : $rule->access_level;

                    return response()->view('errors.access_denied', [
                        'page' => $rule,
                        'user' => $user,
                        'requiredLevel' => $levelLabel,
                    ], 403);
                }

                // If matched and passed, break loop
                break;
            }
        }

        return $next($request);
    }
}
