@extends('layouts.app')

@section('content')
    <ul class="admin-index">
        <li><a href="{{ route('admin.product.index') }}">products</a></li>
        <li><a href="{{ route('admin.drivers.index') }}">drivers</a></li>
        <li><a href="{{ route('admin.orders.index') }}">orders</a></li>
    </ul>
@endsection