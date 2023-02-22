<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_status_list = DeliveryStatus::select('id', 'name')->get();
        $order_list = Order::with(['user:id,name','delivery_address','delivery_method','delivery_status'])->get();
        // dd($order_list);

        return view('admin/orders/index', compact('delivery_status_list', 'order_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $user_id = Auth::id();
        $order = Order::find($order_id);
        $drivers = User::where('role_id', Role::getDeliveryAgentId())->get();

        return view('admin.orders.detail', compact('order', 'drivers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = Order::find($id);
        $delivery_status_id = $request->input('delivery_status_id');

        if ($delivery_status_id == DeliveryStatus::getCanceledId()) {
            $order->calceled_at = Carbon::now();
            $message = 'キャンセル済みに変更しました';
        } else {
            $message = '返品を受領しました。';
        }
        $order->delivery_status_id = $delivery_status_id;

        $order->save();

        return redirect()
        ->route('admin.orders.index')
        ->with([
            'flush.message' => $message,
            'flush.alert_type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
