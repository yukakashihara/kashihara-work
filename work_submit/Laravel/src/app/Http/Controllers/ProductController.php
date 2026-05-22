<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        return view('products.index', compact('products'));
    }
}
