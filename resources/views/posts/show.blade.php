@extends('layouts.custom.blog') @section('title', 'ブログ詳細')
@section('content')
    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-900 mb-3">
                {{ $post->title }}
            </h2>
            <p class="text-gray-700 leading-relaxed line-clamp-3">
                {{ $post->content }}
            </p>
        </div>

        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
            <div class="flex space-x-4">
                <span>📅 {{ $post->created_at->format('Y年m月d日') }}</span>
                @if ($post->updated_at != $post->created_at)
                    <span>🔄 {{ $post->updated_at->format('Y年m月d日') }}更新</span>
                @endif
            </div>
        </div>

        {{-- 画像 --}}
        <div class="mb-4 w-1/2 h-1/2 rounded-lg mx-auto">
            <img src="https://placehold.jp/150x150.png" alt="{{ $post->title }}" class="w-full h-auto rounded-lg">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('posts.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition-colors">
                一覧に戻る
            </a>
        </div>
    </div>
@endsection
