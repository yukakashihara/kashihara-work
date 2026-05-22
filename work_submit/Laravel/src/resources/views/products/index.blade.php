@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
{{-- ヘッダー --}}
<header class="d-flex justify-content-between align-items-center py-3 border-bottom">
    <div class="fw-bold fs-4">🍊 Sample Shop</div>
    <div class="d-flex gap-3 fs-5">
        <a href="#"><i class="fa-regular fa-heart"></i></a>
        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="#"><i class="fa-regular fa-user"></i></a>
    </div>
</header>

{{-- カテゴリタブ --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a data-toggle="tab" class="nav-link text-success" href="{{ route('products.index', ['category_id' => 1]) }}">生果</a>
    </li>
    <li class="nav-item">
        <a data-toggle="tab" class="nav-link text-success" href="{{ route('products.index', ['category_id' => 2]) }}">ジュース</a>
    </li>
    <li class="nav-item">
        <a data-toggle="tab" class="nav-link text-success" href="{{ route('products.index', ['category_id' => 3]) }}">グッズ</a>
    </li>
</ul>

<form action="{{ route('products.index') }}" method="GET">
    <input type="hidden" name="category_id" value="{{ request('category_id') }}">

    {{-- メインエリア --}}
    <div>
        {{-- サイドバー --}}
        <aside>

            {{-- サイズ規格 --}}

            <p>サイズ規格</p>
            <label><input type="checkbox" name="size[]" value="S" {{ in_array('S', request('size', [])) ? 'checked' : '' }}> S</label>
            <label><input type="checkbox" name="size[]" value="M" {{ in_array('M', request('size', [])) ? 'checked' : '' }}> M</label>
            <label><input type="checkbox" name="size[]" value="L" {{ in_array('L', request('size', [])) ? 'checked' : '' }}> L</label>
            <label><input type="checkbox" name="size[]" value="2L" {{ in_array('2L', request('size', [])) ? 'checked' : '' }}> 2L</label>
            <label><input type="checkbox" name="size[]" value="混合" {{ in_array('混合', request('size', [])) ? 'checked' : '' }}> 混合</label>

            {{-- 好み --}}

            <p>好み</p>
            <label><input type="checkbox" name="taste[]" value="あまい" {{ in_array('あまい', request('taste', [])) ? 'checked' : '' }}> あまい</label>
            <label><input type="checkbox" name="taste[]" value="さっぱり" {{ in_array('さっぱり', request('taste', [])) ? 'checked' : '' }}> さっぱり</label>
            <label><input type="checkbox" name="taste[]" value="香り豊か" {{ in_array('香り豊か', request('taste', [])) ? 'checked' : '' }}> 香り豊か</label>
            <label><input type="checkbox" name="taste[]" value="むきやすい" {{ in_array('むきやすい', request('taste', [])) ? 'checked' : '' }}> むきやすい</label>
            <label><input type="checkbox" name="taste[]" value="レア品種" {{ in_array('レア品種', request('taste', [])) ? 'checked' : '' }}> レア品種</label>

            {{-- 価格帯 --}}

            <p>価格帯</p>
            <select name="price" onchange="this.form.submit()">
                <option value="" {{ request('price') === '' ? 'selected' : '' }}>指定なし</option>
                <option value="1" {{ request('price') === '1' ? 'selected' : '' }}>〜 ¥3,000</option>
                <option value="2" {{ request('price') === '2' ? 'selected' : '' }}>¥3,000 〜 ¥5,000</option>
                <option value="3" {{ request('price') === '3' ? 'selected' : '' }}>¥5,000 〜 ¥10,000</option>
                <option value="4" {{ request('price') === '4' ? 'selected' : '' }}>¥10,000 〜</option>
            </select>

        </aside>

        {{-- コンテンツエリア --}}
        <main>
            {{-- 検索バー --}}

            <input type="text" name="keyword" placeholder="商品を検索してください" value="{{ request('keyword') }}">
            <button type="submit">検索</button>

            {{-- 件数表示とソート --}}

            <p>{{ $products->count() }}件の商品</p>
            <select name="sort" onchange="this.form.submit()">
                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>人気順</option>
                <option value="new" {{ request('sort') === 'new' ? 'selected' : '' }}>新着順</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
            </select>

            {{-- 商品一覧 --}}

            <div>
                @foreach ($products as $product)
                <div>
                    <img src="{{ $product->image_path }}" alt="商品画像">

                    @if ($product->stock_quantity === 0)
                    <p>在庫なし</p>
                    @elseif ($product->stock_quantity <= 5)
                        <p>残りわずか</p>
                        @else
                        <p>在庫あり</p>
                        @endif

                        <p>{{ $product->name }}</p>
                        <p>¥{{ number_format($product->price) }}</p>
                        <button type="button">カートに追加</button>
                        <button type="button">♡</button>
                </div>
                @endforeach
            </div>

            {{-- ページネーション --}}

            <div>
                <a href="#">＜</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">＞</a>
            </div>

        </main>

    </div>

</form>

@endsection