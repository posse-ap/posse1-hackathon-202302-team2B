@extends('layouts.app')

@section('content')
    <div class="order-index">
        <h2>注文履歴一覧</h2>

        @foreach ($orders as $order)
            <a href="{{  route('order.detail', [ 'id' => $order->id ]) }}" class="link-area">
                <div class="block">
                    <div class="row my-3">
                        <div class="col-5">■ 注文番号 {{ $order->id }}</div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col" class="text-left">商品名</th>
                              <th scope="col" class="text-right">数量</th>
                              <th scope="col" class="text-right">合計金額</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $index => $order_detail)
                                <tr>
                                    <td class="text-left">{{ $order_detail->product->name }}</td>
                                    <td class="text-right">{{ $order_detail->quantity }}個</td>
                                    <td class="text-right">¥{{ number_format($order_detail->product->price * $order_detail->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </a>
        @endforeach
    </div>
@endsection