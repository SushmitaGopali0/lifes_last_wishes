@extends('admin.layout.master')
@push('css')
<style>
.form-check-input:disabled {
    opacity: 1 !important; /*Restore full opacity*/
    filter: none !important; /* Remove any default grayscale effect */
    cursor: not-allowed; /* Keep the disabled cursor */
}
</style>
@endpush
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.coupon.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Coupon View Page </h4>
                        <form class="forms-sample" method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Code</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Code for the Coupon" name="code" value="{{ old('code', $coupon->code) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                                <textarea class="form-control" id="exampleTextarea1" cols="30" rows="10" name="description"
                                    placeholder="Coupon description" readonly>{{ old('description', $coupon->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Discount</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <input type="number" class="form-control" id="exampleInputEmail3"
                                        placeholder="Discount" name="discount" value="{{ old('discount', $coupon->discount) }}" readonly>
                                    <div class="col-md-1 no-padding-center">
                                        <input type="text" class="form-control" id="discount_percentage"
                                            name="discount_percentage" value="%" readonly style="text-align: center; font-weight: 700;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios2" value="active" checked=""
                                                {{ old('status', $coupon->status) == 'active' ? 'checked' : '' }} disabled>
                                            Active
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="inactive"
                                                {{ old('status', $coupon->status) == 'inactive' ? 'checked' : '' }} disabled>
                                            Inactive
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Start Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail3" placeholder="Start Date"
                                    name="start_date" value="{{ old('start_date', $coupon->start_date) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">End Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail3" placeholder="End Date"
                                    name="end_date" value="{{ old('end_date', $coupon->end_date) }}" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
