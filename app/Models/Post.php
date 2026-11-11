<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content']; // এখানে আপনার প্রয়োজনীয় ফিল্ডগুলো যোগ করুন
}
