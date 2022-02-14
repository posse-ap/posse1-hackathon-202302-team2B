<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $order_id = $order->id;
            foreach ($products as $product) {
                OrderDetail::create([
                    'order_id'   => $order_id,
                    'product_id' => $product->id,
                    'quantity'   => 3,
                ]);
            }
        }
    }
}
