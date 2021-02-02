<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // ゲストユーザIDを定義
    private const GUEST_USER_ID = 1;

    /**
     * ログイン処理
     */
    public function guestLogin()
    {
        // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {    
            // ログインしたら、トップページへ移動
            return redirect('/')->with('flash_message', __('ゲストログインしました'));
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo() {
        session()->flash('flash_message', 'ログインしました');
    }

    /**
     * ログアウト処理
     */
    public function loggedOut(Request $request)
    {
        // ログアウトしたら、トップページへ移動
        return redirect('/')->with('flash_message', __('ログアウトしました'));
    }
}
