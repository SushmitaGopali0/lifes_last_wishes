@extends('admin.layout.master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1 !important;
            /*Restore full opacity*/
            filter: none !important;
            /* Remove any default grayscale effect */
            cursor: not-allowed;
            /* Keep the disabled cursor */
        }
    </style>
@endpush
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.payment-history.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Subscription member view page </h4>
                        <form class="forms-sample" method="POST" action="#">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="email"
                                    value="{{ old('email', $paymenthistory->email) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Subscription Plan</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title"
                                    value="{{ old('subscription_plan', $paymenthistory->subscription_plan) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Amount</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title"
                                    value="{{ old('amount', $paymenthistory->amount) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Transaction Id</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title"
                                    value="{{ old('transaction_id', $paymenthistory->transaction_id) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios2" value="active" checked=""
                                                {{ old('status', $plan->status) == 'active' ? 'checked' : '' }} disabled>
                                            Active
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="inactive"
                                                {{ old('status', $plan->status) == 'inactive' ? 'checked' : '' }} disabled>
                                            Inactive
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">IP Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title"
                                    value="{{ old('ip_address', $paymenthistory->ip_address) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Payment mode</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title"
                                    value="{{ old('payment_mode', $paymenthistory->payment_mode) }}" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
