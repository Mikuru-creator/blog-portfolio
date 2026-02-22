<div class="p-4 md:min-w-[768px] md:max-w-[900px] mx-auto">
    @if (count($posts) === 0)
        <div class="py-10 text-center text-sm font-bold text-slate-400">投稿がありません</div>
    @else
        <div wire:poll.6s="next" class="relative overflow-hidden">
            <button type="button" wire:click="prev" class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 px-3 py-2 text-lg font-extrabold shadow-sm hover:bg-white" aria-label="前へ">‹</button>
            <button type="button" wire:click="next" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 px-3 py-2 text-lg font-extrabold shadow-sm hover:bg-white" aria-label="次へ">›</button>
            @php
                $post = $posts[$active];
                $thumb = optional($post->images->first())->img_path;
            @endphp
            <a href="{{ route('public.post.show', $post) }}" class="block overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                <div class="aspect-[16/11] w-full bg-slate-100">
                    @if ($thumb)
                        <img src="{{ asset('storage/' . $thumb) }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-sm font-bold text-slate-400">
                            No Image
                        </div>
                    @endif
                </div>

                <div class="p-4">
                    <div class="line-clamp-1 text-base font-extrabold text-slate-900">
                        {{ $post->title }}
                    </div>
                    <div class="mt-1 text-xs font-semibold text-slate-500">
                        {{ $post->created_at?->format('Y/m/d') }}
                    </div>
                </div>
            </a>
        </div>  
    @endif
</div>
