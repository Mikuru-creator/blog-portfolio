<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index',compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'body' => 'required|string|max:300',
            'images' => 'nullable|array|max:3',
            'images.*' => 'file|image|max:5120',
        ]);

        DB::transaction(function () use ($request, $validated) {
            $post = Post::create([
                    'title' => $validated['title'],
                    'body'  => $validated['body'],
            ]);

            $files = $request->file('images', []);
            foreach ($files as $i => $file) {
                $path = $file->store('posts', 'public');

                PostImage::create([
                    'post_id' => $post->id,
                    'img_path' => $path,
                    'sort' => $i + 1,
                ]);
            }
        });

        return back()->with('message','保存しました');
    }

    public function edit(Post $post)
    {
        $post->load(['images', 'comments' => function ($q) {
            $q->latest();
        }]);

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
            'images' => ['nullable','array','max:3'],
            'images.*' => ['file','image','max:5120'],
            'delete_image_ids' => ['nullable','array'],
            'delete_image_ids.*' => ['integer'],
        ]);
        
        $deleteIds = $request->input('delete_image_ids', []);
        $deleteCount = empty($deleteIds)
            ? 0
            : $post->images()->whereIn('id', $deleteIds)->count();

        $currentCount = $post->images()->count();
        $remainCount = $currentCount - $deleteCount;

        $newCount = count($request->file('images', []));

        if ($remainCount + $newCount > 3) {
            return back()
                ->withErrors(['images' => '画像は合計3枚までです（削除してから追加してください）。'])
                ->withInput();
        }
        
        DB::transaction(function () use ($post, $request, $validated) {
            $post->update([
                'title' => $validated['title'],
                'body'  => $validated['body'],
            ]);

            $deleteIds = $request->input('delete_image_ids', []);
            if (!empty($deleteIds)) {
                $images = $post->images()->whereIn('id', $deleteIds)->get();
                foreach ($images as $img) {
                    Storage::disk('public')->delete($img->img_path);
                    $img->delete();
                }
            }

            $files = $request->file('images', []);
            $nextSort = (int) ($post->images()->max('sort') ?? 0);

            foreach ($files as $file) {
                $path = $file->store('posts', 'public');

                PostImage::create([
                    'post_id'  => $post->id,
                    'img_path' => $path,
                    'sort'     => ++$nextSort,
                ]);
            }
         });
        
        return redirect()->route('post.index')->with('message', '更新しました');
    }

    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            foreach ($post->images as $img) {
                Storage::disk('public')->delete($img->img_path);
                $img->delete();
            }
            $post->delete();
        });

        return redirect()->route('post.index')->with('message', '削除しました');
    }
}
