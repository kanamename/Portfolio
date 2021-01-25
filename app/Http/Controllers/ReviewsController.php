<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ReviewShop;
use App\Shop;

use App\Library\BaseClass;

use App\Http\Requests\ReviewRequest;

class ReviewsController extends Controller
{    
    /**
     * 新規投稿
     */
    public function index($id)
    {
        $shop_id = $id;

        return view('reviews.index', compact('shop_id'));
    }

    public function create(ReviewRequest $request)
    {
        $user = Auth::user();

        // 投稿内容を配列へ格納
        $savedata = [
            'shop_id' => $request->id,
            'user_id' => $user->id,
            'stars' => $request->review,
            'comment' => $request->comment,
        ];
        
        // 投稿処理
        $review_shop = new ReviewShop();
        $review_shop->fill($savedata)->save();
        
        session()->flash('flash_message', '投稿が完了しました');

        return redirect()->route('show', ['id' => $savedata['shop_id']]);
    }

    /**
     * 編集
     */
    public function edit($id)
    {
        $shop_id = $id;
        $user = Auth::user();

        // レビューデータ取得
        $review_data = ReviewShop::where('user_id', $user->id)->where('shop_id', $shop_id)->first();

        return view('reviews.edit', compact('shop_id', 'review_data'));
    }

    public function update(ReviewRequest $request)
    {
        $user = Auth::user();

        // 投稿内容を配列へ格納
        $savedata = [
            'shop_id' => $request->id,
            'user_id' => $user->id,
            'stars' => $request->review,
            'comment' => $request->comment,
        ];
        
        // 編集処理
        ReviewShop::where('user_id', $user->id)->where('shop_id', $savedata['shop_id'])
            ->update($savedata);
        
        session()->flash('flash_message', '投稿を編集しました');

        return redirect()->route('show', ['id' => $savedata['shop_id']]);
    }

    /**
     * 削除
    */
    public function delete($id)
    {
        $shop_id = $id;
        $user = Auth::user();

        // レビューデータ削除
        ReviewShop::where('user_id', $user->id)->where('shop_id', $shop_id)->delete();

        session()->flash('flash_message', '投稿を削除しました');

        return redirect()->route('show', ['id' => $shop_id]);
    }
}
