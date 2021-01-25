<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ReviewShop extends Model
{
    protected $table = 'review_shop';
    protected $guarded = [''];

    // ユーザテーブルとのリレーション
    public function users() {
        return $this->belongsTo('App\User', 'user_id', 'id')
            ->select('id', 'name');
    }
}
