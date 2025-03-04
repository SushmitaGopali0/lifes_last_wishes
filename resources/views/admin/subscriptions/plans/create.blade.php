@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.plan.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Subscription plan Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.plan.store') }}">
                            @csrf
                            <!-- Hidden fields for parent_id and type -->
                            <input type="hidden" name="parent_id" value="{{ isset($plan) ? $plan->parent_id : '' }}" />
                            <input type="hidden" name="type"
                                value="{{ isset($plan) ? ($plan->type == 'Renewal' ? 'Renewal' : 'General') : 'General' }}" />

                            <div class="form-group">
                                <label for="exampleInputEmail3">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the Subscription" name="title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                                <textarea class="form-control" id="exampleTextarea1" cols="30" rows="10" name="description"
                                    placeholder="Subscription description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Duration</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <input type="number" class="form-control" id="exampleInputEmail3"
                                        placeholder="Duration" name="duration" value="{{ old('duration') }}">
                                    <div class="col-md-1 no-padding-center">
                                        <input type="text" class="form-control" id="discount_percentage"
                                            name="discount_percentage" value="days" readonly
                                            style="text-align: center; font-weight: 700;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Price</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Price"
                                        name="price" value="{{ old('price') }}">
                                    <div class="col-md-1 no-padding-center">
                                        <input type="text" class="form-control" id="discount_percentage"
                                            name="discount_percentage" value="AUD" readonly
                                            style="text-align: center; font-weight: 700;">
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
                                                {{ old('status') == 'active' ? 'checked' : '' }}>
                                            Active
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="inactive"
                                                {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                            Inactive
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
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
