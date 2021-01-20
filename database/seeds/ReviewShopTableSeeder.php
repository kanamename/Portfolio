<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Shop;

class ReviewShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // shopsテーブルからidを取得
        $shops = Shop::get();

        // usersテーブルの複数IDとshopsテーブルを紐づけ
        foreach ($shops as $shop) {
            // usersテーブルからidをランダム(0～10件)で取得
            $user_ids = User::inRandomOrder()->take(rand(0, 10))->get('id');

            $shop->users()->sync([1, 2, 3]);




            // // shopsテーブルへ紐づけ
            // $shop->users()->sync($user_ids);
        }
    }
}
