@extends('layouts.app')

@section('content')
    <div class="cart-index">
        @if ($cart_collection->isEmpty())
            <div class="head">
                カートが空です
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-ash" onclick="location.href='{{ route('home') }}'">
                    製品一覧に戻る
                </button>
            </div>
        @else
            <div class="head">
                このまま買い物を続けますか？
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-ash" onclick="location.href='{{  route('home') }}'">
                    製品一覧に戻る
                </button>
                <button type="button" class="btn btn-danger" onclick="location.href='{{  route('delivery-address') }}'">
                    注文する
                </button>
            </div>
            <div class="container border-top border-bottom my-3">

                @foreach ($cart_collection as $cart)

                <div class="row justify-content-sm-center my-1">
                    <div class="col-4">
                        <img
                            src="{{ asset('img/' . $cart->get('thumbnail')) }}"
                            style="height: 150px; width: 100%; display: block;"
                            alt="{{ $cart->get('name') }}"></div>
                    <div class="col-3">{{ $cart->get('name') }}</div>
                    <div class="col-2 text-right">{{ $cart->get('quantity') }}個</div>
                    <div class="col-3 text-right">¥{{ $cart->get('price') }}</div>
                </div>

                @endforeach

            </div>
            <div class="text-center">
                <button type="button" class="btn btn-danger" onclick="location.href='{{ route('delivery-address') }}'">
                    注文する
                </button>
            </div>
        @endif
    </div>
@endsection