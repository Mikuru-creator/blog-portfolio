<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PublicTopController extends Controller
{
    public function top()
    {
        $posts = Post::with('images')->latest()->take(3)->get();

        return view('public.top', compact('posts'));
    }
}
