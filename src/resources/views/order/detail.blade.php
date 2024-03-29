@extends('layouts.app')

@section('content')
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
                                <td class="text-right">
                                    ¥{{ number_format($order_detail->product->price * $order_detail->quantity) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="block">
                <dt>定期便指定</dt>
                <dd>
                    {{ $order->is_scheduled ? 'あり' : 'なし' }}
                </dd>
                @if ($order->is_scheduled)
                    <dt>配送間隔</dt>
                    <dd>
                        {{ $order->delivery_span }}日
                    </dd>

                    <form action="{{ route('order.scheduled.cancel', ['id' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-primary">定期便をキャンセル</button>
                    </form>
                @endif
            </div>

            <div class="block">
                <dt>配送状態</dt>
                <dd>{{ $order->delivery_status->name }}</dd>
                @if ($order->delivery_status->isCancelable())
                    <form action="{{ route('order.cancel') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-danger">キャンセル予約</button>
                        @if ($order->is_scheduled)
                            <p>＊次便以降はキャンセルとなりません。</p>
                        @endif
                    </form>
                @endif
                @if ($order->isReturnable())
                    <form action="{{ route('order.return') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-danger">返品申請</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="text-right pr15">
            <button type="button" class="btn btn-ash" onclick="location.href='{{ route('order') }}'">
                注文履歴一覧に戻る
            </button>
        </div>
    </div>
@endsection
