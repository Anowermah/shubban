<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Magazine;
use App\Models\Article;
use App\Models\Activity;
use App\Models\Notice;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engines.
     */
    public function index()
    {
        $baseUrl = url('/');

        $staticPages = [
            ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/about/introduction', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/about/history', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/about/goals', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/about/committee', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/publications/books', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/publications/magazines', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/publications/articles', 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/activities', 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/notice', 'priority' => '0.8', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/gallery/photos', 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/gallery/videos', 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/facilities/research-center', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/facilities/shekor', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/facilities/as-shifa', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/facilities/maktabah', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/training/courses', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/contact', 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/donate', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
        ];

        // Dynamic Books
        $books = Book::where('status', 'published')->get();
        foreach ($books as $b) {
            $staticPages[] = [
                'loc' => route('publications.books.read', $b->id),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $b->updated_at ? $b->updated_at->format('Y-m-d') : date('Y-m-d'),
            ];
        }

        // Dynamic Magazines
        $magazines = Magazine::where('status', 'published')->get();
        foreach ($magazines as $m) {
            $staticPages[] = [
                'loc' => route('publications.magazines.read', $m->id),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $m->updated_at ? $m->updated_at->format('Y-m-d') : date('Y-m-d'),
            ];
        }

        // Dynamic Articles
        $articles = Article::where('status', 'published')->get();
        foreach ($articles as $a) {
            $staticPages[] = [
                'loc' => route('publications.articles.read', $a->id),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $a->updated_at ? $a->updated_at->format('Y-m-d') : date('Y-m-d'),
            ];
        }

        // Dynamic Activities
        $activities = Activity::where('status', true)->get();
        foreach ($activities as $act) {
            $staticPages[] = [
                'loc' => route('activities.show', $act->id),
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'lastmod' => $act->updated_at ? $act->updated_at->format('Y-m-d') : date('Y-m-d'),
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($page['loc']) . '</loc>';
            $xml .= '<lastmod>' . $page['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}
