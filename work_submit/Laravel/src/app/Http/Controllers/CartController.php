<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // カートに追加
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        // 在庫確認
        if ($product->stock_quantity === 0) {
            return response()->json([
                'status' => 422,
                'message' => 'この商品は在庫切れです。'
            ], 422);
        }

        // カートに追加
        Cart::create([
            'user_id'    => auth()->id(),
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity ?? 1,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'カートに追加しました。',
            'tax_included_total' => $this->calcTotal(),
        ], 200);
    }

    // カートから削除
    public function remove(int $product_id)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->delete();

        return response()->json([
            'status' => 200,
            'tax_included_total' => $this->calcTotal(),
        ], 200);
    }

    // カート内の数量を変更
    public function update(Request $request, int $product_id)
    {
        // 在庫確認
        $product = Product::find($product_id);
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'status' => 422,
                'message' => 'この商品は在庫切れです。'
            ], 422);
        }

        Cart::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->update(['quantity' => $request->quantity]);

        return response()->json([
            'status' => 200,
            'tax_included_total' => $this->calcTotal(),
        ], 200);
    }

    // 合計金額を計算（税込）
    private function calcTotal()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return round($total * 1.1); // 税込
    }
}
