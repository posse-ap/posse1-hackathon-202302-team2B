<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderScopeController extends Controller
{
    public function scope(Request $request)
    {
        $delivery_status_list = DeliveryStatus::select('id', 'name')->get();

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $is_am = $request->input('is_am');
        $delivery_status = $request->input('delivery_status');

        $query = Order::query();

        if(!empty($date_from)) {
            $query->where('delivery_date', '>=', $date_from);
        }
        if(!empty($date_to)) {
            $query->where('delivery_date', '<=', $date_to);
        }
        if(!empty($is_am)) {
            $query->where('is_am', $is_am);
        }

        if(!empty($delivery_status)) {
            $query->where('delivery_status_id', $delivery_status);
        }

        $order_list = $query->with(['user:id,name','delivery_address','delivery_method','delivery_status'])->get();
        
        return view('admin/orders/index', compact('delivery_status_list', 'order_list'));
    }
}
