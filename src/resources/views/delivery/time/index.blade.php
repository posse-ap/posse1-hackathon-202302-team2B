@extends('layouts.app')

@section('content')
    <div class="delivery-time-index">
        <div class="head">
            ご希望の配送時間帯
        </div>

        <form action="{{ route('order.confirm') }}" method="post">
            @csrf
            <div class="form-group max-width-800-center">
                <label for="exampleFormControlSelect1">希望配達時間</label>
                <select name="delivery_time" class="form-control mb-2" id="exampleFormControlSelect1">
                    @foreach ($time_array as $value => $display)
                    <option value="{{ $value }}">{{ $display }}</option>
                    @endforeach
                </select>

                <label for="exampleFormControlSelect2">希望配達方法</label>
                <select name="delivery_method" class="form-control" id="exampleFormControlSelect2">
                    <option value="1">置き配</option>
                    <option value="2">受け取り</option>
                </select>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-danger">
                        OK
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection