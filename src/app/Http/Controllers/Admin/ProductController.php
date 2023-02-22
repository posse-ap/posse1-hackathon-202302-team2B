<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin/product/index', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products=new Product;


        $products->name=$request->input('name');
        $products->description=$request->input('description');
        $products->image1=$request->input('image1');
        $products->quantity=$request->input('quantity');
        $products->price=$request->input('price');
        $products->discount_rate=$request->input('discount_rate');
        $products->is_active=$request->input('is_active');
        $products->version = 1;
        $products->thumbnail = '9_thumbnail.jpg';


        $products->save();

        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products =Product::find($id);

        return view('admin/product/edit', compact('products', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products=Product::find($id);

        $products->name=$request->input('name');
        $products->description=$request->input('description');
        $products->image1=$request->input('image1');
        $products->quantity=$request->input('quantity');
        $products->price=$request->input('price');
        $products->discount_rate=$request->input('discount_rate');
        $products->is_active=$request->input('is_active');

        //DBに保存
        $products->save();

        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=Product::find($id);

        $products->delete();

        return redirect('admin/product');
    }
}
