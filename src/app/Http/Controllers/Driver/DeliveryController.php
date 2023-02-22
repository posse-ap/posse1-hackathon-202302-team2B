<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
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

    public function update(Request $request)
    {
        $delivery_status = $request->input('delivery_status');

        $order_id = $request->get('order_id');

        $order = Order::find($order_id);

        $order->delivery_status_id = $delivery_status;

        $order->save();

        return redirect()
        ->route('delivery-list')
        ->with([
            'flush.message' => 'ステータスを変更しました',
            'flush.alert_type' => 'success',
        ]);
    }
}
