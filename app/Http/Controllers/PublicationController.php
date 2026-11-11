<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Magazine;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a paginated listing of published books with search and filters.
     */
    public function books(Request $request)
    {
        $search = $request->query('search');
        $price = $request->query('price');
        $sort = $request->query('sort', 'latest');

        $query = Book::where('status', 'published');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($price === 'free') {
            $query->where(function ($q) {
                $q->whereNull('price')->orWhere('price', '<=', 0);
            });
        } elseif ($price === 'paid') {
            $query->where('price', '>', 0);
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $books = $query->paginate(12)->withQueryString();
        $totalPublishedBooks = Book::where('status', 'published')->count();

        return view('publications.books', compact('books', 'totalPublishedBooks'));
    }

    /**
     * Read book online.
     */
    public function readBook(Book $book)
    {
        $relatedBooks = Book::where('status', 'published')
            ->where('id', '!=', $book->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('publications.books.read', compact('book', 'relatedBooks'));
    }

    /**
     * Display a paginated listing of published magazines with search and filters.
     */
    public function magazines(Request $request)
    {
        $search = $request->query('search');
        $year = $request->query('year');
        $sort = $request->query('sort', 'latest');

        $latestMagazine = Magazine::where('status', 'published')
                                ->orderBy('publication_date', 'desc')
                                ->first();

        $query = Magazine::where('status', 'published');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('issue_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($year) {
            $query->whereYear('publication_date', $year);
        }

        if ($sort === 'oldest') {
            $query->orderBy('publication_date', 'asc');
        } else {
            $query->orderBy('publication_date', 'desc');
        }

        $magazines = $query->paginate(12)->withQueryString();

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver", 'mysql');
        $yearExpression = $driver === 'sqlite'
            ? 'strftime("%Y", publication_date) as year'
            : 'YEAR(publication_date) as year';

        $years = Magazine::where('status', 'published')
                         ->whereNotNull('publication_date')
                         ->selectRaw($yearExpression)
                         ->distinct()
                         ->pluck('year')
                         ->filter()
                         ->values();

        return view('publications.magazines', compact('magazines', 'latestMagazine', 'years'));
    }

    /**
     * Read magazine online.
     */
    public function readMagazine(Magazine $magazine)
    {
        return view('publications.magazines.read', compact('magazine'));
    }

    /**
     * Display magazine details.
     */
    public function magazineDetails(Magazine $magazine)
    {
        if (!$magazine->exists || $magazine->status !== 'published') {
            abort(404);
        }

        $relatedMagazines = Magazine::where('id', '!=', $magazine->id)
                                   ->where('status', 'published')
                                   ->orderBy('publication_date', 'desc')
                                   ->limit(4)
                                   ->get();

        return view('publications.magazines.details', compact('magazine', 'relatedMagazines'));
    }

    /**
     * Display a paginated listing of published articles with search and category filters.
     */
    public function articles(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $sort = $request->query('sort', 'latest');

        $query = Article::where('status', 'published');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($sort === 'oldest') {
            $query->orderBy('publication_date', 'asc');
        } else {
            $query->orderBy('publication_date', 'desc');
        }

        $articles = $query->paginate(9)->withQueryString();

        $categories = Article::where('status', 'published')
                            ->whereNotNull('category')
                            ->distinct()
                            ->pluck('category')
                            ->filter()
                            ->values();

        return view('publications.articles.index', compact('articles', 'categories'));
    }

    /**
     * Read an article.
     */
    public function readArticle($id)
    {
        $article = Article::where('status', 'published')->findOrFail($id);

        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->orderBy('publication_date', 'desc')
            ->limit(3)
            ->get();

        return view('publications.articles.read', compact('article', 'relatedArticles'));
    }
}
