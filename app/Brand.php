<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shop;

class Brand extends Model
{
    // ショップテーブルとのリレーション定義
    public function shops() {
        return $this->belongsToMany('App\Shop', 'brand_shop', 'brand_id', 'shop_id');
    }
}
