@extends('layouts.custom.admin')

@section('title', '投稿詳細')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- ページタイトル -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">投稿詳細</h1>
            <p class="text-gray-600 mt-2">投稿の詳細を表示しています</p>
        </div>

        <!-- 投稿内容 -->
        <div class="bg-white shadow-sm rounded-lg p-8">
            <!-- タイトル -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ $post->title }}
                </h2>
            </div>

            <!-- 日付情報 -->
            <div class="mb-6 pb-4 border-b border-gray-200">
                <div class="flex items-center space-x-6 text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        投稿日: {{ $post->created_at->format('Y年m月d日 H:i') }}
                    </span>
                    @if ($post->updated_at != $post->created_at)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            更新日: {{ $post->updated_at->format('Y年m月d日 H:i') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- 画像 -->
            <div class="mb-8 text-center">
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                        class="w-full max-w-2xl mx-auto rounded-lg shadow-md">
                @else
                    <div class="w-full max-w-2xl mx-auto bg-gray-100 rounded-lg shadow-md flex items-center justify-center h-64">
                        <div class="text-gray-400 text-center">
                            <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg">画像がありません</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 内容 -->
            <div class="mb-8">
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                        {{ $post->content }}
                    </p>
                </div>
            </div>

            <!-- アクションボタン -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    ブログ一覧に戻る
                </a>

                <div class="flex space-x-3">
                    <a href="{{ route('posts.edit', $post->id) }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        編集
                    </a>

                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                            onclick="return confirm('本当に削除しますか？')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            削除
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
