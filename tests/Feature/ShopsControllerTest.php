<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Shop;

class ShopsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // ショップ詳細ページへ遷移できるか
        $response = $this
            ->get(route('search.1'));

        $response->assertStatus(200)
            ->assertViewIs('shops.show')
            ->assertSee('価格帯');
    }
}