@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                        <a href="{{ route('admin.payment-history.destroyall') }}" id="deleteAllSelectedRecord"><button type="button"
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
                        <h4 class="card-title">Payment Histroy Table</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="ids" class="select_all"></th>
                                        <th>Email</th>
                                        <th>Subscription Plan</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($plan as $p)
                                    <tr id="delete_id{{ $p->id }}">
                                        <td><input type="checkbox" class="checkbox_item" name="ids"
                                                value="{{ $p->id }}"></td>
                                            <td>{{ $p->title }}</td>
                                            <td>{{ "{$p->duration_length} {$p->duration_period}" }}</td>
                                            <td>{{ "{$p->price_amount} {$p->price_currency}" }}</td>
                                            <td>{{ $p->type }}</td>
                                            <td>{{ ucfirst($p->status) }}</td>
                                            <td><a href="{{ route('admin.plan.show', ['id' => $p->id]) }}">
                                                    <i class="mdi mdi-view-list" style="font-size: 25px; color:blue"></i>
                                                </a>
                                                <a href="{{ route('admin.plan.edit', ['id' => $p->id]) }}">
                                                    <i class="mdi mdi-pencil-box-outline"
                                                        style="font-size: 25px; color:green"></i>
                                                </a>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.plan.destroy', ['id' => $p->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this subscription plan?')" style="background: none; border: none; padding: 0;">
                                                        <i class="mdi mdi-delete" style="font-size: 25px; color:red"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{-- {{ $plan->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


