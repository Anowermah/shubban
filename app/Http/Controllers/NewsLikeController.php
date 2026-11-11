<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsLike;
use Illuminate\Http\Request;

class NewsLikeController extends Controller
{
    public function toggle(Request $request, News $news)
    {
        $ipAddress = $request->ip();
        
        $like = NewsLike::where('news_id', $news->id)
                       ->where('ip_address', $ipAddress)
                       ->first();
        
        if ($like) {
            $like->delete();
            $action = 'unliked';
        } else {
            NewsLike::create([
                'news_id' => $news->id,
                'ip_address' => $ipAddress
            ]);
            $action = 'liked';
        }
        
        $likesCount = $news->likes()->count();
        
        return response()->json([
            'action' => $action,
            'likes_count' => $likesCount
        ]);
    }
}
