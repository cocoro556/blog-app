<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;

class PostShowTest extends PostTestBase
{

    /**
     * 投稿詳細ページの内容が問題なく表示されるかのテスト   
     */
    public function test_post_show_page_displays_correct_content(): void
    {
        $response = $this->get(route('posts.show', $this->post->id));
        $response->assertStatus(200);

        $response->assertSee($this->post->title);
        $response->assertSee($this->post->content);
        $response->assertSee($this->post->created_at->format('Y-m-d H:i:s'));
        $response->assertSee($this->post->updated_at->format('Y-m-d H:i:s'));
        $response->assertSee(route('posts.index'));
    }
}
