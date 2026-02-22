<x-layouts::public>
    <div class="space-y-10">
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:min-w-[768px] md:max-w-[900px] mx-auto">
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-yellow-200/70 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 h-56 w-56 rounded-full bg-sky-200/70 blur-2xl"></div>
            <div class="relative p-6 md:p-8 space-y-6">
                <div class="space-y-2">
                    <p class="text-sm text-slate-500">{{ $post->created_at->format('Y/m/d') }}</p>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">
                        {{ $post->title }}
                    </h1>
                </div>
                @if($post->images->count() > 0)
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($post->images as $img)
                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-sm">
                                <img src="{{ asset('storage/' . $img->img_path) }}" alt="{{ $post->title }}" class="h-60 w-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="rounded-2xl bg-white/50 p-5 leading-relaxed text-slate-700 whitespace-pre-wrap">{{ $post->body }}</div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('public.post.index') }}"
                       class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                        ← 一覧に戻る
                    </a>
                </div>
            </div>
        </section>
        <section id="comment" class="rounded-3xl border border-slate-200 bg-white shadow-sm md:min-w-[768px] md:max-w-[900px] mx-auto">
            <div class="p-6 md:p-8 space-y-6">
                <h2 class="text-xl font-extrabold text-slate-800">コメント</h2>
                @if(session('message'))
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 text-sm font-semibold">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('public.post.comment', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-bold text-slate-700">名前</label>
                            <input type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="mt-1 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-300 focus:outline-none"
                                placeholder="匿名希望の場合は「匿名」と記入"
                            >
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">コメント</label>
                            <textarea
                                name="comment"
                                rows="4"
                                class="mt-1 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-300 focus:outline-none"
                                placeholder="素敵な感想をお待ちしております♩"
                            >{{ old('comment') }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-sky-500 px-6 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-sky-600">
                        送信
                    </button>
                </form>
                <div class="divide-y divide-slate-200">
                    @forelse($comments as $comment)
                        <div class="p-4">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <p class="font-extrabold text-slate-800">
                                    {{ $comment->name ?? $comment->author_name }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ optional($comment->created_at)->format('Y/m/d H:i') }}
                                </p>
                            </div>
                            <p class="mt-2 text-sm text-slate-700 whitespace-pre-wrap">{{ $comment->comment ?? $comment->content ?? '' }}</p>
                        </div>
                    @empty
                        <div class="py-8 text-center text-sm font-bold text-slate-400">
                            まだコメントがありません
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</x-layouts::public>
