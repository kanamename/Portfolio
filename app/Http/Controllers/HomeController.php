<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //shopsテーブルから全レコード取得
        $shops = DB::table('shops')->paginate(6);

        return view('index', [
            'shops' => $shops,
        ]);
    }
}
