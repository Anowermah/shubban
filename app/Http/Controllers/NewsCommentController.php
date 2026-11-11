<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class NewsCommentController extends Controller
{
    public function store(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string'
        ]);
        
        $validatedData['news_id'] = $news->id;
        
        NewsComment::create($validatedData);
        
        return back()->with('success', 'মন্তব্যটি সফলভাবে জমা হয়েছে। অনুমোদনের পর প্রকাশিত হবে।');
    }

    // Admin methods
    public function index()
    {
        $comments = NewsComment::with('news')
                             ->orderBy('created_at', 'desc')
                             ->paginate(20);
                             
        return view('admin.comments.index', compact('comments'));
    }
    
    public function approve(NewsComment $comment)
    {
        $comment->update(['status' => true]);
        return back()->with('success', 'মন্তব্যটি অনুমোদন করা হয়েছে।');
    }
    
    public function destroy(NewsComment $comment)
    {
        $comment->delete();
        return back()->with('success', 'মন্তব্যটি মুছে ফেলা হয়েছে।');
    }
}
