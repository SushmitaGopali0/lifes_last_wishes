@extends('admin.layout.master')
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.testimonial.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Testimonial Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.testimonial.store') }}">
                            @csrf
                            {{-- email of the user(need to extract user email id and display it in dropdown) --}}
                            <div class="form-group">
                                <label for="exampleInputEmail3">User Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="User Email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title for the testimonial" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Message</label>
                                <textarea class="form-control" id="exampleTextarea1" cols="30" rows="10" name="message"
                                    placeholder="Testimonial message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Job Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Job Title"
                                    name="job_title" value="{{ old('job_title')}}">
                                @error('job_title')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Company</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Name of the company" name="company" value="{{ old('company') }}">
                                @error('company')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Website</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="User's website" name="website" value="{{ old('website') }}">
                                @error('website')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>

                                <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="optionsRadios2"
                                            value="pending" checked="" {{ old('status') == 'pending' ? 'checked' : '' }}>
                                        Pending
                                        <i class="input-helper"></i></label>
                                </div>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="optionsRadios1"
                                            value="approved" {{ old('status') == 'approved' ? 'checked' : '' }}>
                                        Approved
                                        <i class="input-helper"></i></label>
                                </div>
                                @error('status')
                                    <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    Is Featured
                                    <i class="input-helper"></i></label></label>
                                @error('is_featured')
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
