<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostImage;
use App\Models\Comment;
use App\Models\User;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
