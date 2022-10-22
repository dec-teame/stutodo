<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //追加
    public function setUp(): void
    {
        parent::setUp();
        $this->providerName = 'google';
    }

    /**
     * @test
     */
    public function Googleの認証画面を表示できる()
    {
        // URLをコール
        $this->get(route('socialOAuth', ['provider' => $this->providerName]))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function Googleアカウントでユーザー登録できる()
    {
        // URLをコール
        $this->get(route('oauthCallback', ['provider' => $this->providerName]))
            ->assertStatus(200);
    }
}
