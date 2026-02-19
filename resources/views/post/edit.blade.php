<x-layouts::app>
    <div class="max-w-3xl mx-auto px-6 py-6">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                投稿編集
            </h2>
        </div>

        @if ($errors->any())
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <div class="text-green-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-6 rounded-2xl">
            <form method="POST" action="{{ route('post.update', $post) }}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700">タイトル</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 outline-none focus:ring-2" required>
                </div>

                <div class="mt-5">
                    <label class="block text-sm font-semibold text-gray-700">本文</label>
                    <textarea
                        name="body"
                        rows="8"
                        class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2 outline-none focus:ring-2"
                        required
                    >{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="mt-6">
                    <div class="text-sm font-semibold text-gray-700">現在の画像（削除したいものにチェック）</div>
                        @if($post->images->isEmpty())
                            <p class="mt-2 text-sm text-gray-500">画像はありません。</p>
                        @else
                            <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                @foreach($post->images->sortBy('sort') as $img)
                                    <label class="block rounded-xl border border-gray-200 p-2">
                                        <div class="aspect-square overflow-hidden rounded-lg bg-gray-50">
                                            <img src="{{ asset('storage/' . $img->img_path) }}"
                                                alt=""
                                                class="h-full w-full object-cover">
                                        </div>

                                        <div class="mt-2 flex items-center gap-2 text-sm">
                                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}">
                                            <span class="text-gray-700">この画像を削除</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700">画像を追加</label>
                        <input type="file"
                            name="images[]"
                            multiple
                            accept="image/*"
                            class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-2">
                        <p class="mt-1 text-xs text-gray-500">複数選択できます。</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('post.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 hover:brightness-95">
                            キャンセル
                        </a>
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 hover:brightness-95">
                            更新
                        </button>
                    </div>
            </form>
            <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
                <h3 class="text-sm font-semibold text-gray-700">コメント管理</h3>

                @if($post->comments->isEmpty())
                    <p class="mt-2 text-sm text-gray-500">コメントはありません。</p>
                @else
                    <div class="mt-3 space-y-3">
                        @foreach($post->comments->sortByDesc('created_at') as $comment)
                            <div class="rounded-xl border border-gray-200 p-3">
                                <div class="text-sm text-gray-800 whitespace-pre-wrap">{{ $comment->body }}</div>

                                <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ optional($comment->created_at)->format('Y-m-d H:i') }}</span>
                
                                    <form method="POST" action="{{ route('comment.destroy', [$post, $comment]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('このコメントを削除しますか？')"
                                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 hover:brightness-95">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts::app>