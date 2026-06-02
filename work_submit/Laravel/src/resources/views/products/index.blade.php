@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
{{-- ヘッダー --}}
<header class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom bg-white">
    <div class="fw-bold fs-5 tracking-wide">🍊 SAMPLE SHOP</div>
    <div class="d-flex align-items-center gap-4">
        <a href="#" class="text-dark text-decoration-none"><i class="fa-regular fa-heart"></i></a>
        <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="#" class="text-dark text-decoration-none"><i class="fa-regular fa-user"></i></a>
        @auth
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-dark rounded-0 px-3">LOGOUT</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-dark rounded-0 px-3">LOGIN</a>
        @endauth
    </div>
</header>

{{-- カテゴリタブ --}}
<nav class="border-bottom bg-white px-4">
    <div class="d-flex gap-4">
        <a href="{{ route('products.index', ['category_id' => 1]) }}"
            class="py-3 text-decoration-none text-dark border-bottom border-2 {{ request('category_id') == 1 ? 'border-dark' : 'border-transparent' }}">
            生果
        </a>
        <a href="{{ route('products.index', ['category_id' => 2]) }}"
            class="py-3 text-decoration-none text-dark border-bottom border-2 {{ request('category_id') == 2 ? 'border-dark' : 'border-transparent' }}">
            ジュース
        </a>
        <a href="{{ route('products.index', ['category_id' => 3]) }}"
            class="py-3 text-decoration-none text-dark border-bottom border-2 {{ request('category_id') == 3 ? 'border-dark' : 'border-transparent' }}">
            グッズ
        </a>
    </div>
</nav>

