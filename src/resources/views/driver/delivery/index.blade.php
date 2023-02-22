@extends('layouts.app')

@section('content')
    <div class="delivery-index">
        <h2>配送一覧</h2>
        <select id="sampleSelect" onChange="goFilter();">
            <option value="all">全て</option>
            <option value="today_am">本日(2019/11/20) AM</option>
            <option value="today_pm">本日(2019/11/20) PM</option>
            <option value="tomorrow_am">明日(2019/11/20) AM</option>
            <option value="tomorrow_pm">明日(2019/11/20) PM</option>
        </select>
        <ul id="sampleTable">

            @foreach ($orders as $order)
                <li today_am data-bs-filter-key="20191120AM">
                    {{ $order->getFullFormatDeliveryDateAttribute() }} 配達予定
                    <div class="block">
                        <div class="row position">
                            <div class="col-5 order-head">■ 注文番号 {{ $order->id }}</div>
                            <div class="col-7 order-head">
                                トラックNo: {{ $order->truck_id }}
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

                        @foreach ($order->order_details as $order_detail)
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

                        <div class="text-right d-flex justify-content-between">
                            <div class="d-flex">
                                <button type="button" class="btn btn-ash"
                                    onclick="location.href='/delivery-list/{{ $order->id }}'">
                                    詳細を見る
                                </button>
                                <form action="{{ route('delivery.udpate', ['order_id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <select name="delivery_status">
                                        <option value="1" {{ $order->delivery_status_id == 1 ? 'selected' : '' }}>準備中
                                        </option>
                                        <option value="2" {{ $order->delivery_status_id == 2 ? 'selected' : '' }}>配送中
                                        </option>
                                        <option value="3" {{ $order->delivery_status_id == 3 ? 'selected' : '' }}>配送済み
                                        </option>
                                        <option value="5" {{ $order->delivery_status_id == 5 ? 'selected' : '' }}>
                                            キャンセル済み
                                        </option>
                                        <option value="6" {{ $order->delivery_status_id == 6 ? 'selected' : '' }}>
                                            返品申請中</option>
                                        <option value="7" {{ $order->delivery_status_id == 7 ? 'selected' : '' }}>
                                            返品配送待ち
                                        </option>
                                        <option value="8" {{ $order->delivery_status_id == 8 ? 'selected' : '' }}>
                                            返品配送中</option>
                                        <option value="9" {{ $order->delivery_status_id == 9 ? 'selected' : '' }}>返品済み
                                        </option>
                                    </select>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </form>
                            </div>
                        </div>
                </li>
            @endforeach

        </ul>
    </div>
@endsection
