@extends('admin.layout.master')

@section('body')

<div class="container">
    <h2>Users List</h2>
    <a href="{{ route('users.create') }}" class="btn">Add New User</a>

    @if(session('success'))
        <p class="alert">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->display_name }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn-view">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
