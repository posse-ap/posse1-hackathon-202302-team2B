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
use App\Http\Controllers\Admin;
use App\Http\Controllers\Driver\DeliveryController;
use App\Http\Controllers\ScheduledOrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

    //forgot password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

    // 製品
    Route::get('/', [ProductsController::class, 'index'])->name('home');
    Route::get('/products', [ProductsController::class, 'index'])->name('products');

    // カート
    Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('/', 'index')->name('cart');
        Route::get('/{product_id}', 'delete')->name('cart.delete');
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

        // 定期便
        Route::post('/scheduled', [ScheduledOrderController::class, 'index'])->name('scheduled-order');

        // 注文
        Route::controller(OrderController::class)->prefix('order')->group(function () {
            Route::get('/', 'index')->name('order');
            Route::get('/thanks', 'thanks')->name('order.thanks');
            Route::get('/scheduled', 'scheduled_orders')->name('order.scheduled');
            Route::get('/{id}', 'detail')->name('order.detail');
            Route::post('/{id}/scheduled', 'cancel_scheduled')->name('order.scheduled.cancel');
            Route::post('/confirm', 'confirm')->name('order.confirm');
            Route::post('/cancel', 'cancel')->name('order.cancel');
            Route::post('/return', 'request_return')->name('order.return');
        });
    });

    // 管理者
    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');

            // 配送業者
            Route::resource('drivers', DriverController::class);

            // 購入履歴
            Route::resource('orders', Admin\OrderController::class);
            Route::post('orders/sort', [Admin\OrderScopeController::class, 'scope'])->name('orders.scope');
            Route::post('orders/{order_id}/update_truck', [Admin\OrderScopeController::class, 'update'])->name('orders.truck');
            // 商品情報
            Route::get('product', [ProductController::class, 'index'])->name('product.index');
            Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        });
    });

    // 配送業者
    Route::middleware(['role:delivery-agent'])->group(function () {
        Route::controller(DeliveryController::class)->prefix('delivery-list')->group(function () {
            Route::get('/', 'index')->name('delivery-list');
            // Route::get('/{id}', [DeliveryListDetailController::class, 'detail'])->name('delivery-list.detail');
            Route::get('/{order_id}', 'detail')->name('delivery.detail');
            Route::post('/{order_id}', 'update')->name('delivery.udpate');
        });
    });
});
