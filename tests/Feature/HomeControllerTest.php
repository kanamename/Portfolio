<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this
            ->actingAs(User::find(1))
            ->get(route('mypage'));

        $response->assertStatus(200)
            ->assertViewIs('users.mypage')
            ->assertSee('お気に入り');
    }
}
