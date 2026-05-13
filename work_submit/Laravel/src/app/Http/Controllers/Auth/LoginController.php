<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //ログイン画面を表示する
    public function index()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(LoginRequest $request)
    {
        // 認証処理
        if (!Auth::attempt($request->only('email', 'password'))) {
            // 認証失敗
            return back()->withErrors([
                'login' => 'メールアドレスまたはパスワードが正しくありません',
            ])->withInput();
        }

        // セッションを再生成（セキュリティ対策）
        $request->session()->regenerate();

        // ログインしたユーザーの役割で分岐
        $user = Auth::user();
        if ($user->role === User::ADMIN) {
            // 管理者
            return redirect()->route('admin.index');
        } else {
            // 一般ユーザー
            return redirect()->route('user.index');
        }
    }
}
