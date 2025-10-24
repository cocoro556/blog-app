@extends('layouts.custom.blog')

@section('title', 'お問い合わせ')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">お問い合わせ</h1>
            <p class="text-gray-600">ご質問やご要望がございましたら、お気軽にお問い合わせください</p>
        </div>

        <!-- エラーメッセージ -->
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- フォーム -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('contact.store') }}" method="post" class="space-y-6">
                @csrf

                <!-- 名前 -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        お名前 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="山田太郎" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- メールアドレス -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        メールアドレス <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="example@email.com" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- メッセージ -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        メッセージ <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" id="message" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror"
                        placeholder="お問い合わせ内容をご記入ください" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 送信ボタン -->
                <div class="flex items-center justify-between pt-4">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        送信する
                    </button>

                    <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                        ← ホームページに戻る
                    </a>
                </div>
            </form>
        </div>

        <!-- 注意事項 -->
        <div class="mt-6 p-4 bg-blue-50 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>ご注意：</strong> お問い合わせいただいた内容は、内容を確認の上、2営業日以内にご返信いたします。
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
