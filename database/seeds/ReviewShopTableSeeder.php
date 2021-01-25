<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Shop;

use Carbon\Carbon;

class ReviewShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // コメントデータ
        $comment_list = array(
            1 => 'それなりのお店です',
            'まぁまぁのお店です',
            '普通のお店です',
            '良いお店です',
            'とても良いお店です',
        );

        // shopsテーブルからidを取得
        $shops = Shop::get();

        // usersテーブルの複数IDとshopsテーブルを紐づけ
        foreach ($shops as $shop) {
            // usersテーブルからidをランダム(0～10件)で取得
            $user_ids = User::inRandomOrder()->take(rand(1, 10))->pluck('id');

            foreach($user_ids as $user_id) {
                $stars = rand(1, 5);

                DB::table('review_shop')->insert([
                    'shop_id' => $shop->id,
                    'user_id' => $user_id,
                    'stars' => $stars,
                    'comment' => $comment_list[$stars],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
