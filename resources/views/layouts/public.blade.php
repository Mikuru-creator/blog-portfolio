<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 flex flex-col">
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white backdrop-blur">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
                <a href="{{ route('public.top') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/title.png') }}" alt="れたすとまる。" class="h-auto w-40">
                </a>

                <nav class="flex items-center gap-2 text-sm font-semibold">
                    <a href="{{ route('public.top') }}"
                    class="rounded-full px-4 py-2 hover:bg-yellow-50">
                        TOP
                    </a>
                    <a href="{{ route('public.post.index') }}"
                    class="rounded-full px-4 py-2 hover:bg-yellow-50">
                        投稿一覧
                    </a>
                    <a href="{{ route('public.gallery') }}"
                    class="rounded-full px-4 py-2 hover:bg-yellow-50">
                        ギャラリー
                    </a>
                </nav>
            </div>
        </header>

        <main class="px-5 py-8 flex-1">
            {{ $slot }}
        </main>

        <footer class="mt-12 border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-5 py-8 text-sm text-slate-500">
                © {{ date('Y') }} Inko Blog
            </div>
        </footer>
    </body>
</html>

