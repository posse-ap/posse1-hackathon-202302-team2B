@extends('layouts.app')

@section('content')
    <div class="delivery-address-create">
        <div class="head">
            配送先を新しく登録する
        </div>
        <form action="{{ route('delivery-address.create') }}" method="POST" class="max-width-800-center">
            @csrf
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="inputName">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name') }}" placeholder="表参道本社" required autofocus>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="inputTel">電話番号</label>
                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="inputTel" name="tel" value="{{ old('tel') }}" placeholder="090-1234-5678" required>
                    @error('tel')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputZip">郵便番号</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="inputZip" name="postal_code" value="{{ old('postal_code') }}" placeholder="123-4567" required>
                    @error('postal_code')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">都道府県</label>
                    <select id="inputState" class="form-control" disabled>
                        <option selected>東京都</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="inputCity">市区町村</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="inputCity" name="city" value="{{ old('city') }}" placeholder="市区町村" required>
                    @error('city')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">住所1</label>
                <input type="text" class="form-control @error('address_1') is-invalid @enderror" id="inputAddress" name="address_1" value="{{ old('address_1') }}" placeholder="番地、号" required>
                @error('address_1')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress2">住所2</label>
                <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="inputAddress2" name="address_2" value="{{ old('address_2') }}" placeholder="建物名、部屋番号" required>
                @error('address_2')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-green">登録</button>
        </form>
    </div>
@endsection