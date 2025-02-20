@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.post.create') }}"><button type="button"
                        class="btn btn-primary btn-rounded btn-fw">Add
                        Post </button></a>
                        <a href="{{ route('admin.post.destroyall') }}" id="deleteAllSelectedRecord"><button type="button"
                            class="btn btn-danger btn-rounded btn-fw">Delete All
                            Selected </button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Post Table</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="ids" class="select_all"></th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $p)
                                    <tr id="delete_id{{ $p->id }}">
                                        <td><input type="checkbox" class="checkbox_item" name="ids"
                                                value="{{ $p->id }}"></td>
                                            <td>{{ ucfirst($p->title) }}</td>
                                            <td>{{ $p->slug }}</td>
                                            <td>{{ $p->category }}</td>
                                            <td>{{ $p->status }}</td>
                                            <td><a href="{{ route('admin.post.show', ['slug' => $p->slug]) }}">
                                                    <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                                </a>
                                                <a href="{{ route('admin.post.edit', ['slug' => $p->slug]) }}">
                                                    <i class="mdi mdi-pencil-box-outline"
                                                        style="font-size: 25px; color:green"></i>
                                                </a>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.post.destroy', ['slug' => $p->slug]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" style="background: none; border: none; padding: 0;">
                                                        <i class="mdi mdi-delete" style="font-size: 25px; color:red"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

