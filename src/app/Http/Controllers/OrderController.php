<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAddress;
use App\Models\DeliveryMethod;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * 一覧ページ
     */
    protected const SCHEDULED_DISCOUNT_RATE = 0.05;

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('order.index', compact('orders'));
    }

    /**
     * 詳細ページ
     */
    public function detail($id)
    {
        $order = Order::findOrFail($id);

        return view('order.detail', compact('order'));
    }

    /**
     * 確認ページ
     */
    public function confirm(Request $request)
    {
        //前画面の入力項目をセッションに保持
        $delivery = session('delivery');
        $is_scheduled = $request->has('is_scheduled');
        $delivery_span = $request->input('delivery_span');

        if (!$delivery_span) {
            $delivery_span = 14;
        }

        $delivery->put('is_scheduled', $is_scheduled);
        $delivery->put('delivery_span', $delivery_span);
        session(['delivery' => $delivery]);

        //配送先情報取得
        $delivery_address = DeliveryAddress::findOrFail($delivery->get('delivery_address_id'));

        //ユーザ情報取得
        $user = User::findOrFail(Auth::id());

        //配送時間帯・配送方法を取得
        $delivery_time = $delivery->get('delivery_time');
        $delivery_time = Carbon::parse($delivery_time);
        $delivery_time_isam = $delivery->get('delivery_time_isam');
        $delivery_time_disp = Order::getFullFormatDeliveryDate($delivery_time, $delivery_time_isam);
        $delivery_method = $delivery->get('delivery_method');
        $delivery_method_disp = DeliveryMethod::findOrFail($delivery_method)->name;

        //カート情報取得
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
                        'price'     => $product->price,
                    ])
                );

                // $total_price += $product->quantity * $product->price;
            });
        }

        $discount_rate = self::SCHEDULED_DISCOUNT_RATE;

        return view(
            'order.confirm',
            compact('delivery_address', 'cart_collection', 'delivery_time_disp', 'delivery_method_disp', 'user', 'is_scheduled', 'delivery_span', 'discount_rate')
        );
    }

    /**
     * 確認
     * サンクスページ
     */
    public function thanks()
    {
        $delivery = session('delivery');

        $total_price = session('total_value') * (1 - self::SCHEDULED_DISCOUNT_RATE);

        $order = Order::create([
            'user_id'               => Auth::id(),
            'delivery_address_id'   => $delivery->get('delivery_address_id'),
            'delivery_date'         => $delivery->get('delivery_time'),
            'is_am'                 => $delivery->get('delivery_time_isam'),
            'delivery_method_id'    => $delivery->get('delivery_method'),
            'delivery_status_id'    => DeliveryStatus::getInPreparationId(),
            'total_price'           => $total_price,
            'is_scheduled' => $delivery->get('is_scheduled'),
            'delivery_span' => $delivery->get('delivery_span'),
        ]);

        $cart = session('cart');
        $cart->each(function ($quantity, $product_id) use ($order) {
            OrderDetail::create([
                'order_id'      => $order->id,
                'product_id'    => $product_id,
                'quantity'      => $quantity,
            ]);
        });

        //不要になったセッションのクリア
        session()->flash('delivery');
        session()->flash('cart');
        session()->flash('total_value');

        return view('order.thanks');
    }

    /**
     * キャンセル処理
     */
    public function cancel(Request $request)
    {
        $order = Order::findOrFail($request->input('id'));

        $order->delivery_status_id = DeliveryStatus::getCancelingId();
        $order->save();

        return redirect()
            ->route('order.detail', [$order])
            ->with([
                'flush.message' => 'キャンセル予約が完了しました',
                'flush.alert_type' => 'success',
            ]);
    }

    public function request_return(Request $request)
    {
        $order  = Order::findOrFail($request->input('id'));

        if (!$order->isReturnable()) {
            return redirect()
                ->route('order.detail', [$order])
                ->with([
                    'flush.message' => 'このご注文は返品期間を過ぎています。',
                    'flush.alert_type' => 'error',
                ]);
        }

        $order->delivery_status_id = DeliveryStatus::getReturnRequestingId();

        $order->save();

        return redirect()
            ->route('order.detail', [$order])
            ->with([
                'flush.message' => '返品申請をしました。',
                'flush.alert_type' => 'success',
            ]);
    }

    public function scheduled_orders(Request $request)
    {
        $orders = Order::where('user_id', Auth::id())->where('is_scheduled', true)->get();

        return view('order.scheduled.index', compact('orders'));
    }

    public function cancel_scheduled(Request $request)
    {
        $order_id = $request->input('id');
        $order = Order::find($order_id);

        $order->is_scheduled = false;

        $order->save();

        return redirect()
            ->route('order.detail', [$order])
            ->with([
                'flush.message' => '定期便のキャンセルが完了しました。',
                'flush.alert_type' => 'success',
            ]);
    }
}
