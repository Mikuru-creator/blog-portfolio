<x-layouts::public>
    <div class="space-y-10">
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:min-w-[768px] md:max-w-[900px] mx-auto">
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-yellow-200/70 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 h-56 w-56 rounded-full bg-sky-200/70 blur-2xl"></div>
            <div class="relative p-6 md:p-8">
                <div class="mb-6">
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800">画像</h2>
                    <p class="mt-1 text-sm text-slate-600">タップで投稿ページへ移動します。</p>
                </div>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
                    @forelse($images as $img)
                        <a href="{{ route('public.post.show', $img->post) }}"
                           class="group relative block overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-300">
                            <div class="aspect-square">
                                <img
                                    src="{{ asset('storage/' . $img->img_path) }}"
                                    alt=""
                                    class="h-full w-full object-cover transition duration-200 group-hover:scale-[1.03]"
                                >
                            </div>
                            <div class="pointer-events-none absolute inset-0 opacity-0 transition duration-200 group-hover:opacity-100">
                                <div class="absolute inset-0 bg-black/35"></div>

                                <div class="absolute inset-x-0 bottom-0 p-3">
                                    <div class="rounded-xl bg-white/85 px-3 py-2 text-xs font-bold text-slate-800 backdrop-blur">
                                        投稿へ →
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-2 md:col-span-3 py-12 text-center text-sm font-bold text-slate-400">
                            画像がありません
                        </div>
                    @endforelse
                </div>
                @if(method_exists($images, 'links'))
                    <div class="mt-6">
                        {{ $images->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-layouts::public>