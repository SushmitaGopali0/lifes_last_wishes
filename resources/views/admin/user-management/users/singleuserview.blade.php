@extends('admin.layout.master')

@section('body')
<div class="container">
    <h2>User Details</h2>

    <div class="user-info">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role->display_name }}</p>
    </div>

    <a href="{{ route('users.index') }}" class="btn">Back to Users</a>
    <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
