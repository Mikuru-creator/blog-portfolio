<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(10);

        return view('public.post.index', compact('posts'));
    }
    
    public function show(Post $post)
    {
        $post->load('images');

        $comments = $post->comments()
            ->latest()
            ->get();

        return view('public.post.show', compact('post','comments'));
    }
}
