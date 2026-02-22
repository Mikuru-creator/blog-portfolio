<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PublicCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        Comment::create([
            'post_id' => $post->id,
            'name'    => $validated['name'],
            'comment'    => $validated['comment'],
        ]);

        return redirect()
            ->route('public.post.show', $post)
            ->with('message', 'コメントを投稿しました')
            ->withFragment('comment');
    }
}
