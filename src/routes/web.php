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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryListController;
use App\Http\Controllers\DeliveryTimeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\DriverController;
use Illuminate\Support\Facades\Route;

// 未ログイン
Route::middleware([])->group(function () {
    Route::namespace('Auth')->group(function () {
        // 登録
        Route::controller(RegisterController::class)->prefix('register')->group(function () {
            Route::get('/',  'showRegistrationForm')->name('register');
            Route::post('/', 'register')->name('register.post');
        });

        Route::controller(LoginController::class)->group(function () {
            // ログイン
            Route::prefix('login')->group(function () {
                Route::get('/',  'showLoginForm')->name('login');
                Route::post('/', 'login')->name('login.post');
            });
            // ログアウト
            Route::get('/logout', 'logout')->name('logout');
        });
    });

    // 製品
    Route::get('/', [ProductsController::class, 'index'])->name('home');
    Route::get('/products', [ProductsController::class, 'index'])->name('products');

    // カート
    Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('/', 'index')->name('cart');
        Route::get('/{productid}/{quantity?}', 'add');
        Route::get('/flush', 'flush');
    });
});

// ログイン済
Route::middleware(['auth'])->group(function () {
    // 一般ユーザー
    Route::middleware(['role:user'])->group(function () {
        // 配送先
        Route::controller(DeliveryAddressController::class)->prefix('delivery-address')->group(function () {
            Route::get('/', 'index')->name('delivery-address');
            Route::get('/create', 'showCreateForm')->name('delivery-address.showCreateForm');
            Route::post('/create', 'create')->name('delivery-address.create');
        });

        // 配送時間
        Route::post('/delivery-time', [DeliveryTimeController::class, 'index'])->name('delivery-time');

        // 注文
        Route::controller(OrderController::class)->prefix('order')->group(function () {
            Route::get('/', 'index')->name('order');
            Route::get('/thanks', 'thanks')->name('order.thanks');
            Route::get('/{id}', 'detail')->name('order.detail');
            Route::post('/confirm', 'confirm')->name('order.confirm');
            Route::post('/cancel', 'cancel')->name('order.cancel');

            Route::post('/return', 'request_return')->name('order.return');
        });
    });

    // 管理者
    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('admin.index');
            // 配送業者
            Route::resource('drivers', DriverController::class);
        });
    });
    
    // 配送業者
    Route::middleware(['role:delivery-agent'])->group(function () {
        Route::prefix('delivery-list')->group(function () {
            Route::get('/', [DeliveryListController::class, 'index'])->name('delivery-list');
            Route::get('/{id}', [DeliveryListDetailController::class, 'detail'])->name('delivery-list.detail');
        });
    });
});
