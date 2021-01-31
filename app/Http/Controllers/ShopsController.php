<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
// AWS S3
use Storage;

use App\User;
use App\Shop;
use App\Brand;
use App\BrandShop;
use App\ReviewShop;

use App\Library\BaseClass;

class ShopsController extends Controller
{
    public function search(Request $request) {
        // 値を取得
        $request_price_range = $request->price_range;
        $request_area = $request->area;
        $request_keyword = $request->keyword;

        $query = Shop::query();

        // price_rangeの値が"価格帯"ではない
        if(!empty($request_price_range)) {
            $query->where('price_range', $request_price_range);
        }

        // areaの値が"場所"ではない
        if(!empty($request_area)) {
            $query->where('area', $request_area);
        }

        // keywordが存在するか
        if(!empty($request_keyword)) {
            $query->where('shop_name', 'like', '%' . $request_keyword . '%');
        }

        $count = $query->count();
        $shops = $query->get();

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

        return view('shops.search', compact('shops', 'count', 'request_price_range', 'request_area', 'request_keyword'));
    }

    public function show(string $id)
    {
        // デフォルトのプロフィール画像パス
        $default_image_path = Storage::disk('s3')->url('image/profile/no_image.png');
        
        // ユーザー情報取得
        $user = Auth::user();
        
        // shopsテーブルからショップIDと一致するレコードを取得
        $shop_data = Shop::findOrFail($id);

        // 総合レビューデータ取得
        $comprehensive_review_data_list = BaseClass::getReviewData($id);

        // レビューデータ取得
        $review_data_list = ReviewShop::where('shop_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        // brandsテーブルからショップIDと一致するレコードを取得
        $brands = Shop::find($id)->brands;
        // ブランド名をカンマ区切りにする
        $brands = $brands->implode('brand_name', ', ');

        // レビュー投稿しているかチェック
        $review_flg = "";

        if (isset($user)) {
            $review_flg = ReviewShop::where('user_id', $user->id)->where('shop_id', $id)->first();
        }

        return view('shops.show',[
             'shop_data' => $shop_data,
             'brands' => $brands,
             'review_data_list' => $review_data_list,
             'comprehensive_review_data_list' => $comprehensive_review_data_list,
             'review_flg' => $review_flg,
             'default_image_path' => $default_image_path,
        ]);
    }
}
