<x-layouts::app>
    <div class="max-w-5xl mx-auto px-6 py-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h2>

        @if(session('message'))
            <div class="text-green-600 font-bold">
                {{ session('message') }}
            </div>
        @endif

        @if ($posts->isEmpty())
            <p class="text-gray-600">まだ投稿がありません。</p>
            @else
            <div class="hidden sm:block">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[720px] border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-left text-sm text-gray-600">
                                <th class="px-3 py-2">サムネ</th>
                                <th class="px-3 py-2">タイトル</th>
                                <th class="px-3 py-2">本文</th>
                                <th class="px-3 py-2">作成日</th>
                                <th class="px-3 py-2">操作</th>
                            </tr>
                        </thead>                              
                            <tbody>
                                @foreach ($posts as $post)
                                    @php
                                        $thumb = optional($post->images->sortBy('sort')->first())->img_path;
                                    @endphp
                                    <tr  class="bg-white shadow-sm">
                                        <td class="px-3 py-3 align-top">
                                            <div class="h-12 w-12 overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                                                @if ($thumb)
                                                    <img src="{{ asset('storage/' . $thumb) }}" alt="" class="h-full w-full object-cover">
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center text-xs text-gray-400">なし</div>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-3 py-3 align-top font-semibold text-gray-900">
                                            {{ $post->title }}
                                        </td>

                                        <td class="px-3 py-3 align-top text-gray-700">
                                            {{ \Illuminate\Support\Str::limit($post->body, 80, '…') }}
                                        </td>

                                        <td class="px-3 py-3 align-top text-sm text-gray-700">
                                            {{ optional($post->created_at)->format('Y-m-d H:i') }}
                                        </td>

                                        <td class="px-3 py-3 align-top text-sm">
                                            <a href="{{ route('post.edit', $post) }}"
                                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 hover:brightness-95">
                                                編集
                                            </a>
                                            <form action="{{ route('post.destroy', $post) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('本当に削除しますか？')"
                                                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 hover:brightness-95">
                                                    削除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts::app>