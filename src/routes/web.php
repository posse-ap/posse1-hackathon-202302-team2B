<?php

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

// 未ログイン
Route::middleware([])->group(function () {
    Route::namespace('Auth')->group(function () {
        // 登録
        Route::prefix('register')->group(function () {
            Route::get('/',  'RegisterController@showRegistrationForm')->name('register');
            Route::post('/', 'RegisterController@register')->name('register.post');
        });

        // ログイン
        Route::prefix('login')->group(function() {
            Route::get('/',  'LoginController@showLoginForm')->name('login');
            Route::post('/', 'LoginController@login')->name('login.post');
        });

        // ログアウト
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });

    // 製品
    Route::get('/',         'ProductsController@index')->name('home');
    Route::get('/products', 'ProductsController@index')->name('products');

    // カート
    Route::prefix('cart')->group(function () {
        Route::get('/', 		              'CartController@index')->name('cart');
        Route::get('/{productid}/{quantity?}', 'CartController@add');
        Route::get('/flush',                  'CartController@flush');
    });
});

// ログイン済
Route::middleware(['auth'])->group(function () {
    // 一般ユーザー
    Route::middleware(['role:user'])->group(function () {
        // 配送先
        Route::prefix('delivery-address')->group(function () {
            Route::get('/',       'DeliveryAddressController@index')->name('delivery-address');
            Route::get('/create', 'DeliveryAddressController@showCreateForm')->name('delivery-address.showCreateForm');
            Route::post('/create', 'DeliveryAddressController@create')->name('delivery-address.create');
        });

        // 配送時間
        Route::post('/delivery-time', 'DeliveryTimeController@index')->name('delivery-time');

        // 注文
        Route::prefix('order')->group(function () {
            Route::get('/', 	    'OrderController@index')->name('order');
            Route::get('/thanks',   'OrderController@thanks')->name('order.thanks');
            Route::get('/{id}',     'OrderController@detail')->name('order.detail');
            Route::post('/confirm', 'OrderController@confirm')->name('order.confirm');
            Route::post('/cancel',  'OrderController@cancel')->name('order.cancel');
        });
    });

    // 配送業者・管理者
    Route::middleware(['role:delivery-agent'])->group(function () {
        Route::prefix('delivery-list')->group(function () {
            Route::get('/',     'DeliveryListController@index')->name('delivery-list');
            Route::get('/{id}', 'DeliveryListDetailController@detail')->name('delivery-list.detail');
        });
    });
});