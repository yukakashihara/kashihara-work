<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //新規登録画面を表示する
    public function index()
    {
        return view('register.index');
    }

    // 新規登録処理
    public function register(RegisterRequest $request)
    {
        // あとで書く
    }
}
