<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //新規登録画面を表示
    public function index()
    {
        return view('register.index');
    }

    // 確認画面を表示
    public function confirm(RegisterRequest $request)
    {
        // 入力値をセッションに保存
        $request->session()->put('register', $request->all());

        return view('register.confirm', [
            'data' => $request->all()
        ]);
    }

    // 登録処理
    public function register(Request $request)
    {
        // セッションから入力値を取得
        $data = $request->session()->get('register');

        // ユーザー情報をDBに保存
        User::create([
            'last_name'       => $data['last_name'],
            'first_name'      => $data['first_name'],
            'last_name_kana'  => $data['last_name_kana'],
            'first_name_kana' => $data['first_name_kana'],
            'email'           => $data['email'],
            'password_hash'   => Hash::make($data['password']),
            'status'          => 1,
            'role'            => User::USER,
        ]);

        // セッションを削除
        $request->session()->forget('register');

        return redirect()->route('register.complete');
    }

    // 登録完了画面を表示する
    public function complete()
    {
        return view('register.complete');
    }
}
