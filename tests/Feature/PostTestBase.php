<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class PostTestBase extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $post;

    public function setUp(): void
    {
        parent::setUp();

        // テスト用のユーザーを作成
        $this->user = User::create([
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // テスト用の投稿を作成
        $this->post = Post::create([
            'title' => 'テスト投稿のタイトル',
            'content' => 'これはテスト用の本文です。',
            'image_path' => null,
            'user_id' => $this->user->id,
        ]);
    }
}
