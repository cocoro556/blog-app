@extends('layouts.custom.admin') @section('title', '新規投稿')
@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- ページタイトル -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">新規投稿</h1>
            <p class="text-gray-600 mt-2">新しい投稿を作成します</p>
        </div>

        <!-- フォーム -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('posts.store') }}" method="post" class="space-y-6">
                @csrf

                <!-- タイトル入力 -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        タイトル <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="投稿のタイトルを入力してください" required />
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- 内容入力 -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        内容 <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content" rows="12"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="投稿の内容を入力してください" required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ボタン -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('posts.list') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        キャンセル
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        投稿する
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
