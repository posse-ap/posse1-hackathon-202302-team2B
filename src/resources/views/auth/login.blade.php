@extends('layouts.app')

@section('content')
    <div class="auth-login">
        @foreach ($errors->all() as $error)
            <p class="text-danger text-center m-0">{{ $error }}</p>
        @endforeach
        <form action="{{ route('login.post') }}" method="POST" class="form-login">
            @csrf
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" value="{{ old('email') }}" placeholder="メールアドレス" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
            <div class="form-check my-1">
                <input type="checkbox" class="form-check-input" id="rememberToken" name="remember">
                <label class="form-check-label" for="rememberToken">ログイン状態を保存する</label>
            </div>
            <button type="submit" class="btn btn-lg btn-green btn-block">Sign in</button>
            <a class="d-block text-green" href="{{  route('register') }}">新規登録の方はこちら</a>
        </form>
    </div>
@endsection