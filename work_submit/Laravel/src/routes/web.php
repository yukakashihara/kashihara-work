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

// ログイン画面
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');

// 新規登録画面
Route::get('/register', 'Auth\RegisterController@index')->name('register.index');
Route::post('/register', 'Auth\RegisterController@register')->name('register.post');
