@extends('layouts.app')

@section('content')
  <h1>新規作成</h1>

  <form method="POST" action="{{route('drivers.store')}}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">name</label>
      <input name="name" type="name" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="compary_name" class="form-label" required>company_name</label>
      <input name="company_name" type="company_name" class="form-control" id="name">
    </div>
    <div class="mb-3">
      <label for="Password" class="form-label">Password</label>
      <input name="password" type="password" class="form-control" id="Password" required>
    </div>
    <div class="mb-3 d-none">
      <input name="role_id" type="role_id" class="form-control" id="role_id" value="3">
    </div>
    <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">登録</button>
  <button class="btn btn-secondary"><a class="text-light text-decoration-none" href="{{route('drivers.index')}}"></a>戻る</a></button>
</form>
@endsection