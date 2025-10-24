@extends('layouts.custom.blog')

@section('title', 'ブログ一覧')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">ブログ一覧</h1>
            <p class="text-gray-600">最新の投稿をお楽しみください</p>
        </div>

        <!-- 投稿一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col h-full">
                    <!-- 画像エリア（固定サイズ） -->
                    <div class="mb-4 w-full h-64 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-gray-400 text-center">
                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm">画像なし</p>
                            </div>
                        @endif
                    </div>

                    <!-- コンテンツエリア（flex-1で残りスペースを占有） -->
                    <div class="flex-1 flex flex-col">
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                                <a href="{{ route('posts.show', $post->id) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-gray-700 leading-relaxed line-clamp-3 text-sm">
                                {{ Str::limit($post->content, 100) }}
                            </p>
                        </div>

                        <!-- 日付情報 -->
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <div class="flex space-x-3">
                                <span>📅 {{ $post->created_at->format('Y年m月d日') }}</span>
                                @if ($post->updated_at != $post->created_at)
                                    <span>🔄 {{ $post->updated_at->format('Y年m月d日') }}更新</span>
                                @endif
                            </div>
                        </div>

                        <!-- ボタンエリア（mt-autoで下に固定） -->
                        <div class="mt-auto">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors text-sm">
                                詳細を見る
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">まだ投稿がありません</h3>
                </div>
            @endforelse
        </div>

        <!-- アクションボタン -->
        <div class="mt-8 text-center">
            <a href="{{ route('contact.create') }}"
                class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                お問い合わせ
            </a>
        </div>
    </div>
@endsection
