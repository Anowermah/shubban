<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Book;
use App\Models\Notice;
use App\Models\News;
use App\Models\Management;
use App\Models\Committee;
use App\Models\Event;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));
        $category = $request->input('type', 'all');

        $results = [];
        $totalCount = 0;

        if (!empty($query)) {
            $results = $this->performSearch($query);
            $totalCount = count($results);
        }

        $groupedResults = collect($results)->groupBy('category');

        return view('search.index', compact('query', 'results', 'groupedResults', 'totalCount', 'category'));
    }

    public function live(Request $request)
    {
        $query = trim($request->input('q', ''));

        if (mb_strlen($query) < 1) {
            return response()->json([
                'status' => 'empty',
                'results' => [],
                'total' => 0
            ]);
        }

        $allResults = $this->performSearch($query);
        $total = count($allResults);

        // Limit to top 8 items for fast dropdown rendering
        $results = array_slice($allResults, 0, 8);

        return response()->json([
            'status' => 'success',
            'query' => $query,
            'total' => $total,
            'results' => $results
        ]);
    }

    protected function performSearch(string $query): array
    {
        $items = [];

        // 1. Books (বই ও কিতাব)
        try {
            if (Schema::hasTable('books')) {
                $books = Book::where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('author', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })->take(10)->get();

                foreach ($books as $book) {
                    $items[] = [
                        'title' => $book->title,
                        'category' => 'বই',
                        'category_badge' => 'bg-success',
                        'subtitle' => $book->author ? 'লেখক: ' . $book->author : 'শুব্বান প্রকাশনা',
                        'url' => route('publications.books.read', $book->id),
                        'icon' => 'fas fa-book-open',
                        'image' => $book->cover_image ? asset('storage/' . $book->cover_image) : null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 2. News (সংবাদ)
        try {
            if (Schema::hasTable('news')) {
                $newsList = News::where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })->take(8)->get();

                foreach ($newsList as $news) {
                    $items[] = [
                        'title' => $news->title,
                        'category' => 'সংবাদ',
                        'category_badge' => 'bg-info text-dark',
                        'subtitle' => mb_substr(strip_tags($news->description ?? ''), 0, 70) . '...',
                        'url' => route('news.show', $news->id),
                        'icon' => 'fas fa-newspaper',
                        'image' => $news->image ? asset('storage/' . $news->image) : null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 3. Notices (নোটিশ)
        try {
            if (Schema::hasTable('notices')) {
                $notices = Notice::where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                })->take(8)->get();

                foreach ($notices as $notice) {
                    $items[] = [
                        'title' => $notice->title,
                        'category' => 'নোটিশ',
                        'category_badge' => 'bg-warning text-dark',
                        'subtitle' => ($notice->category ? '[' . $notice->category . '] ' : '') . mb_substr(strip_tags($notice->description ?? ''), 0, 60),
                        'url' => route('notice.index'),
                        'icon' => 'fas fa-bullhorn',
                        'image' => null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 4. District & Branch Responsible (দায়িত্বশীল পরিষদ)
        try {
            if (Schema::hasTable('managements')) {
                $managers = Management::where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('designation', 'LIKE', "%{$query}%")
                      ->orWhere('area', 'LIKE', "%{$query}%")
                      ->orWhere('phone', 'LIKE', "%{$query}%");
                })->take(10)->get();

                foreach ($managers as $mgr) {
                    $levelRoute = in_array($mgr->level, ['district', 'upazila', 'thana', 'branch']) 
                        ? route('responsible.' . $mgr->level) 
                        : route('responsible.central');

                    $items[] = [
                        'title' => $mgr->name,
                        'category' => 'দায়িত্বশীল',
                        'category_badge' => 'bg-primary',
                        'subtitle' => $mgr->designation . ($mgr->area ? ' (' . $mgr->area . ')' : ''),
                        'url' => $levelRoute,
                        'icon' => 'fas fa-user-tie',
                        'image' => $mgr->image ? asset('storage/' . $mgr->image) : null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 5. Central Committee (কেন্দ্রীয় পরিষদ)
        try {
            if (Schema::hasTable('committees')) {
                $committees = Committee::where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('designation', 'LIKE', "%{$query}%");
                })->take(6)->get();

                foreach ($committees as $comm) {
                    $items[] = [
                        'title' => $comm->name,
                        'category' => 'কেন্দ্রীয় কমিটি',
                        'category_badge' => 'bg-success',
                        'subtitle' => $comm->designation,
                        'url' => route('responsible.central'),
                        'icon' => 'fas fa-star',
                        'image' => $comm->image ? asset('storage/' . $comm->image) : null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 6. Events (ইভেন্ট ও সম্মেলন)
        try {
            if (Schema::hasTable('events')) {
                $events = Event::where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('location', 'LIKE', "%{$query}%");
                })->take(6)->get();

                foreach ($events as $evt) {
                    $title = is_array($evt->title) ? ($evt->title['bn'] ?? reset($evt->title)) : $evt->title;
                    $items[] = [
                        'title' => $title,
                        'category' => 'ইভেন্ট',
                        'category_badge' => 'bg-danger',
                        'subtitle' => $evt->location ?? 'সম্মেলন ও কর্মসূচি',
                        'url' => route('events.show', $evt->slug ?? $evt->id),
                        'icon' => 'fas fa-calendar-alt',
                        'image' => $evt->image ? asset('storage/' . $evt->image) : null
                    ];
                }
            }
        } catch (\Throwable $e) {}

        return $items;
    }
}
