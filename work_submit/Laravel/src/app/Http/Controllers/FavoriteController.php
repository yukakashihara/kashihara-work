<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle(int $product_id)
    {
        // ログイン確認
        if (!auth()->check()) {
            return response()->json(['redirect' => route('login')], 401);
        }
        $user_id = auth()->id();

        // すでにお気に入り登録済みか確認
        $favorite = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($favorite) {
            // 登録済みなら解除
            $favorite->delete();
            $message = 'お気に入りから削除しました。';
        } else {
            // 未登録なら登録
            Favorite::create([
                'user_id'    => $user_id,
                'product_id' => $product_id,
            ]);
            $message = 'お気に入りに追加しました。';
        }

        return back()->with('message', $message);
    }
}
