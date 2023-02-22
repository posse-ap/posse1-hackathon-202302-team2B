@extends('layouts.app')

@section('content')
<form action="{{route('delivery.udpate', ['order_id' => $order->id])}}" method="POST">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">

<div class="order-detail max-width-800-center">
    <div class="head">
        注文履歴
    </div>
    <div class="col-lg-12">
        <div class="block">
            <dt>注文番号</dt>
            <dd>{{ $order->id }}</dd>
            <h2 class="title">配送先住所</h2>
            <dt>会社名</dt>
            <dd>{{ $order->delivery_address->name }}</dd>
            <dt>電話番号</dt>
            <dd>{{ $order->delivery_address->tel }}</dd>
            <dt>郵便番号</dt>
            <dd>{{ $order->delivery_address->postal_code }}</dd>
            <dt>住所</dt>
            <dd>{{ $order->delivery_address->full_address }}</dd>
            <div class="row">
                <div class="col-lg-6">
                    <dt>お名前</dt>
                    <dd>{{ $order->user->name }}</dd>
                </div>
                <div class="col-lg-6">
                    <dt>メールアドレス</dt>
                    <dd>{{ $order->user->email }}</dd>
                </div>
            </div>
        </div>
        <div class="block">
            <h2 class="title">配送元住所</h2>
            <dt>会社名</dt>
            <dd>株式会社豊洲</dd>
            <dt>住所</dt>
            <dd>東京都江東区豊洲６丁目３</dd>
            <dt>電話番号</dt>
            <dd>03-9999-9999</dd>

            <div class="row">
                <div class="col-lg-6">
                    <dt>お名前</dt>
                    <dd>豊洲 寛太</dd>
                </div>
                <div class="col-lg-6">
                    <dt>メールアドレス</dt>
                    <dd>test@toyosu.co.jp</dd>
                </div>
            </div>
        </div>
        <div class="block">
            <dt>配送時間帯</dt>
            <dd>{{ $order->full_format_delivery_date }}</dd>
            <dt>配送方法</dt>
            <dd>{{ $order->delivery_method->name }}</dd>

            <dt class="mb-2">購入した商品</dt>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">商品画像</th>
                        <th scope="col" class="text-left">商品名</th>
                        <th scope="col" class="text-right">数量</th>
                        <th scope="col" class="text-right">合計金額</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $index => $order_detail)
                    <tr>
                        <td>
                            <img src="{{ asset('img/' . $order_detail->product->thumbnail) }}"
                                style="height: 150px; width: 150px; display: block;"
                                alt="{{ $order_detail->product->name }}">
                        </td>
                        <td class="text-left">{{ $order_detail->product->name }}</td>
                        <td class="text-right">{{ $order_detail->quantity }}個</td>
                        <td class="text-right">¥{{ number_format($order_detail->product->price *
                            $order_detail->quantity) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="block">
            <dt>定期便指定</dt>
            <dd>
                {{ $order->is_scheduled? 'あり' : 'なし' }}
            </dd>
            @if($order->is_scheduled)
            <dt>配送間隔</dt>
            <dd>
                {{$order->delivery_span}}日
               </dd>
            @endif
        </div>
        <div class="block">
            <dt>配送状態</dt>
            <dd>{{ $order->delivery_status->name }}</dd>
            <select name="delivery_status">
                <option value="1" {{ $order->delivery_status_id == 1 ? 'selected' : '' }}>準備中</option>
                <option value="2" {{ $order->delivery_status_id == 2 ? 'selected' : '' }}>配送中</option>
                <option value="3" {{ $order->delivery_status_id == 3 ? 'selected' : '' }}>配送済み</option>
                <option value="5" {{ $order->delivery_status_id == 5 ? 'selected' : '' }}>キャンセル済み
                </option>
                <option value="6" {{ $order->delivery_status_id == 6 ? 'selected' : '' }}>返品申請中</option>
                <option value="7" {{ $order->delivery_status_id == 7 ? 'selected' : '' }}>返品配送待ち
                </option>
                <option value="8" {{ $order->delivery_status_id == 8 ? 'selected' : '' }}>返品配送中</option>
                <option value="9" {{ $order->delivery_status_id == 9 ? 'selected' : '' }}>返品済み</option>
            </select>
        </div>
    </div>
    <div class="text-right pr15">
        <button type="submit" class="btn btn-primary">更新</button>
    </div>
</div>
</form>
@endsection
