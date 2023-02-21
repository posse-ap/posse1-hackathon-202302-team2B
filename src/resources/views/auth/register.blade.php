@extends('layouts.app')

@section('content')
    <div class="auth-register">
        <form action="{{ route('register.post') }}" method="POST" class="max-width-800-center">
            @csrf
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="inputName">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name') }}" placeholder="豊洲 太郎" required autofocus>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="inputEmail">メールアドレス</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="inputCompanyName">会社名</label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="inputCompanyName" name="company_name" value="{{ old('company_name') }}" placeholder="会社名" required>
                    @error('company_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12 col-lg-6">
                    <label for="inputPassword">パスワード</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" placeholder="パスワード" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="inputPasswordConfirmation">パスワード確認</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" name="password_confirmation" placeholder="パスワード確認" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-green">登録</button>
        </form>
    </div>
@endsection