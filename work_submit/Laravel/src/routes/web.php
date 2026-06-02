<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 管理画面
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
  // 管理画面トップ
  Route::get('/', 'admin\AdminController@index')->name('index');
  // 商品登録画面
  Route::get('/product/add', 'admin\ProductController@add')->name('product.add');
});

// 一般ユーザートップ
Route::get('/', 'TopController@index')->name('user.index');

// ログイン画面
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// 新規登録画面
Route::get('/register', 'Auth\RegisterController@index')->name('register.index');
Route::post('/register', 'Auth\RegisterController@confirm')->name('register.post');

// 確認画面
Route::get('/register/confirm', 'Auth\RegisterController@confirm')->name('register.confirm');
Route::post('/register/confirm', 'Auth\RegisterController@register')->name('register.confirm.post');

// 登録完了画面
Route::get('/register/complete', 'Auth\RegisterController@complete')->name('register.complete');

// 商品一覧画面
Route::get('/products', 'ProductController@index')->name('products.index');

// お気に入り登録・解除
Route::post('/favorites/{product_id}', 'FavoriteController@toggle')->name('favorites.toggle');

// カートに追加
Route::post('/cart', 'CartController@add')->name('cart.add');
Route::delete('/cart/{product_id}', 'CartController@remove')->name('cart.remove');
Route::patch('/cart/{product_id}', 'CartController@update')->name('cart.update');