@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>New Password (optional)</label>
        <input type="password" name="password">

        <label>Role</label>
        <select name="role_id" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->display_name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn">Update User</button>
    </form>
</div>
@endsection
