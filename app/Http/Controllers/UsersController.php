<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\User;
use App\Favorite;
use App\Http\Requests\UpdateUserNameRequest;
use App\Http\Requests\UpdateMailAddressRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UsersController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();

        // ユーザがお気に入りしているshopsレコードを取得
        $user_favorites = Favorite::where('user_id', $user->id)->get(['shop_id'])->toArray();
        $shops = Shop::whereIn('id', $user_favorites)->paginate(5);
        // $shops = Shop::whereIn('id', $user_favorites)->get();

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
