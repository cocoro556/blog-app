@extends('layouts.custom.admin') @section('title', '投稿一覧')
@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- ページタイトル -->
        <div class="mb-6 flex justify-between items-center">
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-900">投稿一覧</h1>
                <p class="text-gray-600 mt-2">管理画面 - 投稿の管理</p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('posts.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 -ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    新規投稿
                </a>
            </div>
        </div>

        <!-- テーブル -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            タイトル
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            投稿日
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            更新日
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ Str::limit($post->title, 50) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->created_at->format('Y年m月d日 H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->updated_at->format('Y年m月d日 H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('posts.showAdmin', $post->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors">
                                        詳細
                                    </a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-green-600 hover:text-green-900 transition-colors">
                                        編集
                                    </a>
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                投稿がありません
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
