@extends('layouts.app')

@section('content')
    <div class="order-thanks">
        <div class="max-width-800-center">
            <div class="block">
                <h2 class="head">ご注文ありがとうございました！</h2>

                <div class="mb-3">
                    ご注文をお受けいたしました。商品到着まで今しばらくお待ち下さい。
                </div>

                <button type="button" class="btn btn-ash" onclick="location.href='/'">
                    製品一覧に戻る
                </button>
            </div>
        </div>
    </div>
@endsection