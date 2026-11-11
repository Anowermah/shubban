<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class NewsCommentController extends Controller
{
    public function index()
    {
        $comments = NewsComment::with('news')->latest()->paginate(20);
        return view('admin.news.comments.index', compact('comments'));
    }

    public function approve(NewsComment $comment)
    {
        $comment->update(['status' => 'approved']);
        return back()->with('success', 'Comment approved successfully');
    }

    public function destroy(NewsComment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');
    }
}
