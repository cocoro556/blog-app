@extends('layouts.custom.admin')

@section('content')
    <div class="bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">管理者ダッシュボード</h1>
        <p class="mb-6 text-gray-700">管理画面へようこそ！</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <a href="{{ route('posts.list') }}" class="block bg-blue-500 text-white text-center py-4 px-6 rounded hover:bg-blue-600 transition">投稿一覧</a>
            <a href="{{ route('posts.create') }}" class="block bg-green-500 text-white text-center py-4 px-6 rounded hover:bg-green-600 transition">新規投稿作成</a>
        </div>
    </div>
@endsection