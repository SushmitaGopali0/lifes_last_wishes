@extends('admin.layout.master')
@section('body')

<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('admin.page-category.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Page Category Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.page-category.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Name of page category"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Slug of page category"
                                    name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
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

