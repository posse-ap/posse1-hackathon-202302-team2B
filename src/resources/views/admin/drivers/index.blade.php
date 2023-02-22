@extends('layouts.app')

@section('content')
  <h1>一覧表示</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>会社名</th>
        <th>メールアドレス</th>
      </tr>
      @foreach($drivers as $driver)
      <tr>
        <td>{{$driver->id}}</td>
        <td>{{$driver->name}}</td>
        <td>{{$driver->company_name}}</td>
        <td>{{$driver->email}}</td>
        <td><a href="{{ route('drivers.edit', ['driver'=>$driver->id]) }}"> {{ __('編集') }} </a></td>
      </tr>
      @endforeach
    </table>
@endsection