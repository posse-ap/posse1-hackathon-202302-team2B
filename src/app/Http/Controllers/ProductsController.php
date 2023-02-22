<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::where('is_active', 1)->get();

        return view('product.index', compact('products'));
    }
}
