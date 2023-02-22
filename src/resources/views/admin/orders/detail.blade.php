@extends('layouts.app')

@section('content')
<div class="delivery-index">
    <h2>詳細</h2>
    <ul id="sampleTable">

        {{--@foreach($orders as $order) --}}

        <li today_am data-bs-filter-key="20191120AM">
            {{ $order->delivery_date }} 配達予定
            <div class="block">
              <form action="{{route('admin.orders.truck', ['order_id' => $order->id])}}" method="POST">
                @method('POST')
                @csrf
                <div class="row position">
                    <div class="col-5 order-head">■ 注文番号 {{ $order->id }}</div>
                    <div class="col-7 order-head">
                        トラックNo:
                        <select name="truck_id">
                            @for ($i = 1; $i <= 4; $i++)
                            <option value="{{$i}}" {{ $order->truck_id == $i ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                ■ 配送先住所
                <div class="row">
                    <div class="col-12">〒{{ $order->delivery_address->postal_code }}</div>
                </div>
                <div class="row">
                    <div class="col-12">{{ $order->delivery_address->getFullAddressAttribute() }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">{{ $order->user->company_name }}</div>
                </div>
                ■ 注文内容
                @foreach($order->order_details as $order_detail)
                <div class="row">
                    <div class="col-5">{{ $order_detail->product->name }}</div>
                    <div class="col-4 text-right">{{ $order_detail->quantity }}個</div>
                    <div class="col-3 text-right">¥{{ $order_detail->product->price }}</div>
                </div>
                @endforeach

                <dt class="border-top pt-1">合計金額</dt>
                <div class="row">
                    <div class="col-12 text-right">¥{{ $order->total_price }}</div>
                </div>

                  <div class="d-flex">
                      <button type="submit" class="btn btn-primary">更新</button>
                  </div>
                </form>
              </div>
        </li>

        {{-- @endforeach --}}

    </ul>
</div>
@endsection
