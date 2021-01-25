<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UpdateUserNameRequest;
use App\Http\Requests\UpdateMailAddressRequest;
use App\Http\Requests\UpdatePasswordRequest;

use App\Shop;
use App\User;
use App\Favorite;
use App\ReviewShop;

class UsersController extends Controller
{
    public function mypage(Request $request)
    {
        $user = Auth::user();

        // ユーザがお気に入りしているshopsレコードを取得
        $user_favorites = Favorite::where('user_id', $user->id)->get(['shop_id'])->toArray();
        $shops = Shop::whereIn('id', $user_favorites)->get();

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
            $shops->forPage($request->page, 5),
            $shops->count(),
            5,
            null,
            ['path' => $request->url()]
        );

        return view('users/mypage', compact('user', 'shops'));
    }
    
    public function updateUserNameShow()
   {
        $user = Auth::user();
        return view('users/username_edit', compact('user'));
    }
    
    public function updateUserName(UpdateUserNameRequest $request)
    {
         $user = Auth::user();
         $user->name = $request->get('username');
         $user->save();
 
         session()->flash('flash_message', 'ユーザー名を変更しました');
 
         return redirect()->back();
    }

    public function updateMailAddressShow()
    {
        $user = Auth::user();
        
        return view('users/mailaddress_edit', compact('user'));
    }

    public function updateMailAddress(UpdateMailAddressRequest $request)
    {
         $user = Auth::user();
         $user->email = $request->get('email');
         $user->save();
 
         session()->flash('flash_message', 'メールアドレスを変更しました');
 
         return redirect()->back();
    }

    public function updatePasswordShow()
    {
        return view('users/password_edit');
    }
    
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        
        session()->flash('flash_message', 'パスワードを変更しました');

        return redirect()->back();
    }
}
