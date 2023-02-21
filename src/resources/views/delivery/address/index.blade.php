@extends('layouts.app')

@section('content')
    <div class="delivery-address-index max-width-800-center">
        <div class="head">
            配送先を選ぶ
        </div>

        <form action="{{ route('delivery-time') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">登録されている配送先</label>
                <select class="form-control" id="exampleFormControlSelect1" name="delivery_address_id">

                    @foreach ($delivery_addresses as $delivery_address)

                    <option value="{{ $delivery_address->id }}">【{{ $delivery_address->name }}】 〒{{ $delivery_address->postal_code }} {{ $delivery_address->prefecture }}{{ $delivery_address->address_1 }}{{ $delivery_address->address_2 }}</option>

                    @endforeach

                </select>
                <a href="{{ route('delivery-address.showCreateForm') }}">
                    新しく住所を登録する
                </a>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-danger">
                        OK
                </button>
            </div>
        </form>
    </div>
@endsection