<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Brand;
use App\User;

class Shop extends Model
{
  protected $table = 'shops';

  // ブランドテーブルとのリレーション定義
  public function brands() {
    return $this->belongsToMany('App\Brand', 'brand_shop', 'shop_id', 'brand_id');
  }

  // ユーザテーブルとのリレーション定義
  public function users() {
    return $this->belongsToMany('App\User', 'favorites', 'user_id', 'shop_id');
  }
  
  // レビューテーブルとのリレーション定義
  public function reviews() {
    return $this->hasMany('App\ReviewShop', 'review_shop', 'shop_id', 'review_id');
  }
  
  //  ショップにfavoriteが付いているかの判定
  //  true:favoriteがついてる false:favoriteがついてない
  public function favorites()
  {
    return $this->hasMany(Favorite::class, 'shop_id');
  }

  public function is_favorited_by_auth_user()
  {
    $id = Auth::id();

    $favoriters = array();
    foreach($this->favorites as $favorite) {
      array_push($favoriters, $favorite->user_id);
    }

    if (in_array($id, $favoriters)) {
      return true;
    } else {
      return false;
    }
  }
}
