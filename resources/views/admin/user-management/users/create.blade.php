@extends('admin.layout.master')
@section('body')

<div class="container">
    <h2>Create New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role_id" required>
            <option value="">Select Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn">Create User</button>
    </form>
</div>
@endsection
