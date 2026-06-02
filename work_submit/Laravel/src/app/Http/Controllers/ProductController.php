<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // カテゴリで絞り込み
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // キーワード検索
        if ($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // サイズで絞り込み
        if ($request->size) {
            $query->whereIn('size', $request->size);
        }

        // 好みで絞り込み
        if ($request->taste) {
            $query->where(function ($q) use ($request) {
                foreach ($request->taste as $taste) {
                    $q->orWhere('taste', 'like', '%' . $taste . '%');
                }
            });
        }

        // 価格帯で絞り込み
        if ($request->price) {
            switch ($request->price) {
                case '1':
                    $query->where('price', '<=', 3000);
                    break;
                case '2':
                    $query->whereBetween('price', [3001, 5000]);
                    break;
                case '3':
                    $query->whereBetween('price', [5001, 10000]);
                    break;
                case '4':
                    $query->where('price', '>=', 10001);
                    break;
            }
        }

        // ソート
        switch ($request->sort) {
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $products = $query->get();

        // お気に入り済みの商品IDを取得
        $favoriteProductIds = [];
        if (auth()->check()) {
            $favoriteProductIds = Favorite::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
        }

        // カート内の商品IDと数量を取得
        $cartItems = [];
        // ログイン済みならユーザーID、そうでなければセッションIDでカート内の商品を取得
        if (auth()->check()) {
            $cartItems = \App\Models\Cart::where('user_id', auth()->id())
                ->get()
                ->keyBy('product_id')
                ->toArray();
        } else {
            $sessionId = session('guest_id');
            $cartItems = \App\Models\Cart::where('session_id', $sessionId)
                ->get()
                ->keyBy('product_id')
                ->toArray();
        }


        // 合計金額を計算（税込）
        $cartTotal = 0;
        // ログイン済みならユーザーID、そうでなければセッションIDでカート内の商品を取得
        if (auth()->check()) {
            $carts = \App\Models\Cart::where('user_id', auth()->id())
                ->with('product')
                ->get();
            $cartTotal = round($carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity * 1.1;
            }));
        } else {
            $sessionId = session('guest_id');
            $carts = \App\Models\Cart::where('session_id', $sessionId)
                ->with('product')
                ->get();
            $cartTotal = round($carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity * 1.1;
            }));
        }
        return view('products.index', compact('products', 'favoriteProductIds', 'cartItems', 'cartTotal'));
    }
}
