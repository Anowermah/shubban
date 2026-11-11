<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // সব পোস্ট দেখাবে
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // নতুন পোস্ট তৈরি ফর্ম
    public function create()
    {
        return view('posts.create');
    }

    // নতুন পোস্ট সেভ করবে
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // একটি পোস্ট দেখাবে
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
