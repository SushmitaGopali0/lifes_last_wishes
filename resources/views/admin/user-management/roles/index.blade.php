@extends('admin.layout.master')
@push('css')
<link rel="stylesheet" href="{{asset('css/users.css')}}">
@endpush
@section('body')

<div class="container">
    <h2>Roles List</h2>

    <div style="margin-bottom: 15px;">
        <a href="{{ route('permissions.index') }}" class="btn-add">Add New</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}" class="btn-view">View</a>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn-edit">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-form" style="display:inline;">
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
