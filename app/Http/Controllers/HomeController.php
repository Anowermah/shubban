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
        try {
            HomeSection::seedDefaultsIfEmpty();
            $homeSections = HomeSection::orderBy('order')->get();
            $sectionsMap = $homeSections->keyBy('section_key');
        } catch (\Throwable $e) {
            $homeSections = collect([]);
            $sectionsMap = collect([]);
        }

        // Dynamic limits based on section config
        $sliderLimit = $sectionsMap['hero_slider']->item_limit ?? 5;
        $noticeLimit = $sectionsMap['notice_board']->item_limit ?? 5;
        $activityLimit = $sectionsMap['activities_news']->item_limit ?? 4;
        $photoLimit = $sectionsMap['photos']->item_limit ?? 8;
        $videoLimit = $sectionsMap['videos']->item_limit ?? 4;
        $archiveLimit = $sectionsMap['archives']->item_limit ?? 4;
        $bookLimit = $sectionsMap['books']->item_limit ?? 4;
        $articleLimit = $sectionsMap['articles']->item_limit ?? 6;

        try {
            $sliders = Slider::where('status', true)->latest()->take($sliderLimit)->get();
        } catch (\Throwable $e) { $sliders = collect([]); }

        try {
            $news = News::where('status', true)->latest()->take(6)->get();
        } catch (\Throwable $e) { $news = collect([]); }

        try {
            $notices = Notice::where('status', true)->latest()->take($noticeLimit)->get();
        } catch (\Throwable $e) { $notices = collect([]); }

        try {
            $photos = Photo::where('status', true)->latest()->take($photoLimit)->get();
        } catch (\Throwable $e) { $photos = collect([]); }

        try {
            $videos = Video::where('status', true)->latest()->take($videoLimit)->get();
        } catch (\Throwable $e) { $videos = collect([]); }

        try {
            $archives = Archive::where('status', true)->latest()->take($archiveLimit)->get();
        } catch (\Throwable $e) { $archives = collect([]); }

        try {
            $activities = Activity::where('status', true)->orderBy('created_at', 'desc')->take($activityLimit)->get();
        } catch (\Throwable $e) { $activities = collect([]); }

        try {
            $featuredBooks = Book::where('status', 'published')->orWhere('status', 1)->latest()->take($bookLimit)->get();
            if ($featuredBooks->isEmpty()) {
                $featuredBooks = Book::latest()->take($bookLimit)->get();
            }
        } catch (\Throwable $e) { $featuredBooks = collect([]); }

        try {
            $latestMagazine = Magazine::latest()->first();
        } catch (\Throwable $e) { $latestMagazine = null; }

        try {
            $articles = Article::where('status', 'published')->orWhere('status', 1)->orWhere('status', true)->latest()->take($articleLimit)->get();
            if ($articles->isEmpty()) {
                $articles = Article::latest()->take($articleLimit)->get();
            }
        } catch (\Throwable $e) { $articles = collect([]); }

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
