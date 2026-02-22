<x-layouts::public>
    <div class="space-y-10">
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:min-w-[768px] md:max-w-[900px] mx-auto">
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-yellow-200/70 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 h-56 w-56 rounded-full bg-sky-200/70 blur-2xl"></div>
            <div class="relative p-6 md:p-8">
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-xl md:text-2xl font-extrabold text-slate-800">投稿一覧</h2>
                    </div>
                </div>
                <div class="space-y-3">
                    @forelse($posts as $post)
                        <a href="{{ route('public.post.show', $post) }}"
                           class="group block rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                            <div class="flex items-center gap-4">
                                @php
                                    $thumb = optional($post->images->first())->img_path;
                                @endphp
                                <div class="h-20 w-32 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                    @if($thumb)
                                        <img src="{{ asset('storage/' . $thumb) }}"
                                             alt="{{ $post->title }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-xs font-bold text-slate-400">
                                            NO IMAGE
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                        <p class="truncate font-extrabold text-slate-800 group-hover:text-slate-900">
                                            {{ $post->title }}
                                        </p>
                                        <span class="text-xs text-slate-500">
                                            {{ $post->created_at->format('Y/m/d') }}
                                        </span>
                                    </div>
                                    @if(!empty($post->body))
                                        <p class="mt-1 line-clamp-2 text-sm text-slate-600 md:hidden">
                                            {{ \Illuminate\Support\Str::limit($post->body, 40) }}
                                        </p>
                                        <p class="mt-1 line-clamp-2 text-sm text-slate-600 hidden md:block">
                                            {{ \Illuminate\Support\Str::limit($post->body, 100) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="hidden md:block text-slate-400 group-hover:text-slate-600">
                                    →
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="py-12 text-center text-sm font-bold text-slate-400">
                            投稿がありません
                        </div>
                    @endforelse
                </div>
                @if(method_exists($posts, 'links'))
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-layouts::public>
