@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.post-category.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Post Category Update form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.post-category.update', $postCategory) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- confused --}}
                            <div class="form-group">
                                <label for="exampleInputEmail3">Parent</label>
                                <select class="form-group form-control" name="parent">
                                    <optgroup label="Custom">
                                        <option value="" {{ old('parent', $postCategory->parent) == "" ? 'selected' : '' }}>
                                            -- None --</option>
                                    </optgroup>
                                    <optgroup label="Relationship">
                                        <option class="form-group" value="1" {{ old('parent', $postCategory->parent) == "1" ? 'selected' : '' }}>Work</option>
                                        <option class="form-group" value="2" {{ old('parent', $postCategory->parent) == "2" ? 'selected' : '' }}>Life</option>
                                        <option class="form-group" value="3" {{ old('parent', $postCategory->parent) == "3" ? 'selected' : '' }}>Relationship</option>
                                        <option class="form-group" value="4" {{ old('parent', $postCategory->parent) == "4" ? 'selected' : '' }}>Fitness</option>
                                        <option class="form-group" value="5" {{ old('parent', $postCategory->parent) == "5" ? 'selected' : '' }}>Death</option>
                                        <option class="form-group" value="6" {{ old('parent', $postCategory->parent) == "6" ? 'selected' : '' }}>Uncategorized</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Order</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Order"
                                    name="order" value="{{ old('order', $postCategory->order) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Name of post category" name="name" value="{{ old('name', $postCategory->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Slug of post category" name="slug" value="{{ old('slug', $postCategory->slug) }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

