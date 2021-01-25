<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Shop;
use App\ReviewShop;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // shopsテーブルからレコード取得
        $shops = Shop::all();
        
        // レビューデータを取得してコレクションへ追加
        $shops = tap($shops, function ($data_list) {
            foreach ($data_list as $data) {
                $shop_reviews = ReviewShop::where('shop_id', $data->id)->get();
                $data->shop_review_avg = round($shop_reviews->avg('stars'), 1, PHP_ROUND_HALF_UP);
                $data->shop_review_stars = round($shop_reviews->avg('stars'), 1, PHP_ROUND_HALF_UP) * 20;
                $data->shop_review_count = $shop_reviews->count();
            }
        });

        // ページネーション
        $shops = new LengthAwarePaginator(
            $shops->forPage($request->page, 6),
            $shops->count(),
            6,
            null,
            ['path' => $request->url()]
        );

        return view('index', [
            'shops' => $shops,
        ]);
    }
}
