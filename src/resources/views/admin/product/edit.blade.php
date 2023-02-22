@extends('layouts.app')

@section('content')
<h1>編集</h1>

<form method="POST" action="#">
  @method('PATCH')
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">商品名</label>
    <input name="name" type="name" class="form-control" id="name" value="{{$products->name}}">
  </div>
  <div class="mb-3 form-check">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">商品説明</label>
    <input name="description" type="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$products->description}}">
  </div>
  <div class="mb-3 form-check">
  </div>


  <div class="mb-3">
    <label for="image1" class="form-label">写真</label>
    <input name="image1" type="image1" class="form-control" id="image1" value="{{$products->image1}}">
  </div>
  <div class="mb-3 form-check">
  </div>


  <div class="mb-3">
    <label for="quantity" class="form-label">1箱当たりの量
    </label>
    <input name="quantity" type="quantity" class="form-control" id="quantity" value="{{$products->quantity}}">
  </div>
  <div class="mb-3 form-check">
  </div>


  <div class="mb-3">
    <label for="discount_rate" class="form-label">割引率</label>
    <input name="discount_rate" type="discount_rate" class="form-control" id="discount_rate" value="{{$products->discount_rate}}">
  </div>
  <div class="mb-3 form-check">
  </div>


  <div class="mb-3">
    <label for="price" class="form-label">料金</label>
    <input name="price" type="price" class="form-control" id="price" value="{{$products->price}}">
  </div>
  <div class="mb-3 form-check">
  </div>

  <div class="mb-3">
    <label for="is_active" class="form-label">販売状況</label>
    <input name="is_active" type="is_active" class="form-control" id="is_active" value="{{$products->is_active}}">
  </div>
  <div class="mb-3 form-check">
  </div>

  <button type="submit" class="btn btn-primary">
    <a href="{{ route('admin.product.index') }}" class="text-decoration-none text-light">
      更新する
    </a>
  </button>

  <button type="button" onclick="history.back()" class="btn btn-secondary text-light">戻る</button>
</form>
@endsection