@extends('admin.layout.master')
@section('body')

<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('admin.newsletter.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Newsletter Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.newsletter.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="First Name"
                                    name="fname" value="{{ old('fname') }}">
                                @error('fname')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Last Name"
                                    name="lname" value="{{ old('lname') }}">
                                @error('lname')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Confirmed</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios2" value="yes" checked="" {{ old('confirmed') == 'yes' ? 'checked' : '' }}>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios1" value="no" {{ old('confirmed') == 'no' ? 'checked' : '' }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                                @error('confirmed')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Subscribed</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios2" value="yes" checked="" {{ old('subscribed') == 'yes' ? 'checked' : '' }}>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios1" value="no" {{ old('subscribed') == 'no' ? 'checked' : '' }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                                @error('subscribed')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
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

