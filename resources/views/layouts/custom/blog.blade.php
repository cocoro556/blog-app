<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ブログアプリ')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- ヘッダー -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">
                    <a href="{{ route('posts.index') }}">ブログアプリ</a>
                </h1>
                <nav class="space-x-4">
                    <a href="{{ route('contact.create') }}" class="text-gray-600 hover:text-gray-900">お問い合わせ</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 w-full">
        <div class="px-4 py-6 sm:px-0">
            @yield('content')
        </div>
    </main>

    <!-- フッター -->
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; 2024 ブログアプリ. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
