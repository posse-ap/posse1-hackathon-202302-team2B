<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    public function index(Request $request)
    {
        $delivery = collect(["delivery_address_id" => $request->input('delivery_address_id')]);
        session(['delivery' => $delivery]);

        $hour = Carbon::now()->hour;
        $time_array = collect();
        if ($hour < 3) {
            $time_array->put(Carbon::now()->addDay(0)->format('Y-m-d ') . 1, Carbon::now()->addDay(0)->format('本日(Y/m/d) ') . 'AM');
            $time_array->put(Carbon::now()->addDay(0)->format('Y-m-d ') . 0, Carbon::now()->addDay(0)->format('本日(Y/m/d) ') . 'PM');
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 1, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'AM');
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 0, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'PM');
        } elseif ($hour < 12) {
            $time_array->put(Carbon::now()->addDay(0)->format('Y-m-d ') . 0, Carbon::now()->addDay(0)->format('本日(Y/m/d) ') . 'PM');
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 1, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'AM');
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 0, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'PM');
            $time_array->put(Carbon::now()->addDay(2)->format('Y-m-d ') . 1, Carbon::now()->addDay(2)->format('明後日(Y/m/d) ') . 'AM');
        } else {
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 1, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'AM');
            $time_array->put(Carbon::now()->addDay(1)->format('Y-m-d ') . 0, Carbon::now()->addDay(1)->format('明日(Y/m/d) ') . 'PM');
            $time_array->put(Carbon::now()->addDay(2)->format('Y-m-d ') . 1, Carbon::now()->addDay(2)->format('明後日(Y/m/d) ') . 'AM');
            $time_array->put(Carbon::now()->addDay(2)->format('Y-m-d ') . 0, Carbon::now()->addDay(2)->format('明後日(Y/m/d) ') . 'PM');
        }

        return view('delivery.time.index', compact('time_array'));
    }
}
