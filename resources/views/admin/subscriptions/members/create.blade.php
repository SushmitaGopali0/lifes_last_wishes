@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.member.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Member Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.member.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="pageCategory">Email</label>
                                <select class="form-select" name="email" id="email">
                                    <option class="form-control" selected disabled>Select User Email</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}" {{ old('email') == $u->id ? 'selected' : '' }}>
                                            {{ $u->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Subscription Plan</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Code for the Coupon" name="code" value="{{ old('code') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Start Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail3" placeholder="Start Date"
                                    name="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">End Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail3" placeholder="End Date"
                                    name="end_date" value="{{ old('end_date') }}">
                            </div>

                            <div class="form-group">
                                <label for="inputDescription">Membership Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios2" value="active" checked=""
                                                {{ old('status') == 'active' ? 'checked' : '' }}>
                                            Active
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-info">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="canceled"
                                                {{ old('status') == 'canceled' ? 'checked' : '' }}>
                                            Canceled
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="expired"
                                                {{ old('status') == 'expired' ? 'checked' : '' }}>
                                            Expired
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-warning">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="pending"
                                                {{ old('status') == 'pending' ? 'checked' : '' }}>
                                            Pending
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <fieldset class="border p-3">
                                <legend class="w-auto px-2 mb-3">Payment Details:</legend>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Amount</label>
                                    <input type="number" class="form-control" id="exampleInputEmail3"
                                        placeholder="Discount" name="amount" value="{{ old('amount') }}">
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary me-2">Create</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
