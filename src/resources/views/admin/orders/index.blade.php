@extends('layouts.app')

@section('content')
<nav class="pb-2 border-bottom navbar">
    <h2>購入一覧</h2>
    
    <ul class="nav justify-content-end gap-2 bg-light rounded">
      <li class="nav-item"><a href="" class="text-decoration-none text-dark">products</a></li>
      <li class="nav-item"><a href="{{ route('drivers.index') }}" class="text-decoration-none text-dark">drivers</a></li>
      <li class="nav-item"><a href="{{ route('orders.index') }}" class="text-decoration-none text-dark">orders</a></li>
      <li class="nav-item"><a href="" class="text-decoration-none text-dark">sales</a></li>
      <li class="nav-item px-4"><a href="" class="text-decoration-none text-dark">users</a></li>
    </ul>
  </nav>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>ユーザー名</th>
        <th>配達先</th>
        <th>配達日時</th>
        <th>配達時刻</th>
        <th>受け取り方法</th>
        <th>配達ステータス</th>
        <th>金額</th>
        <th>定期便</th>
        <th>キャンセル有無</th>
      </tr>
      @foreach($order_list as $order)
      <tr>
        <th>{{$order->id}}</th>
        <th>{{$order->user->name}}</th>
        <th>{{$order->delivery_address->name}}</th>
        <th>{{$order->delivery_date}}</th>
        <th>{{$order->is_am ? '午前' : '午後'}}</th>
        <th>{{$order->delivery_method->name}}</th>
        <th>{{$order->delivery_status->name}}</th>
        <th>¥{{number_format($order->total_price)}}</th>
        <th>{{$order->is_scheduled ? 'はい' : 'いいえ'}}</th>
        <th>{{$order->canceled_at == NULL ? '無し' : '有り'}}</th>
        {{-- <td><a href="{{ route('drivers.edit', ['driver'=>$driver->id]) }}"> {{ __('編集') }} </a></td> --}}
      </tr>
      @endforeach
    </table>
    {{-- <a href="{{ route('drivers.create') }}">{{ __('新規作成') }}</a> --}}
@endsection