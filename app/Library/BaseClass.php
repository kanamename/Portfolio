<?php

namespace App\Library;
use App;
use App\ReviewShop;

class BaseClass
{
  //ショップレビューデータ取得
  public static function getReviewData($id) 
  {
    // shop_idと一致するレコードを取得
    $shop_reviews = ReviewShop::where('shop_id', $id)->get();

    // レビュー表示用データ取得
    $shop_review_avg = round($shop_reviews->avg('stars'), 1, PHP_ROUND_HALF_UP);
    $shop_review_stars = round($shop_reviews->avg('stars'), 1, PHP_ROUND_HALF_UP) * 20;
    $shop_review_count = $shop_reviews->count();
    
    return ['avg' => $shop_review_avg,
    'stars' => $shop_review_stars,
    'count' => $shop_review_count
    ];
  }
}