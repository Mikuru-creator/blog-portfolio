<x-layouts::public>
    <div class="space-y-10">
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:min-w-[768px] md:max-w-[900px] mx-auto">
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-yellow-200/70 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 h-56 w-56 rounded-full bg-sky-200/70 blur-2xl"></div>
            <div class="relative grid gap-0 p-8 md:grid-cols-2 md:items-center">
                <div class="space-y-4 md:flex md:flex-col md:justify-center">
                    <h1 class="text-center md:text-left">
                        <img src="{{ asset('images/title.png') }}" alt="れたすとまる。" class="mx-auto max-w-72">
                    </h1>
                    <p class="text-slate-600 text-center md:text-left text-sm">
                        ボタンインコの日常ブログ。<br class="hidden md:block">
                        たくさんの「かわいい」をお届けします。
                    </p>
                </div>
                <div class="md:flex md:justify-end">
                    <div class="grid grid-cols-2 gap-10">
                            <div class="aspect-[4/5] w-full max-w-[280px]">
                                <img src="{{ asset('images/retasu2.png') }}" alt="れたす"
                                    class="h-full w-full object-contain p-2">
                            </div>
                            <div class="aspect-[4/5] w-full max-w-[280px]">
                                <img src="{{ asset('images/maru.png') }}" alt="まる"
                                    class="h-full w-full object-contain p-2">
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <p class="mt-4 leading-relaxed text-slate-700 text-center md:text-xl text-sm">
            ボタンインコの「れたす」と「まる」の日常ブログです。<br><br>
            可愛い二羽の写真と日記をお届けするので、ぜひコメント欄に感想を書いてください(^^♪
        </p>
        <livewire:public.recent-post-slider />
    </div>
</x-layouts::public>
