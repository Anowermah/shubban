<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLike extends Model
{
    protected $fillable = ['news_id', 'ip_address'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
