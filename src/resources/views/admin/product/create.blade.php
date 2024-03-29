@extends('layouts.app')

@section('content')
    <h1>新規作成</h1>

    <form method="POST" action="{{ route('admin.product.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input name="name" type="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">商品説明</label>
            <input name="description" type="description" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="image1" class="form-label">写真</label>
            <input name="image1" type="image1" class="form-control" id="image1">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">1箱当たりの量
            </label>
            <input name="quantity" type="quantity" class="form-control" id="quantity">
        </div>
        <div class="mb-3">
            <label for="discount_rate" class="form-label">割引率</label>
            <input name="discount_rate" type="discount_rate" class="form-control" id="discount_rate">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">料金</label>
            <input name="price" type="price" class="form-control" id="price">
        </div>
        <div>販売状況</div>
        <div class="mb-3 form-check">
            <input type="radio" name="is_active" class="form-check-input" id="1" required value="1">
            <label class="form-check-label" for="1">販売中</label>
            <br>
            <input type="radio" name="is_active" class="form-check-input" id="0" required value="0">
            <label class="form-check-label" for="0">販売中止</label>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
        <button type="button" onclick="history.back()" class="btn btn-secondary text-light">戻る</button>
    </form>
@endsection
