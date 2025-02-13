@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.testimonial.create') }}"><button type="button"
                        class="btn btn-primary btn-rounded btn-fw">Add
                        Testimonial</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Testimonial Table</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonial as $t)
                                        <tr>
                                            <td>{{ $t->email }}</td>
                                            <td>{{ $t->title }}</td>
                                            <td>{{ ucfirst($t->status) }}</td>
                                            <td><a href="{{ route('admin.testimonial.show', ['id' => $t->id]) }}">
                                                    <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                                </a>
                                                <a href="{{ route('admin.testimonial.edit', ['id' => $t->id]) }}">
                                                    <i class="mdi mdi-pencil-box-outline"
                                                        style="font-size: 25px; color:green"></i>
                                                </a>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.testimonial.destroy', ['id' => $t->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this testimonial?')" style="background: none; border: none; padding: 0;">
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
                        {{ $testimonial->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

