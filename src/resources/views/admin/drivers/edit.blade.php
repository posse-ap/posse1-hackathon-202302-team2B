@extends('layouts.app')

@section('content')
  <h1>編集</h1>

  <form method="POST" action="{{route('drivers.update',['driver' =>$driver->id])}}">
    @method('PATCH')
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">name</label>
      <input name="name" type="name" class="form-control" id="name" value="{{$driver->name}}">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$driver->email}}">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="compary_name" class="form-label">company_name</label>
      <input name="company_name" type="company_name" class="form-control" id="name" value="{{$driver->company_name}}">
    </div>
    <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">更新</button>
  <button class="btn btn-secondary"><a class="text-light text-decoration-none" href="{{route('drivers.index')}}"></a>戻る</a></button>
</form>
@endsection