<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart');
        $cart_collection = collect();

        if (isset($cart)) {
            $cart->each(function ($item, $key) use ($cart_collection) {
                $product = Product::findOrFail($key);
                $cart_collection->put(
                    $key,
                    collect([
                        'quantity'  => $item,
                        'name'      => $product->name,
                        'thumbnail' => $product->thumbnail,
                        'price'     => $product->price
                    ])
                );
            });
        }

        return view('cart.index', compact('cart_collection'));
    }

    public function add($productid, $quantity = 1)
    {
        //パラメータの型チェック
        if (!is_numeric($productid)) {
            return redirect()->route('home');
        }
        if (!is_numeric($quantity)) {
            return redirect()->route('home');
        }

        //パラメータの製品存在チェック
        Product::findOrFail($productid);

        //カートに追加
        if (session()->exists('cart')) {
            $cart = session('cart');
            $cart_quantity = $cart->get($productid);
            if (is_numeric($cart_quantity)) {
                $cart->put($productid, $cart_quantity + $quantity);
            } else {
                $cart->put($productid, $quantity);
            }
            session(['cart' => $cart]);
        } else {
            $cart = collect([$productid => $quantity]);
            session(['cart' => $cart]);
        }

        $total_value = 0;
        $cart->each(function ($quantity, $product_id) use (&$total_value) {
            $product = Product::findOrFail($product_id);
            $total_value = $total_value + ($product->price * $quantity);
        });
        session(['total_value' => $total_value]);

        return redirect()->route('cart');
    }

    public function flush()
    {
        session()->flush();
    }
}
