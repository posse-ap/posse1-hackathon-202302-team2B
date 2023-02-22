@extends('layouts.app')

@section('content')
<div class="delivery-address-index max-width-800-center">
    <div class="head">
        定期便設定
    </div>

    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ScheduledOrderCheckbox">定期便にしますか？<span class="danger">*定期便にすると自動でご注文をしてくれます</span></label>
            <input type="radio" value="1" name="is_scheduled" />
            <label for="">期間（無記入では14日ごとの配送となります）<input type="number" name="delivery_span" min="0" max="365" placeholder="14"></label>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-danger">

            </button>
        </div>
    </form>
</div>
@endsection
