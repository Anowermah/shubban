<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAccessControl;
use App\Models\User;

class PageAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of page access rules.
     */
    public function index(Request $request)
    {
        $query = PageAccessControl::query();

        if ($request->filled('category')) {
            $query->where('page_category', $request->category);
        }

        if ($request->filled('access_level')) {
            $query->where('access_level', $request->access_level);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('page_name', 'like', "%{$s}%")
                  ->orWhere('page_key', 'like', "%{$s}%")
                  ->orWhere('route_pattern', 'like', "%{$s}%");
            });
        }

        $pages = $query->orderBy('page_category')->orderBy('id')->get();

        // Stats
        $stats = [
            'total' => PageAccessControl::count(),
            'public' => PageAccessControl::where('access_level', PageAccessControl::ACCESS_PUBLIC)->count(),
            'authenticated' => PageAccessControl::where('access_level', PageAccessControl::ACCESS_AUTHENTICATED)->count(),
            'restricted_roles' => PageAccessControl::whereNotIn('access_level', [
                PageAccessControl::ACCESS_PUBLIC,
                PageAccessControl::ACCESS_AUTHENTICATED,
            ])->count(),
        ];

        $categories = PageAccessControl::select('page_category')->distinct()->pluck('page_category');
        $accessLevels = PageAccessControl::getAccessLevels();
        $userRoles = PageAccessControl::getUserRoles();

        return view('admin.page_access.index', compact('pages', 'stats', 'categories', 'accessLevels', 'userRoles'));
    }

    /**
     * Store a new page access rule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_key' => ['required', 'string', 'max:100', 'unique:page_access_controls,page_key'],
            'page_name' => ['required', 'string', 'max:255'],
            'page_category' => ['required', 'string', 'max:100'],
            'route_pattern' => ['required', 'string', 'max:255'],
            'route_name' => ['nullable', 'string', 'max:255'],
            'access_level' => ['required', 'string'],
            'allowed_roles' => ['nullable', 'array'],
            'custom_message' => ['nullable', 'string', 'max:500'],
        ], [
            'page_key.required' => 'অনন্য পেজ কি (Key) প্রদান করুন।',
            'page_key.unique' => 'এই পেজ কি-টি ইতিমধ্যে বিদ্যমান।',
            'page_name.required' => 'পেজের নাম প্রদান করুন।',
            'route_pattern.required' => 'ইউআরএল প্যাটার্ন প্রদান করুন।',
        ]);

        $validated['is_active'] = $request->has('is_active');

        PageAccessControl::create($validated);

        return redirect()->route('admin.page-access.index')
            ->with('success', 'নতুন পেজ প্রবেশাধিকার সফলভাবে যুক্ত করা হয়েছে।');
    }

    /**
     * Update an existing page access rule.
     */
    public function update(Request $request, PageAccessControl $pageAccess)
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:255'],
            'page_category' => ['required', 'string', 'max:100'],
            'access_level' => ['required', 'string'],
            'allowed_roles' => ['nullable', 'array'],
            'custom_message' => ['nullable', 'string', 'max:500'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['allowed_roles'] = $request->allowed_roles ?? null;

        $pageAccess->update($validated);

        return redirect()->back()
            ->with('success', "'{$pageAccess->page_name}' পেজের প্রবেশাধিকার সফলভাবে আপডেট করা হয়েছে।");
    }

    /**
     * Bulk update access levels for multiple pages.
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'levels' => ['required', 'array'],
        ]);

        foreach ($request->levels as $id => $level) {
            PageAccessControl::where('id', $id)->update(['access_level' => $level]);
        }

        return redirect()->back()
            ->with('success', 'সকল পেজের প্রবেশাধিকার স্তর এক ক্লিকে সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove a custom page rule.
     */
    public function destroy(PageAccessControl $pageAccess)
    {
        $pageAccess->delete();

        return redirect()->back()
            ->with('success', 'পেজ নিয়মটি সফলভাবে মুছে ফেলা হয়েছে।');
    }

    /**
     * List registered users and their categories/roles.
     */
    public function usersIndex(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $users = $query->latest()->paginate(20);
        $userRoles = PageAccessControl::getUserRoles();

        $stats = [
            'total_users' => User::count(),
            'general_users' => User::where('role', 'user')->count(),
            'members' => User::where('role', 'member')->count(),
            'students' => User::where('role', 'like', 'student%')->count(),
            'officials' => User::where('role', 'official')->count(),
        ];

        return view('admin.page_access.users', compact('users', 'userRoles', 'stats'));
    }

    /**
     * Update a user's role or category.
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string'],
            'worker_tier' => ['nullable', 'string'],
            'org_tier' => ['nullable', 'string'],
            'designation' => ['nullable', 'string', 'max:100'],
            'branch_name' => ['nullable', 'string', 'max:150'],
            'monthly_iyanat' => ['nullable', 'numeric', 'min:0'],
            'category' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:active,inactive,blocked'],
        ]);

        $user->role = $request->role;
        $user->worker_tier = $request->worker_tier ?? $user->worker_tier;
        $user->org_tier = $request->org_tier ?? $user->org_tier;
        $user->designation = $request->designation ?? $user->designation;
        $user->branch_name = $request->branch_name ?? $user->branch_name;
        if ($request->filled('monthly_iyanat')) {
            $user->monthly_iyanat = $request->monthly_iyanat;
        }
        $user->category = $request->category ?? 'general';
        $user->status = $request->status;
        $user->save();

        return redirect()->back()
            ->with('success', "'{$user->name}' এর কর্মী স্তর ও সাংগঠনিক তথ্য সফলভাবে পরিবর্তন করা হয়েছে।");
    }
}
