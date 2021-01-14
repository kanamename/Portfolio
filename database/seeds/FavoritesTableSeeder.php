<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Shop;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        DB::table('favorites')->truncate();

        // shopsテーブルからidを取得
        $users = User::get();

        // brandsテーブルの複数IDとshopテーブルを紐づけ
        foreach ($users as $user) {
            // brandsテーブルからidをランダム(5～10件)で取得
            $shop_ids = Shop::inRandomOrder()->take(rand(0, 10))->get('id');
            // shopsテーブルへ紐づけ
            $user->shops()->sync($shop_ids);
        }
    }
}
