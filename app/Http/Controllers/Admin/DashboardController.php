<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Donation;
use App\Models\Gallery;
use App\Models\Magazine;
use App\Models\Management;
use App\Models\Member;
use App\Models\News;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\User;
use App\Models\TierPromotion;
use App\Models\ProgramReport;
use App\Models\Iyanat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Safely execute database queries with a default fallback to prevent 500 crashes
     * when tables or columns are not yet migrated or seeded.
     */
    protected function safeQuery(callable $callback, $fallback = 0)
    {
        try {
            return $callback();
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    public function index()
    {
        $now = now();
        $hasUsers = Schema::hasTable('users');
        $hasWorkerTier = $hasUsers && Schema::hasColumn('users', 'worker_tier');

        $stats = [
            'sliders' => [
                'total' => $this->safeQuery(fn() => Slider::count()),
                'active' => $this->safeQuery(fn() => Slider::where('status', true)->count()),
            ],
            'members' => [
                'total' => $this->safeQuery(fn() => Member::count()),
                'active' => $this->safeQuery(fn() => Member::where('status', true)->count()),
            ],
            'users' => [
                'total' => $this->safeQuery(fn() => User::count()),
                'rageb' => $hasWorkerTier ? $this->safeQuery(fn() => User::where('worker_tier', 'rageb')->count()) : 0,
                'aref' => $hasWorkerTier ? $this->safeQuery(fn() => User::where('worker_tier', 'aref')->count()) : 0,
                'salek' => $hasWorkerTier ? $this->safeQuery(fn() => User::where('worker_tier', 'salek')->count()) : 0,
                'saleh' => $hasWorkerTier ? $this->safeQuery(fn() => User::where('worker_tier', 'saleh')->count()) : 0,
            ],
            'management' => [
                'total' => $this->safeQuery(fn() => Management::count()),
                'active' => $this->safeQuery(fn() => Management::where('status', true)->count()),
                'central' => $this->safeQuery(fn() => Management::central()->count()),
                'district' => $this->safeQuery(fn() => Management::district()->count()),
                'upazila' => $this->safeQuery(fn() => Management::upazila()->count()),
                'thana' => $this->safeQuery(fn() => Management::thana()->count()),
                'branch' => $this->safeQuery(fn() => Management::branch()->count()),
                'new' => $this->safeQuery(fn() => Management::whereMonth('created_at', $now->month)->count()),
            ],
            'donations' => [
                'total' => $this->safeQuery(fn() => Donation::count()),
                'pending' => $this->safeQuery(fn() => Donation::where('status', 'pending')->count()),
                'amount' => $this->safeQuery(fn() => Donation::where('status', 'approved')->sum('amount')),
                'this_month' => $this->safeQuery(fn() => Donation::where('status', 'approved')
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('amount')),
            ],
            'organization' => [
                'promotions_pending' => Schema::hasTable('tier_promotions')
                    ? $this->safeQuery(fn() => TierPromotion::where('status', 'pending')->count())
                    : 0,
                'reports_submitted' => Schema::hasTable('program_reports')
                    ? $this->safeQuery(fn() => ProgramReport::where('status', 'submitted')->count())
                    : 0,
                'iyanat_this_month' => Schema::hasTable('iyanats')
                    ? $this->safeQuery(fn() => Iyanat::where('status', 'approved')
                        ->whereMonth('created_at', $now->month)
                        ->whereYear('created_at', $now->year)
                        ->sum('amount'))
                    : 0,
                'iyanat_total' => Schema::hasTable('iyanats')
                    ? $this->safeQuery(fn() => Iyanat::where('status', 'approved')->sum('amount'))
                    : 0,
            ],
            'contacts' => [
                'total' => $this->safeQuery(fn() => Contact::count()),
                'unread' => $this->safeQuery(fn() => Contact::where('status', false)->count()),
            ],
            'news' => [
                'total' => $this->safeQuery(fn() => News::count()),
                'active' => $this->safeQuery(fn() => News::where('status', true)->count()),
            ],
            'notices' => [
                'total' => $this->safeQuery(fn() => Notice::count()),
                'active' => $this->safeQuery(fn() => Notice::where('status', true)->count()),
            ],
            'activities' => [
                'total' => $this->safeQuery(fn() => Activity::count()),
                'active' => $this->safeQuery(fn() => Activity::where('status', true)->count()),
            ],
            'gallery' => [
                'total' => $this->safeQuery(fn() => Gallery::count()),
            ],
            'publications' => [
                'books' => [
                    'total' => $this->safeQuery(fn() => Book::count()),
                    'active' => $this->safeQuery(fn() => Book::where('status', true)->count()),
                ],
                'magazines' => [
                    'total' => $this->safeQuery(fn() => Magazine::count()),
                    'active' => $this->safeQuery(fn() => Magazine::where('status', true)->count()),
                ],
                'articles' => [
                    'total' => $this->safeQuery(fn() => Article::count()),
                    'active' => $this->safeQuery(fn() => Article::where('status', true)->count()),
                ],
            ],
        ];

        $activities = $this->safeQuery(function () {
            return Activity::where('status', true)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }, collect());

        $recentDonations = $this->safeQuery(function () {
            if (Schema::hasTable('donation_causes')) {
                return Donation::with('cause')->latest()->limit(5)->get();
            }
            return Donation::latest()->limit(5)->get();
        }, collect());

        $recentPromotions = $this->safeQuery(function () {
            if (Schema::hasTable('tier_promotions')) {
                return TierPromotion::with('user')->latest()->limit(4)->get();
            }
            return collect();
        }, collect());

        $recentReports = $this->safeQuery(function () {
            if (Schema::hasTable('program_reports')) {
                return ProgramReport::with('user')->latest()->limit(4)->get();
            }
            return collect();
        }, collect());

        $recentUsers = $this->safeQuery(function () {
            return User::latest()->limit(5)->get();
        }, collect());

        return view('admin.dashboard.index', compact(
            'stats',
            'activities',
            'recentDonations',
            'recentPromotions',
            'recentReports',
            'recentUsers'
        ));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function sendToPublications(Request $request)
    {
        $booksData = [
            'total_books' => $request->total_books,
            'categories' => $request->categories,
        ];

        $request->session()->put('dashboard_books_data', $booksData);

        return redirect()->route('publications.books')
            ->with('success', 'Data sent to publications successfully');
    }
}
