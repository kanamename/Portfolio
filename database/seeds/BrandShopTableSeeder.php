<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Shop;
use App\Brand;

class BrandShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    public static function run()
    {
        // データのクリア
        DB::table('brand_shop')->truncate();

        // shopsテーブルからidを取得
        $shops = Shop::get();

        // brandsテーブルの複数IDとshopテーブルを紐づけ
        foreach ($shops as $shop) {
            // brandsテーブルからidをランダム(5～10件)で取得
            $brand_ids = Brand::inRandomOrder()->take(rand(5, 10))->get('id');
            // shopsテーブルへ紐づけ
            $shop->brands()->sync($brand_ids);
        }
    }
}
