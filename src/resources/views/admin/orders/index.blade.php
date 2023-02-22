@extends('layouts.app')

@section('content')
    <nav class="pb-2 border-bottom navbar">
        <h2>購入一覧</h2>

        <ul class="nav justify-content-end gap-2 bg-light rounded">
            <li class="nav-item"><a href="" class="text-decoration-none text-dark">products</a></li>
            <li class="nav-item"><a href="{{ route('admin.drivers.index') }}"
                    class="text-decoration-none text-dark">drivers</a></li>
            <li class="nav-item"><a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-dark">orders</a>
            </li>
        </ul>
    </nav>

    <!-- 絞り込み機能ここから -->
    <div class="search p-4 bg-light">
        <form action="{{ route('admin.orders.scope') }}" method="POST" class="my-0">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-6">配達期間</div>
                    <div class="col-3">配達時間</div>
                    <div class="col-3">配送ステータス</div>
                </div>
                <div class="row">
                    <div class="col-6 flex">
                        <input type="date" name="date_from" id="">　〜　<input type="date" name="date_to"
                            id="">
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="is_am">
                            <option value="">---</option>
                            <option value="1">午前</option>
                            <option value="0">午後</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="delivery_status">
                            <option selected="" value="">---</option>
                            @foreach ($delivery_status_list as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="my-2 modal-footer">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>
    </div>
    <!-- 絞り込み機能ここまで -->

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
            <th>トラック</th>
            <th>定期便</th>
            <th>キャンセル</th>
            <th>編集</th>
            <th>キャンセル承認</th>
            <th>返品</th>
        </tr>
        @foreach ($order_list as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->delivery_address->name }}</td>
                <td>{{ $order->delivery_date }}</td>
                <td>{{ $order->is_am ? '午前' : '午後' }}</td>
                <td>{{ $order->delivery_method->name }}</td>
                <td>{{ $order->delivery_status->name }}</td>
                <td>¥{{ number_format($order->total_price) }}</td>
                <td>{{ $order->truck_id == null ? '未割り当て' : $order->truck_id }}</td>
                <td>{{ $order->is_scheduled ? 'はい' : 'いいえ' }}</td>
                <td>{{ $order->canceled_at == null ? '無し' : '有り' }}</td>
                <td>
                    <button class="btn btn-success">
                        <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                            class="text-decoration-none text-light"> {{ __('編集') }} </a>
                    </button>
                </td>
                @if ($order->delivery_status_id == 4)
                    <th>
                        <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <select name="delivery_status_id">
                                <option value="5">キャンセル承認</option>
                            </select>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </th>
                @elseif($order->delivery_status_id == 6)
                    <th>
                        <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <select name="delivery_status_id">
                                <option value="7">返品配送待ち</option>
                            </select>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </th>
                @endif
            </tr>
        @endforeach
    </table>
    {{-- <a href="{{ route('drivers.create') }}">{{ __('新規作成') }}</a> --}}
@endsection
