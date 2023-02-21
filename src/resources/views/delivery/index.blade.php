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

            @foreach($orders as $order)

                <li today_am data-filter-key="20191120AM">
                    {{ $order->getFullFormatDeliveryDateAttribute() }} 配達予定
                    <div class="block">
                        <div class="row position">
                            <div class="col-5 order-head">■ 注文番号 {{ $order->id }}</div>
                            <div class="col-7 order-head">
                                トラック{{ $order->truck_id }}
                                <i class="material-icons track"
                                   data-toggle="modal"
                                   data-target="#trackModal"
                                   data-whatever="track1">local_shipping</i>
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

                        <div class="text-right">
                            <button type="button" class="btn btn-ash"
                                    onclick="location.href='/delivery-list/{{ $order->id }}'">
                                詳細を見る
                            </button>
                        </div>
                    </div>
                </li>

            @endforeach

        </ul>

        <!-- Modal -->
        <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <!-- //モーダルウィンドウの縦表示位置を調整・画像を大きく見せる -->
            <div class="modal-dialog modal-lg modal-middle">
                <div class="modal-content">
                    <form>
                        <div class="modal-body">
                            <label for="trackSelect">配送トラック選択</label>
                            <select class="form-control" id="trackSelect">
                                <option>トラック１</option>
                                <option>トラック２</option>
                                <option>トラック３</option>
                                <option>トラック４</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-ash" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger" data-dismiss="modal" id="testttt">
                                決定
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function goFilter() {
            var wTable = document.getElementById("sampleTable");
            var wSelect = document.getElementById("sampleSelect");
            var value = wSelect.options[wSelect.selectedIndex].value;
            if (value == 'all') {
                // --- 全ての場合はクラスをクリア ---
                wTable.className = '';
                console.log(1);
            } else {
                // --- タイトル以外のTRを非表示＋指定属性を持つTRのみ表示 ---
                wTable.className = 'allNoDisplay ' + value;
                console.log(2);
            }
        }

        $('#testttt').on('click', function () {
            alert("testtttt");
            var cusno = $('#cusno').val();
            var oldday = $('#oldday').val();
            var newday = $('#newday').val();
            $.ajax({
                url: "/", // 送信先 URL
                type: "POST", // GET,POSTとか
                dataType: "text",
                data: { // 送信するデータ
                    xxx: 'dateup',
                    oldday: oldday,
                    newday: newday,
                    cusno: cusno
                }
            }).done(function (data) {
                // 通信成功時の処理
                // PHP から返ってきた値（メッセージ）を p タグにセット
                $('#mess').text(data);
            }).fail(function (data) {
                // 通信失敗時の処理
                console.dir(data);
            }).always(function (data) {
                // 常に実行する処理
                $("#modalForm").modal('hide'); // モーダルを閉じる
            });
        });
    </script>
@endpush