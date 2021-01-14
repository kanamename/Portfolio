<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  // 配列内の要素を書き込み可能にする
  protected $fillable = ['user_id','shop_id'];

  public function shop()
  {
    return $this->belongsTo(Shop::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
