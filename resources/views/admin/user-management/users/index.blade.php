@extends('admin.layout.master')
@section('body')

<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('users.create') }}"><button type="button"
                    class="btn btn-primary btn-rounded btn-fw">Add
                    Users</button></a>
        </div>
    </div>
</div>
@if(session('success'))
        <p class="alert">{{ session('success') }}</p>
    @endif
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users Table</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                        <a href="{{ route('users.show', ['id' => $user->id]) }}">
                                            <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                        </a>
                                        <a href="{{ route('users.edit', ['id' => $user->id]) }}">
                                            <i class="mdi mdi-pencil-box-outline"
                                                style="font-size: 25px; color:green"></i>
                                        </a>
                                        <!-- Delete Form -->
                                        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" style="background: none; border: none; padding: 0;">
                                                <i class="mdi mdi-delete" style="font-size: 25px; color:red"></i>
                                            </button>
                                        </form>
                                        {{-- <a href="{{ route('users.show', $user->id) }}" class="btn-view">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
