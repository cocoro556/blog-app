<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;

// ブログ一覧
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// 新規投稿管理者画面、新規投稿保存処理をグループ化
Route::middleware('auth')->group(function () {
    // 管理画面のダッシュボード
    Route::get('/admin/dashboard', [PostController::class, 'dashboard'])->name('admin.dashboard');
    // 新規投稿管理者画面（{id}より先に書く！）
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    // 新規投稿保存処理
    Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    // 投稿編集管理者画面
    Route::get('/admin/posts/{post:id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // 投稿編集保存処理
    Route::put('/admin/posts/{post:id}', [PostController::class, 'update'])->name('posts.update');
    // 投稿一覧管理者画面
    Route::get('/admin/posts/list', [PostController::class, 'list'])->name('posts.list');
    // 投稿詳細管理者画面
    Route::get('/admin/posts/{post:id}', [PostController::class, 'showAdmin'])->name('posts.showAdmin');
    // 投稿削除処理
    Route::delete('/admin/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// ブログ詳細
Route::get('/posts/{post:id}', [PostController::class, 'show'])->name('posts.show');

// お問い合わせ
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
// お問い合わせ保存処理
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// お問い合わせ完了
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');











// 新規登録禁止
Route::get('/register', function () {
    abort(403);
});
Route::post('/register', function () {
    abort(403);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
