<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMypage()
    {
        // 認証エラーとなるか
        $response = $this->get(route('mypage'));
        $response->assertStatus(302);

        // マイページへ遷移できるか
        $response = $this
            ->actingAs(User::find(1))
            ->get(route('mypage'));

        $response->assertStatus(200)
            ->assertViewIs('users.mypage')
            ->assertSee('お気に入り');
    }
}
