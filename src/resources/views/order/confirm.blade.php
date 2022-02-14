@extends('layouts.app')

@section('content')
    <div class="order-confirm max-width-800-center">
        <div class="head">
            ご注文の確認
        </div>
        <div class="col-lg-12">
            <div class="block">
                <h2 class="title">配送先</h2>
                <dt>名前</dt>
                <dd>
                    {{ $delivery_address->name }}
                </dd>

                <dt>住所</dt>
                <dd>
                    〒{{ $delivery_address->postal_code }} {{ $delivery_address->prefecture }}{{ $delivery_address->address_1 }}{{ $delivery_address->address_2 }}
                </dd>

                <div class="row">
                    <div class="col-lg-6">
                        <dt>電話番号</dt>
                        <dd>
                            {{ $delivery_address->tel }}
                        </dd>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <dt>お名前</dt>
                        <dd>
                            {{ $user->name }}
                        </dd>
                    </div>
                    <div class="col-lg-6">
                        <dt>メールアドレス</dt>
                        <dd>
                            {{ $user->email }}
                        </dd>
                    </div>
                </div>
            </div>
            <div class="block">
                <h2 class="title">配送元</h2>
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
                    {{ $delivery_time_disp }}
                </dd>
                <dt>配送方法</dt>
                <dd>{{ $delivery_method_disp }}</dd>

                <dt class="mb-2">カートに入っている商品</dt>

                @foreach ($cart_collection as $cart)

                    <div class="row justify-content-sm-center mb-2">
                        <div class="col-4"><img
                                    src="{{ asset('img/' . $cart->get('thumbnail')) }}"
                                    style="height: 150px; width: 100%; display: block;" alt="tomato"></div>
                        <div class="col-5">{{ $cart->get('name') }}</div>
                        <div class="col-3 text-right">{{ $cart->get('quantity') }}個</div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">¥{{ $cart->get('price') }}</div>
                    </div>
                    <dt class="border-top pt-1">合計金額</dt>
                    <dd class="text-right">¥{{ $cart->get('price') }}</dd>

                @endforeach

            </div>
        </div>

        <div class="text-right pr15">
            <button type="button" class="btn btn-danger" onclick="location.href='/order/thanks'">
                確定
            </button>
        </div>
    </div>
@endsection