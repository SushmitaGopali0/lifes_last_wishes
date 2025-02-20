@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.newsletter.create') }}"><button type="button"
                        class="btn btn-primary btn-rounded btn-fw">Add
                        Newsletter</button></a>
                        <a href="{{ route('admin.newsletter.destroyall') }}" id="deleteAllSelectedRecord"><button type="button"
                            class="btn btn-danger btn-rounded btn-fw">Delete All
                            Selected </button></a>
                        <a href="{{ route('admin.newsletter.export') }}"><button type="button"
                            class="btn btn-success btn-rounded btn-fw">Export Active Subscriber</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Newsletter Table</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="ids" class="select_all"></th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Confirmed</th>
                                        <th>Subscribed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsletter as $n)
                                    <tr id="delete_id{{ $n->id }}">
                                        <td><input type="checkbox" class="checkbox_item" name="ids"
                                                value="{{ $n->id }}"></td>
                                            <td>{{ $n->email }}</td>
                                            <td>{{ $n->firstname }}</td>
                                            <td>{{ $n->lastname }}</td>
                                            <td>{{ ucfirst($n->confirmed) }}</td>
                                            <td>{{ ucfirst($n->subscribed) }}</td>
                                            <td><a href="{{ route('admin.newsletter.show', ['id' => $n->id]) }}">
                                                    <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                                </a>
                                                <a href="{{ route('admin.newsletter.edit', ['id' => $n->id]) }}">
                                                    <i class="mdi mdi-pencil-box-outline"
                                                        style="font-size: 25px; color:green"></i>
                                                </a>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.newsletter.destroy', ['id' => $n->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this newsletter?')" style="background: none; border: none; padding: 0;">
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
                        {{ $newsletter->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


