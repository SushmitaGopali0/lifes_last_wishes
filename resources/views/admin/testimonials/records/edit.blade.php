@extends('admin.layout.master')
@section('body')

<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('admin.testimonial.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Testimonial Update form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.testimonial.update', $testimonial) }}">
                            @csrf
                            @method('PUT')
                            {{-- email of the user(need to extract user email and display it in dropdown) --}}
                            <div class="form-group">
                                <label for="exampleInputEmail3">User Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="User Email"
                                    name="email" value="{{ old('email', $testimonial->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Title for the testimonial"
                                    name="title" value="{{ old('title', $testimonial->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Message</label>
                                <textarea class="form-control" id="exampleTextarea1" cols="30" rows="10" name="message" placeholder="Testimonial message">{{ old('message', $testimonial->message) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Job Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Job Title"
                                    name="job_title" value="{{ old('job_title', $testimonial->job_title) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Company</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Name of the company"
                                    name="company" value="{{ old('company', $testimonial->company) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Website</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="User's website"
                                    name="website" value="{{ old('website', $testimonial->website) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="optionsRadios2" value="pending" {{ old('status', $testimonial->status) == 'pending' ? 'checked' : '' }}>
                                        Pending
                                        <i class="input-helper"></i></label>
                                </div>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="optionsRadios1" value="approved" {{ old('status', $testimonial->status) == 'approved' ? 'checked' : '' }}>
                                        Approved
                                        <i class="input-helper"></i></label>
                                </div>
                                </div>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_feaured',$testimonial->is_featured) == 1 ? 'checked' : '' }}>
                                    Is Featured
                                    <i class="input-helper"></i></label></label>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
