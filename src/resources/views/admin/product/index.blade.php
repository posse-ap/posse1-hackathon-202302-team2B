@extends('layouts.app')

@section('content')
<nav class="pb-2 border-bottom navbar">
  <h2>プロダクト</h2>

  <ul class="nav justify-content-end gap-2 bg-light rounded">
    <li class="nav-item"><a href="" class="text-decoration-none text-dark">products</a></li>
    <li class="nav-item"><a href="{{ route('admin.drivers.index') }}" class="text-decoration-none text-dark">drivers</a></li>
    <li class="nav-item"><a href="{{route('admin.orders.index')}}" class="text-decoration-none text-dark">orders</a></li>
    <li class="nav-item"><a href="" class="text-decoration-none text-dark">sales</a></li>
    <li class="nav-item px-4"><a href="" class="text-decoration-none text-dark">users</a></li>
  </ul>
</nav>
<table class="table table-striped">
  <tr>
    <th>商品名</th>
    <th>商品説明</th>
    <th>写真</th>
    <th>1箱当たりの量</th>
    <th>割引率</th>
    <th>料金</th>
    <th>販売状況</th>
    <th>編集</th>
    <th>削除</th>
  </tr>
  @foreach($products as $product)
  <tr>
    <td>{{$product->name}}</td>
    <td>{{$product->description}}</td>
    <td>
      <img src=" {{asset('img/'.$product->image1)}} " alt="" width="75px" height="100%">
    </td>
    <td>{{$product->quantity}}</td>
    <td>{{$product->discount_rate}}</td>
    <td>{{$product->price}}</td>
    @if($product->is_active === 1)
    <td>販売中</td>
    @else
    <td>販売中止</td>
    @endif
    <td>
      <button class="btn btn-success">
        <a href="{{ route('admin.product.edit', ['id'=>$product->id]) }}" class="text-decoration-none text-light"> {{ __('編集') }} </a>
      </button>
    </td>
    <td>
      @method('DELETE')
      @csrf
      <button class="btn btn-danger">
        <a href="{{route('admin.product.destroy', ['id'=>$product->id])}}" class="text-decoration-none text-light">
          削除
        </a>
      </button>
    </td>
  </tr>
  @endforeach
</table>
<button class="btn btn-primary">
  <a href="{{route('admin.product.create')}}" class="text-decoration-none text-light">{{ __('新規作成') }}</a>
</button>
@endsection
