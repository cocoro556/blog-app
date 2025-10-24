@extends('layouts.custom.blog') @section('title', 'お問い合わせ完了')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <!-- 成功アイコン -->
            <div class="mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <!-- メッセージ -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                お問い合わせありがとうございます
            </h1>
            <p class="text-gray-600 mb-8">
                お問い合わせを受け付けました。<br />内容を確認の上、ご連絡いたします。
            </p>

            <!-- ボタン -->
            <div class="space-y-4">
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    ホームページに戻る
                </a>

                <div>
                    <a href="{{ route('contact.create') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                        ← お問い合わせページに戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
