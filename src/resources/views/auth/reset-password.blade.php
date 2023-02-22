@extends('layouts.app')

@section('content')
<div class="w-100 container-fluid">
    <div class="card text-center container" style="width: 300px;">
        <div class="card-header h5 text-white bg-primary">Password Reset</div>
        <div class="card-body px-5">
            <p class="card-text py-2">
                Enter your email address and we'll send you an email with instructions to reset your password.
            </p>
            <div class="form-outline">
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="email" name="email" id="typeEmail" class="form-control my-3" />
                <input type="password" name="password" id="typeEmail" class="form-control my-3" />
                <input type="password" name="password_confirmation" id="typeEmail" class="form-control my-3" />
                <label class="form-label" for="typeEmail">Email input</label>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a class="" href="#">Register</a>
            </div>
        </div>
    </div>
</div>
@endsection