<form action="{{ route('products.index') }}" method="GET">
    <input type="hidden" name="category_id" value="{{ request('category_id') }}">

    {{-- メインエリア --}}
    <div class="container py-4">
        <div class="row">
            {{-- サイドバー --}}
            <aside class="col-md-3 col-lg-2">

                {{-- サイズ規格 --}}

                <div class="border p-3 mb-4 bg-white">
                    <p class="fw-bold mb-2 border-bottom pb-2">サイズ規格</p>
                    <div class="d-flex flex-column gap-2">
                        <label><input type="checkbox" name="size[]" value="S" {{ in_array('S', request('size', [])) ? 'checked' : '' }}> S</label>
                        <label><input type="checkbox" name="size[]" value="M" {{ in_array('M', request('size', [])) ? 'checked' : '' }}> M</label>
                        <label><input type="checkbox" name="size[]" value="L" {{ in_array('L', request('size', [])) ? 'checked' : '' }}> L</label>
                        <label><input type="checkbox" name="size[]" value="2L" {{ in_array('2L', request('size', [])) ? 'checked' : '' }}> 2L</label>
                        <label><input type="checkbox" name="size[]" value="混合" {{ in_array('混合', request('size', [])) ? 'checked' : '' }}> 混合</label>
                    </div>
                </div>

                {{-- 好み --}}

                <div class="border p-3 mb-4 bg-white">
                    <p class="fw-bold mb-2 border-bottom pb-2">好み</p>
                    <div class="d-flex flex-column gap-2">
                        <label><input type="checkbox" name="taste[]" value="あまい" {{ in_array('あまい', request('taste', [])) ? 'checked' : '' }}> あまい</label>
                        <label><input type="checkbox" name="taste[]" value="さっぱり" {{ in_array('さっぱり', request('taste', [])) ? 'checked' : '' }}> さっぱり</label>
                        <label><input type="checkbox" name="taste[]" value="香り豊か" {{ in_array('香り豊か', request('taste', [])) ? 'checked' : '' }}> 香り豊か</label>
                        <label><input type="checkbox" name="taste[]" value="むきやすい" {{ in_array('むきやすい', request('taste', [])) ? 'checked' : '' }}> むきやすい</label>
                        <label><input type="checkbox" name="taste[]" value="レア品種" {{ in_array('レア品種', request('taste', [])) ? 'checked' : '' }}> レア品種</label>
                    </div>
                </div>

                {{-- 価格帯 --}}

                <div class="border p-3 mb-4 bg-white">
                    <p class="fw-bold mb-2 border-bottom pb-2">価格帯</p>
                    <select name="price" class="form-select form-select-sm rounded-0" onchange="this.form.submit()">
                        <option value="" {{ request('price') === '' ? 'selected' : '' }}>指定なし</option>
                        <option value="1" {{ request('price') === '1' ? 'selected' : '' }}>〜 ¥3,000</option>
                        <option value="2" {{ request('price') === '2' ? 'selected' : '' }}>¥3,000 〜 ¥5,000</option>
                        <option value="3" {{ request('price') === '3' ? 'selected' : '' }}>¥5,000 〜 ¥10,000</option>
                        <option value="4" {{ request('price') === '4' ? 'selected' : '' }}>¥10,000 〜</option>
                    </select>
                </div>

            </aside>

            {{-- コンテンツエリア --}}
            <main class="col-md-9 col-lg-10">
                {{-- 検索バー --}}

                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="商品を検索してください" value="{{ request('keyword') }}">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>検索</button>
                </div>

                {{-- 件数表示とソート --}}

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="fw-bold">{{ $products->count() }}件の商品</div>

                    <div style="width:250px;">
                        <select class="form-select form-select-sm rounded-0" name="sort" onchange="this.form.submit()">
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>人気順</option>
                            <option value="new" {{ request('sort') === 'new' ? 'selected' : '' }}>新着順</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                        </select>
                    </div>
                </div>

                {{-- 合計金額 --}}
                <div id="cart-total">
                    合計金額：¥<span id="cart-total-price">{{ number_format($cartTotal) }}</span>（税込）
                </div>

                {{-- 商品一覧 --}}

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 border rounded-0 position-relative">
                            <img src="{{ $product->image_path }}" alt="商品画像" class="card-img-top">

                            @if ($product->stock_quantity === 0)
                            <p>在庫なし</p>
                            @elseif ($product->stock_quantity <= 5)
                                <p>残りわずか</p>
                                @else
                                <p>在庫あり</p>
                                @endif

                                <div class="card-body">
                                    <p class="card-title mb-1">{{ $product->name }}</p>
                                    <p class="mb-2">¥{{ number_format($product->price) }}</p>
                                    @if (isset($cartItems[$product->id]))
                                    <div class="d-flex align-items-center justify-content-between border rounded-pill px-3 py-1 mb-2"
                                        id="cart-item-{{ $product->id }}">
                                        @if ($cartItems[$product->id]['quantity'] === 1)
                                        <button type="button" class="cart-remove-btn btn btn-link p-0 text-danger"
                                            data-product-id="{{ $product->id }}">🗑️</button>
                                        @else
                                        <button type="button" class="cart-minus-btn btn btn-link p-0 text-dark"
                                            data-product-id="{{ $product->id }}">－</button>
                                        @endif
                                        <span id="cart-quantity-{{ $product->id }}">
                                            {{ $cartItems[$product->id]['quantity'] }}
                                        </span>
                                        <button type="button" class="cart-plus-btn btn btn-link p-0 text-dark"
                                            data-product-id="{{ $product->id }}">＋</button>
                                    </div>

                                    @else
                                    {{-- 未追加：カートに追加ボタン表示 --}}
                                    <button type="button" class="cart-btn btn btn-dark rounded-0 w-100 mb-2"
                                        data-product-id="{{ $product->id }}"
                                        {{ $product->stock_quantity === 0 ? 'disabled' : '' }}>
                                        {{ $product->stock_quantity === 0 ? '在庫なし' : 'カートに追加' }}
                                    </button>
                                    @endif

                                    <button
                                        type="button"
                                        class="favorite-btn btn position-absolute top-0 end-0 m-2 {{ in_array($product->id, $favoriteProductIds) ? 'active' : '' }}"
                                        data-product-id="{{ $product->id }}"
                                        style="z-index: 1; background: none; border: none; font-size: 1.2rem;">
                                        {{ in_array($product->id, $favoriteProductIds) ? '♥' : '♡' }}
                                    </button>
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <br>
                {{-- ページネーション --}}

                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <span class="page-link text-dark">‹</span>
                        </li>
                        <li class="page-item  active">
                            <span class="page-link bg-dark border-dark">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link text-dark" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link text-dark" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link text-dark" href="#">›</a>
                        </li>
                    </ul>
                </nav>

            </main>
        </div>

    </div>

</form>

@endsection