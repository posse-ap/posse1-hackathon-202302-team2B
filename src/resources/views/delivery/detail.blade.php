@extends('layouts.app')

@section('content')
    <div class="delivery-detail max-width-800-center">
        <div class="head">
            注文履歴
        </div>
        <div class="col-lg-12">
            <div class="block">
                <dt>注文番号</dt>
                <dd>{{ $order->id }}</dd>
                <h2 class="title">配送先住所</h2>
                <dt>会社名</dt>
                <dd>
                    {{ $order->user->company_name }}
                </dd>

                <dt>住所</dt>
                <dd>
                    {{ $order->delivery_address->getFullAddressAttribute() }}
                </dd>

                <div class="row">
                    <div class="col-lg-6">
                        <dt>電話番号</dt>
                        <dd>
                            {{ $order->delivery_address->tel }}
                        </dd>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <dt>お名前</dt>
                        <dd>
                            {{ $order->delivery_address->user->name }}
                        </dd>
                    </div>
                    <div class="col-lg-6">
                        <dt>メールアドレス</dt>
                        <dd>
                            {{ $order->delivery_address->user->email }}
                        </dd>
                    </div>
                </div>
            </div>
            <div class="block">
                <h2 class="title">配送元住所</h2>
                <dt>会社名</dt>
                <dd>
                    株式会社豊洲
                </dd>

                <dt>住所</dt>
                <dd>
                    東京都江東区豊洲６丁目３
                </dd>

                <div class="row">
                    <div class="col-lg-6">
                        <dt>電話番号</dt>
                        <dd>
                            03-9999-9999
                        </dd>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <dt>お名前</dt>
                        <dd>
                            豊洲 寛太
                        </dd>
                    </div>
                    <div class="col-lg-6">
                        <dt>メールアドレス</dt>
                        <dd>
                            test@toyosu.co.jp
                        </dd>
                    </div>
                </div>
            </div>
            <div class="block">
                <dt>配送時間帯</dt>
                <dd>
                    {{ $order->getFullFormatDeliveryDateAttribute() }}
                </dd>

                <dt class="mb-2">購入した商品</dt>
                <div class="row justify-content-sm-center mb-2">
                    @foreach ($order->order_details as $order_detail)
                    <div class="col-4"><img
                                src="{{ asset('img/' . $order_detail->product->thumbnail) }}"
                                style="height: 150px; width: 100%; display: block;"
                                alt="tomato"></div>
                    <div class="col-5">{{ $order_detail->product->name }}</div>
                    <div class="col-3 text-right">{{ $order_detail->quantity }}個</div>
                    @endforeach
                </div>
                <dt class="border-top pt-1">合計金額</dt>
                <dd class="text-right">¥{{ $order->total_price }}</dd>
            </div>
        </div>
        <div class="text-right pr15">
            <button type="button" class="btn btn-ash" onclick="location.href='/delivery-list'">
                配送一覧に戻る
            </button>
        </div>
    </div>
@endsection