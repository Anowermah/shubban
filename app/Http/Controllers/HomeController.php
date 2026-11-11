<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\News;
use App\Models\Notice;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Archive;
use App\Models\Activity;
use App\Models\Book;
use App\Models\Magazine;
use App\Models\Article;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage with dynamically ordered and configurable sections.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        HomeSection::seedDefaultsIfEmpty();
        $homeSections = HomeSection::orderBy('order')->get();
        $sectionsMap = $homeSections->keyBy('section_key');

        // Dynamic limits based on section config
        $sliderLimit = $sectionsMap['hero_slider']->item_limit ?? 5;
        $noticeLimit = $sectionsMap['notice_board']->item_limit ?? 5;
        $activityLimit = $sectionsMap['activities_news']->item_limit ?? 4;
        $photoLimit = $sectionsMap['photos']->item_limit ?? 8;
        $videoLimit = $sectionsMap['videos']->item_limit ?? 4;
        $archiveLimit = $sectionsMap['archives']->item_limit ?? 4;
        $bookLimit = $sectionsMap['books']->item_limit ?? 4;
        $articleLimit = $sectionsMap['articles']->item_limit ?? 6;

        $sliders = Slider::where('status', true)
                        ->latest()
                        ->take($sliderLimit)
                        ->get();

        $news = News::where('status', true)
                   ->latest()
                   ->take(6)
                   ->get();

        $notices = Notice::where('status', true)
                        ->latest()
                        ->take($noticeLimit)
                        ->get();

        $photos = Photo::where('status', true)
                      ->latest()
                      ->take($photoLimit)
                      ->get();

        $videos = Video::where('status', true)
                      ->latest()
                      ->take($videoLimit)
                      ->get();

        $archives = Archive::where('status', true)
                         ->latest()
                         ->take($archiveLimit)
                         ->get();

        $activities = Activity::where('status', true)
                            ->orderBy('created_at', 'desc')
                            ->take($activityLimit)
                            ->get();

        $featuredBooks = Book::where('status', 'published')
                            ->orWhere('status', 1)
                            ->latest()
                            ->take($bookLimit)
                            ->get();
        if ($featuredBooks->isEmpty()) {
            $featuredBooks = Book::latest()->take($bookLimit)->get();
        }

        $latestMagazine = Magazine::latest()->first();

        $articles = Article::where('status', 'published')
                            ->orWhere('status', 1)
                            ->orWhere('status', true)
                            ->latest()
                            ->take($articleLimit)
                            ->get();
        if ($articles->isEmpty()) {
            $articles = Article::latest()->take($articleLimit)->get();
        }

        return view('welcome', compact(
            'homeSections',
            'sliders',
            'news',
            'notices',
            'photos',
            'videos',
            'archives',
            'activities',
            'featuredBooks',
            'latestMagazine',
            'articles'
        ));
    }
}
