<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        // セッションIDを取得
        $sessionID = session('guest_id');

        // セッションを再生成（セキュリティ対策）
        $request->session()->regenerate();

        // ログイン時にセッションのカートをユーザーのカートに合体させる 
        if ($sessionID) {
            $userID = auth()->id();
            Cart::where('session_id', $sessionID)
                ->update(['user_id' => $userID, 'session_id' => null]);
            session()->forget('guest_id');
        }

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

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
