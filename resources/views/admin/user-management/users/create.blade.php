@extends('admin.layout.master')

@section('body')
<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('users.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Store form </h4>
                    <form class="forms-sample" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail3">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="User Name"
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="User Email"
                                name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail3" placeholder="Password"
                                name="password">
                        </div>
                        <div class="form-group">
                            <label for="firstCategory">Roles</label>
                            <select class="form-select" name="category_first_level_id" id="firstCategory">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Create</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



