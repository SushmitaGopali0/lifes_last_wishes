@extends('admin.layout.master')
@push('css')
<link rel="stylesheet" href="{{asset('css/users.css')}}">
@endpush
@section('body')
<div class="container">
    <h2>Role Details</h2>

    <div class="role-info">
        <p><strong>ID:</strong> {{ $role->id }}</p>
        <p><strong>Name:</strong> {{ $role->name }}</p>
        <p><strong>Display Name:</strong> {{ $role->display_name }}</p>
    </div>

    <a href="{{ route('roles.index') }}" class="btn">Back to Roles</a>
</div>
@endsection
