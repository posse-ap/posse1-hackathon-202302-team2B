@extends('layouts.app')

@section('content')
    <ul class="admin-index">
        <li><a href="">products</a></li>
        <li><a href="{{ route('drivers.index') }}">drivers</a></li>
        <li><a href="{{ route('orders.index') }}">orders</a></li>
        <li><a href="">sales</a></li>
        <li><a href="">users</a></li>
    </ul>
@endsection