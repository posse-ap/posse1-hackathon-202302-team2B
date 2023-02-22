@extends('layouts.app')

@section('content')
  <nav class="pb-2 border-bottom navbar">
    <h2>ドライバーリスト</h2>
    
    <ul class="nav justify-content-end gap-2 bg-light rounded">
      <li class="nav-item"><a href="" class="text-decoration-none text-dark">products</a></li>
      <li class="nav-item"><a href="{{ route('drivers.index') }}" class="text-decoration-none text-dark">drivers</a></li>
      <li class="nav-item"><a href="" class="text-decoration-none text-dark">orders</a></li>
      <li class="nav-item"><a href="" class="text-decoration-none text-dark">sales</a></li>
      <li class="nav-item px-4"><a href="" class="text-decoration-none text-dark">users</a></li>
    </ul>
  </nav>
    <table class="table table-striped">
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>会社名</th>
        <th>メールアドレス</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      @foreach($drivers as $driver)
      <tr>
        <td>{{$driver->id}}</td>
        <td>{{$driver->name}}</td>
        <td>{{$driver->company_name}}</td>
        <td>{{$driver->email}}</td>
        <td>
          <button class="btn btn-success">
            <a href="{{ route('drivers.edit', ['driver'=>$driver->id]) }}" class="text-decoration-none text-light"> {{ __('編集') }} </a>
          </button>
        </td>
        <td>
          <form method="POST" action="{{route('drivers.destroy',['driver'=>$driver->id])}}" id="delete{{$loop->index}}">
            @method('DELETE')
            @csrf
            <button type="submit" form="delete{{$loop->index}}" class="btn btn-danger">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <button class="btn btn-primary">
            <a href="{{ route('drivers.create') }}" class="text-decoration-none text-light">{{ __('新規作成') }}</a>
          </button>
@endsection