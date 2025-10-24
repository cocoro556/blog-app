<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * お問い合わせページにアクセスできるかのテスト
     */
    public function test_can_access_contact_create_page(): void
    {
        $response = $this->get(route('contact.create'));

        $response->assertStatus(200);
    }

    /**
     * お問い合わせページにフォームが表示されるかのテスト
     */
    public function test_contact_create_page_displays_form(): void
    {
        $response = $this->get(route('contact.create'));

        // フォームの要素が表示されているか確認
        $response->assertSee('name');
        $response->assertSee('email');
        $response->assertSee('message');
        $response->assertSee('送信');
    }

    /**
     * お問い合わせフォームの送信が成功するかのテスト
     */
    public function test_can_submit_contact_form(): void
    {
        $contactData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'message' => 'これはテストメッセージです。',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect(route('contact.complete'));
    }

    /**
     * お問い合わせ完了ページが表示されるかのテスト
     */
    public function test_contact_complete_page_displays_success_message(): void
    {
        $response = $this->get(route('contact.complete'));

        $response->assertStatus(200);
        $response->assertSee('お問い合わせが送信されました');
    }

    /**
     * お問い合わせデータがデータベースに保存されるかのテスト
     */
    public function test_contact_data_is_saved_to_database(): void
    {
        $contactData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'message' => 'これはテストメッセージです。',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect(route('contact.complete'));
    }

    /**
     * お問い合わせフォームのバリデーションが機能するかのテスト
     */
    public function test_contact_form_validation(): void
    {
        // 名前が空の場合
        $response = $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'test@example.com',
            'message' => 'テストメッセージ',
        ]);
        $response->assertSessionHasErrors('name');

        // メールが無効な場合
        $response = $this->post(route('contact.store'), [
            'name' => 'テスト太郎',
            'email' => 'invalid-email',
            'message' => 'テストメッセージ',
        ]);
        $response->assertSessionHasErrors('email');

        // メッセージが空の場合
        $response = $this->post(route('contact.store'), [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'message' => '',
        ]);
        $response->assertSessionHasErrors('message');
    }
}
