<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Favorite;

class FavoritesController extends Controller
{
    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['favorite', 'unfavorite']);
    }

    /**
    * 引数のIDに紐づくショップをお気に入りする
    *
    * @param $id ショップID
    * @return \Illuminate\Http\RedirectResponse
    */
    public function favorite($id)
    {
        Favorite::create([
        'shop_id' => $id,
        'user_id' => Auth::id(),
    ]);

    session()->flash('flash_message', 'お気に入りへ登録しました');

    return redirect()->back();
    }

    /**
     * 引数のIDに紐づくショップにUNFAVORITEする
     *
     * @param $id ショップID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unfavorite($id)
    {
        $favorite = Favorite::where('shop_id', $id)->where('user_id', Auth::id())->first();
        $favorite->delete();

        session()->flash('flash_message', 'お気に入りから削除しました');

        return redirect()->back();
    }
}
