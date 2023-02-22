<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduledOrderController extends Controller
{
    public function index(Request $request)
    {
        $delivery = session('delivery');
        [$delivery_time, $delivery_time_isam] = explode(' ', $request->input('delivery_time'));
        $delivery_method = $request->input('delivery_method');
        $delivery->put('delivery_time', $delivery_time);
        $delivery->put('delivery_time_isam', $delivery_time_isam);
        $delivery->put('delivery_method', $delivery_method);
        session(['delivery' => $delivery]);

        return view('order.scheduled.index');
    }
}
