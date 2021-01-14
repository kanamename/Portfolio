<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //全レコード削除
        DB::table('shops')->delete();
        
        //テストデータ
        DB::table('shops')->insert([
            'shop_name' => '吾亦紅 WARE-mo-KOU',
            'price_range' => '¥15000～¥20000',
            'area' => '渋谷',
            'address' => '東京都渋谷区神南1-18-2 神南坂フレーム1F',
            'postal_code' => '150-0041',
            'tel' => '03-6452-5530',
            'url' => 'https://waremo-kou.jp/shop.html',
            'credit_card' => '1',
            'image_url' => 'image\1_waremokou.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'JOHN',
            'price_range' => '¥20000～¥25000',
            'area' => '渋谷',
            'address' => '東京都渋谷区元代々木町18-8',
            'postal_code' => '151-0062',
            'tel' => '03-6407-0177',
            'url' => 'https://aiamjohn.com/pages/store',
            'credit_card' => '1',
            'image_url' => 'image\2_john.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => '1LDK',
            'price_range' => '¥30000～',
            'area' => '中目黒',
            'address' => '東京都目黒区上目黒１丁目８−２８ マンション鈴鹿',
            'postal_code' => '153-0051',
            'tel' => '03-3780-1645',
            'url' => 'http://1ldkshop.com/',
            'credit_card' => '1',
            'image_url' => 'image\3_1ldk.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'carol',
            'price_range' => '¥30000～',
            'area' => '渋谷',
            'address' => '東京都渋谷区神宮前５丁目２３−３ 長谷部ビル',
            'postal_code' => '150-0001',
            'tel' => '03-5778-9596',
            'url' => 'http://storecarol.com/',
            'credit_card' => '1',
            'image_url' => 'image\4_carol.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'GARDEN',
            'price_range' => '¥10000～¥15000',
            'area' => '渋谷',
            'address' => '東京都渋谷区神南1-17-4 神南ビル3F',
            'postal_code' => '150-0041',
            'tel' => '03-3770-5002',
            'url' => 'https://www.garden-jp.com/',
            'credit_card' => '1',
            'image_url' => 'image\no_image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'ROOTS to BRANCHES',
            'price_range' => '¥25000～¥30000',
            'area' => '中目黒',
            'address' => '東京都目黒区青葉台１丁目１６−７ 朝日橋ビル ２F',
            'postal_code' => '153-0042',
            'tel' => '03-5728-5690',
            'url' => 'http://roots-to-branches.jp/',
            'credit_card' => '1',
            'image_url' => 'image\6_roots_to_branches.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'Graphpaper',
            'price_range' => '¥25000～¥30000',
            'area' => '渋谷',
            'address' => '東京都渋谷区神宮前５丁目３６−６',
            'postal_code' => '150-0001',
            'tel' => '03-6418-9402',
            'url' => 'https://www.graphpaper-tokyo.com/',
            'credit_card' => '1',
            'image_url' => 'image\no_image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'Amanojak.',
            'price_range' => '¥30000～',
            'area' => 'その他',
            'address' => '東京都足立区千住龍田町８−４',
            'postal_code' => '120-0042',
            'tel' => '03-6806-1619',
            'url' => 'http://amanojak.jp/',
            'credit_card' => '1',
            'image_url' => 'image\no_image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'Lieu',
            'price_range' => '¥0～¥10000',
            'area' => 'その他',
            'address' => '東京都港区西麻布４丁目１６−８ 中澤西麻布ビル 2-3F',
            'postal_code' => '106-0031',
            'tel' => '03-6427-2460',
            'url' => 'https://lieu.shop-pro.jp/',
            'credit_card' => '1',
            'image_url' => 'image\9_lieu.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'STUDIOUS WOMENS ルミネ池袋店',
            'price_range' => '¥0～¥10000',
            'area' => 'その他',
            'address' => '東京都豊島区都, １１ 西池袋1-11-1 ルミネ池袋店2F',
            'postal_code' => '171-0021',
            'tel' => '03-6912-8899',
            'url' => '-',
            'credit_card' => '1',
            'image_url' => 'image\no_image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'エディション 表参道ヒルズ店',
            'price_range' => '¥15000～¥20000',
            'area' => '表参道',
            'address' => '東京都渋谷区神宮前4-12-10 表参道ヒルズ2F',
            'postal_code' => '150-0001',
            'tel' => '03-3403-8086',
            'url' => 'https://www.edition-jp.com/',
            'credit_card' => '1',
            'image_url' => 'image\11_edition.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'O 代官山 本店',
            'price_range' => '¥15000～¥20000',
            'area' => '代官山',
            'address' => '東京都渋谷区猿楽町２６−１３ グレイス代官山 202',
            'postal_code' => '150-0033',
            'tel' => '03-6416-1187',
            'url' => 'https://store.moc-o.com/',
            'credit_card' => '1',
            'image_url' => 'image\no_image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'shop_name' => 'SO NAKAMEGURO SHOP&HOSTEL',
            'price_range' => '¥25000～¥30000',
            'area' => '中目黒',
            'address' => '東京都目黒区青葉台１丁目６−５２',
            'postal_code' => '153-0042',
            'tel' => '03-6416-5549',
            'url' => 'http://so-shopandhostel.com/',
            'credit_card' => '1',
            'image_url' => 'image\13_so.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
