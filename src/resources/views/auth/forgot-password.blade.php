@extends('layouts.app')

@section('content')
    <div class="w-100 container-fluid">
        <div class="card text-center container" style="width: 300px;">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="card-header h5 text-white bg-primary">Password Reset</div>
                <div class="card-body px-5">
                    <div class="form-outline">
                        <input type="email" name="email" id="typeEmail" class="form-control my-3" />
                        <label class="form-label" for="typeEmail">Email input</label>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-primary" type="submit">send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
