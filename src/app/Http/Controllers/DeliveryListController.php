<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;

class DeliveryListController extends Controller
{
    public function index()
    {
        $orders = Order::with('delivery_address', 'order_details', 'order_details.product', 'user')
            ->where('delivery_date', '>=', Carbon::today()->format('Y-m-d'))
            ->where('delivery_date', '<', Carbon::today()->addDay(2)->format('Y-m-d'))
            ->get();
        return view('delivery.index', compact('orders'));
    }

    public function detail($order_id)
    {
        $order = Order::with('delivery_address', 'order_details', 'order_details.product', 'user')->find($order_id);
        return view('delivery.detail', compact('order'));
    }
}
