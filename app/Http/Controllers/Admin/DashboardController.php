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

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $stats = [
            'sliders' => [
                'total' => Slider::count(),
                'active' => Slider::where('status', true)->count()
            ],
            'members' => [
                'total' => Member::count(),
                'active' => Member::where('status', true)->count()
            ],
            'users' => [
                'total' => User::count(),
                'rageb' => User::where('worker_tier', 'rageb')->count(),
                'aref' => User::where('worker_tier', 'aref')->count(),
                'salek' => User::where('worker_tier', 'salek')->count(),
                'saleh' => User::where('worker_tier', 'saleh')->count(),
            ],
            'management' => [
                'total' => Management::count(),
                'active' => Management::where('status', true)->count(),
                'central' => Management::central()->count(),
                'district' => Management::district()->count(),
                'upazila' => Management::upazila()->count(),
                'thana' => Management::thana()->count(),
                'branch' => Management::branch()->count(),
                'new' => Management::whereMonth('created_at', now()->month)->count()
            ],
            'donations' => [
                'total' => Donation::count(),
                'pending' => Donation::where('status', 'pending')->count(),
                'amount' => Donation::where('status', 'approved')->sum('amount'),
                'this_month' => Donation::where('status', 'approved')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('amount'),
            ],
            'organization' => [
                'promotions_pending' => TierPromotion::where('status', 'pending')->count(),
                'reports_submitted' => ProgramReport::where('status', 'submitted')->count(),
                'iyanat_this_month' => Iyanat::where('status', 'approved')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('amount'),
                'iyanat_total' => Iyanat::where('status', 'approved')->sum('amount'),
            ],
            'contacts' => [
                'total' => Contact::count(),
                'unread' => Contact::where('status', false)->count()
            ],
            'news' => [
                'total' => News::count(),
                'active' => News::where('status', true)->count()
            ],
            'notices' => [
                'total' => Notice::count(),
                'active' => Notice::where('status', true)->count()
            ],
            'activities' => [
                'total' => Activity::count(),
                'active' => Activity::where('status', true)->count()
            ],
            'gallery' => [
                'total' => Gallery::count()
            ],
            'publications' => [
                'books' => [
                    'total' => Book::count(),
                    'active' => Book::where('status', true)->count()
                ],
                'magazines' => [
                    'total' => Magazine::count(),
                    'active' => Magazine::where('status', true)->count()
                ],
                'articles' => [
                    'total' => Article::count(),
                    'active' => Article::where('status', true)->count()
                ]
            ]
        ];

        $activities = Activity::where('status', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentDonations = Donation::with('cause')
            ->latest()
            ->limit(5)
            ->get();

        $recentPromotions = TierPromotion::with('user')
            ->latest()
            ->limit(4)
            ->get();

        $recentReports = ProgramReport::with('user')
            ->latest()
            ->limit(4)
            ->get();

        $recentUsers = User::latest()
            ->limit(5)
            ->get();

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
        // Prepare your books data here
        $booksData = [
            'total_books' => $request->total_books,
            'categories' => $request->categories,
            // Add other relevant data
        ];

        // Store in session for transfer
        $request->session()->put('dashboard_books_data', $booksData);

        return redirect()->route('publications.books')
            ->with('success', 'Data sent to publications successfully');
    }
}
