<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;

class PostIndexTest extends PostTestBase
{
    /**
     * 投稿一覧ページにアクセスできるかのテスト
     */
    public function test_can_access_posts_index_page(): void
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    /**
     * ページに「ブログ一覧」タイトルが表示されるかのテスト
     */
    public function test_page_displays_blog_list_title(): void
    {
        $response = $this->get('/posts');

        $response->assertSee('ブログ一覧');
    }

    /**
     * 投稿のタイトルと内容が表示されるかのテスト
     */
    public function test_page_displays_post_title_and_content(): void
    {
        $response = $this->get('/posts');

        // 投稿のタイトルが表示されているか確認
        $response->assertSee('テスト投稿のタイトル');

        // 投稿の内容が表示されているか確認
        $response->assertSee('これはテスト用の本文です。');
    }

    /**
     * 投稿の日付が表示されるかのテスト
     */
    public function test_page_displays_post_dates(): void
    {
        $response = $this->get('/posts');

        // 投稿日が表示されているか確認
        $response->assertSee('投稿日:');

        // 更新日が表示されているか確認
        $response->assertSee('更新日:');
    }

    /**
     * お問い合わせリンクが表示されるかのテスト
     */
    public function test_page_displays_contact_link(): void
    {
        $response = $this->get('/posts');

        // お問い合わせリンクが表示されているか確認
        $response->assertSee('お問い合わせ');

        // リンクが存在するか確認（エスケープされた状態で）
        $response->assertSee('href="' . route('contact.create') . '"', false);
    }

    /**
     * 複数の投稿が表示されるかのテスト
     */
    public function test_page_displays_multiple_posts(): void
    {
        // 追加の投稿を作成
        Post::create([
            'title' => '2つ目の投稿',
            'content' => 'これは2つ目の投稿の内容です。',
            'image_path' => null,
            'user_id' => $this->user->id,
        ]);

        Post::create([
            'title' => '3つ目の投稿',
            'content' => 'これは3つ目の投稿の内容です。',
            'image_path' => null,
            'user_id' => $this->user->id,
        ]);

        $response = $this->get('/posts');

        // 1つ目の投稿が表示されているか確認
        $response->assertSee('テスト投稿のタイトル');
        $response->assertSee('これはテスト用の本文です。');

        // 2つ目の投稿が表示されているか確認
        $response->assertSee('2つ目の投稿');
        $response->assertSee('これは2つ目の投稿の内容です。');

        // 3つ目の投稿が表示されているか確認
        $response->assertSee('3つ目の投稿');
        $response->assertSee('これは3つ目の投稿の内容です。');
    }

    /**
     * 投稿詳細ページにアクセスできるかのテスト
     */
    public function test_can_access_post_show_page(): void
    {
        $response = $this->get(route('posts.show', $this->post->id));
        $response->assertStatus(200);
    }

    /**
     * 新しい投稿を作成できるかのテスト
     */
    public function test_can_create_new_post(): void
    {
        $postData = [
            'title' => '新しい投稿',
            'content' => '新しい投稿の内容',
            'image_path' => null,
        ];

        $response = $this->post(route('posts.store'), $postData);
        $response->assertRedirect(route('posts.index'));
    }

}
