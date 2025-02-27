@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.coupon.create') }}"><button type="button"
                        class="btn btn-primary btn-rounded btn-fw">Add
                        Coupon</button></a>
                        <a href="{{ route('admin.coupon.destroyall') }}" id="deleteAllSelectedRecord"><button type="button"
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
                        <h4 class="card-title">Coupon Table</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="ids" class="select_all"></th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Used count</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupon as $c)
                                    <tr id="delete_id{{ $c->id }}">
                                        <td><input type="checkbox" class="checkbox_item" name="ids"
                                                value="{{ $c->id }}"></td>
                                            <td>{{ $c->code }}</td>
                                            <td>{{ $c->discount }}</td>
                                            <td>{{ $c->start_date }}</td>
                                            <td>{{ $c->end_date }}</td>
                                            <td>{{ $c->used_count }}</td>
                                            <td>{{ ucfirst($c->status) }}</td>
                                            <td><a href="{{ route('admin.coupon.show', ['id' => $c->id]) }}">
                                                    <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                                </a>
                                                <a href="{{ route('admin.coupon.edit', ['id' => $c->id]) }}">
                                                    <i class="mdi mdi-pencil-box-outline"
                                                        style="font-size: 25px; color:green"></i>
                                                </a>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.coupon.destroy', ['id' => $c->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this coupon?')" style="background: none; border: none; padding: 0;">
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
                        {{ $coupon->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


