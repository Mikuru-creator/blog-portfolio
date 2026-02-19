<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->post_id !== $post->id) {
            abort(404);
        }

        $comment->delete();

        return redirect()
            ->route('post.edit', $post)
            ->with('message', 'コメントを削除しました');
    }
}