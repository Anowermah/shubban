<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Magazine;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function books()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.publications.books', compact('books'));
    }

    public function createBook()
    {
        return view('admin.publications.books.create');
    }

    public function showBook(Book $book)
    {
        return view('admin.publications.books.show', compact('book'));
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'required|date',
            'isbn' => 'nullable|string|max:13',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->except(['cover_image', 'pdf_file']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        Book::create($data);

        return back()->with('success', 'Book added successfully');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.publications.books.edit', compact('book'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'required|date',
            'isbn' => 'nullable|string|max:13',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->except(['cover_image', 'pdf_file']);

        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            // Delete old PDF if exists
            if ($book->pdf_file) {
                Storage::disk('public')->delete($book->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.publications.books.index')
            ->with('success', 'বই সফলভাবে আপডেট করা হয়েছে');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        
        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        
        // Delete PDF if exists
        if ($book->pdf_file) {
            Storage::disk('public')->delete($book->pdf_file);
        }
        
        $book->delete();
        
        return back()->with('success', 'বই সফলভাবে মুছে ফেলা হয়েছে');
    }

    public function magazines()
    {
        $magazines = Magazine::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.publications.magazines', compact('magazines'));
    }

    public function createMagazine()
    {
        return view('admin.publications.magazines.create');
    }

    public function showMagazine(Magazine $magazine)
    {
        return view('admin.publications.magazines.show', compact('magazine'));
    }

    public function editMagazine(Magazine $magazine)
    {
        return view('admin.publications.magazines.edit', compact('magazine'));
    }

    public function storeMagazine(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issue_number' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->except(['cover_image', 'pdf_file']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('magazines/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('magazines/pdfs', 'public');
        }

        Magazine::create($data);

        return back()->with('success', 'Magazine added successfully');
    }

    public function updateMagazine(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issue_number' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->except(['cover_image', 'pdf_file']);

        if ($request->hasFile('cover_image')) {
            if ($magazine->cover_image) {
                Storage::disk('public')->delete($magazine->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('magazines/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($magazine->pdf_file) {
                Storage::disk('public')->delete($magazine->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('magazines/pdfs', 'public');
        }

        $magazine->update($data);

        return redirect()->route('admin.publications.magazines.index')
            ->with('success', 'ম্যাগাজিন সফলভাবে আপডেট করা হয়েছে');
    }

    public function destroyMagazine(Magazine $magazine)
    {
        if ($magazine->cover_image) {
            Storage::disk('public')->delete($magazine->cover_image);
        }
        
        if ($magazine->pdf_file) {
            Storage::disk('public')->delete($magazine->pdf_file);
        }
        
        $magazine->delete();
        
        return back()->with('success', 'ম্যাগাজিন সফলভাবে মুছে ফেলা হয়েছে');
    }

    public function articles()
    {
        $query = Article::query();

        // Apply search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Apply sorting
        switch(request('sort')) {
            case 'oldest':
                $query->oldest('publication_date');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->latest('publication_date');
        }

        $articles = $query->paginate(15);
        $articles->appends(request()->query());

        return view('admin.publications.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        return view('admin.publications.articles.create');
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:100',
            'publication_date' => 'required|date',
            'status' => 'required|in:draft,published',
            'cover_image' => 'nullable|image|max:2048', // 2MB
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // 10MB
        ]);

        $article = new Article($validated);

        if ($request->hasFile('cover_image')) {
            $article->cover_image = $request->file('cover_image')->store('articles/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $article->pdf_file = $request->file('pdf_file')->store('articles/pdfs', 'public');
        }

        $article->save();

        return redirect()
            ->route('admin.publications.articles.index')
            ->with('success', 'নিবন্ধটি সফলভাবে যোগ করা হয়েছে।');
    }

    public function editArticle(Article $article)
    {
        return view('admin.publications.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:100',
            'publication_date' => 'required|date',
            'status' => 'required|in:draft,published',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'remove_cover' => 'nullable|boolean',
            'remove_pdf' => 'nullable|boolean',
        ]);

        // Handle cover image
        if ($request->boolean('remove_cover')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $article->cover_image = null;
        } elseif ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $article->cover_image = $request->file('cover_image')->store('articles/covers', 'public');
        }

        // Handle PDF file
        if ($request->boolean('remove_pdf')) {
            if ($article->pdf_file) {
                Storage::disk('public')->delete($article->pdf_file);
            }
            $article->pdf_file = null;
        } elseif ($request->hasFile('pdf_file')) {
            if ($article->pdf_file) {
                Storage::disk('public')->delete($article->pdf_file);
            }
            $article->pdf_file = $request->file('pdf_file')->store('articles/pdfs', 'public');
        }

        $article->update($validated);

        return redirect()
            ->route('admin.publications.articles.index')
            ->with('success', 'নিবন্ধটি সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroyArticle(Article $article)
    {
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }
        if ($article->pdf_file) {
            Storage::disk('public')->delete($article->pdf_file);
        }

        $article->delete();

        return redirect()
            ->route('admin.publications.articles.index')
            ->with('success', 'নিবন্ধটি সফলভাবে মুছে ফেলা হয়েছে।');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('articles/content-images', $fileName, 'public');
            
            return response()->json([
                'location' => Storage::url($path)
            ]);
        }
        
        return response()->json([
            'error' => 'No file was uploaded.'
        ], 400);
    }
}
