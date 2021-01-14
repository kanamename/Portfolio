<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Brand;
use App\BrandShop;

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
        $shops = $query->paginate(6);

        return view('shops.search', compact('shops', 'count', 'request_price_range', 'request_area', 'request_keyword'));
    }

    public function show(string $id)
    {
        // shopsテーブルからショップIDに紐づくレコードを取得
        $shop_data = Shop::findOrFail($id);

        // brandsテーブルからショップIDに紐づくレコードを取得
        $brands = Shop::find($id)->brands;
        // ブランド名をカンマ区切りにする
        $brands = $brands->implode('brand_name', ', ');

        return view('shops.show', ['shop_data' => $shop_data, 'brands' => $brands]);
    }
}
