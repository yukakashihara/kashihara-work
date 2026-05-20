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
<nav>
    <a href="#">生果</a>
    <a href="#">ジュース</a>
    <a href="#">グッズ</a>
</nav>

{{-- メインエリア --}}
<div>

    {{-- サイドバー --}}
    <aside>
        {{-- サイズ規格 --}}
        <div>
            <p>サイズ規格</p>
            <label><input type="checkbox" value="S"> S</label>
            <label><input type="checkbox" value="M"> M</label>
            <label><input type="checkbox" value="L"> L</label>
            <label><input type="checkbox" value="2L"> 2L</label>
            <label><input type="checkbox" value="混合"> 混合</label>
        </div>

        {{-- 好み --}}
        <div>
            <p>好み</p>
            <label><input type="checkbox" value="あまい"> あまい</label>
            <label><input type="checkbox" value="さっぱり"> さっぱり</label>
            <label><input type="checkbox" value="香り豊か"> 香り豊か</label>
            <label><input type="checkbox" value="むきやすい"> むきやすい</label>
            <label><input type="checkbox" value="レア品種"> レア品種</label>
        </div>

        {{-- 価格帯 --}}
        <div>
            <p>価格帯</p>
            <select>
                <option value="">指定なし</option>
                <option value="1">〜 ¥3,000</option>
                <option value="2">¥3,000 〜 ¥5,000</option>
                <option value="3">¥5,000 〜 ¥10,000</option>
                <option value="4">¥10,000 〜</option>
            </select>
        </div>
    </aside>

    {{-- コンテンツエリア --}}
    <main>
        {{-- 検索バー --}}
        <div>
            <input type="text" placeholder="商品を検索してください">
            <button type="button">検索</button>
        </div>

        {{-- 件数表示とソート --}}
        <div>
            <p>〇件の商品</p>
            <select>
                <option value="popular">人気順</option>
                <option value="new">新着順</option>
                <option value="price_asc">価格が安い順</option>
                <option value="price_desc">価格が高い順</option>
            </select>
        </div>

        {{-- 商品一覧 --}}
        <div>
            {{-- 商品カード1 --}}
            <div>
                <img src="" alt="商品画像">
                <p>在庫あり</p>
                <p>温州みかん（5kg）</p>
                <p>¥2,980</p>
                <button type="button">カートに追加</button>
                <button type="button">♡</button>
            </div>

            {{-- 商品カード2 --}}
            <div>
                <img src="" alt="商品画像">
                <p>残りわずか</p>
                <p>河内晩柑（5kg）</p>
                <p>¥2,480</p>
                <button type="button">カートに追加</button>
                <button type="button">♡</button>
            </div>

            {{-- 商品カード3 --}}
            <div>
                <img src="" alt="商品画像">
                <p>在庫なし</p>
                <p>ブラッドオレンジ（3kg）</p>
                <p>¥3,480</p>
                <button type="button">カートに追加</button>
                <button type="button">♡</button>
            </div>

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

@endsection