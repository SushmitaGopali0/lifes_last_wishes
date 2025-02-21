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
            <a href="{{ route('admin.testimonial.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Testimonial View Page </h4>
                        <form class="forms-sample" method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="pageCategory">User Email</label>
                                <select class="form-control" name="email" id="email" disabled>
                                    <option class="form-control" selected disabled>Select User Email</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}"
                                            {{ old('email', $testimonial->user_id) == $u->id ? 'selected' : '' }}>{{ $u->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Title for the testimonial"
                                    name="title" value="{{ $testimonial->title }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Message</label>
                                <textarea class="form-control" id="exampleTextarea1" cols="30" rows="10" name="message" placeholder="Testimonial message" readonly>{{ $testimonial->message }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Job Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Job Title"
                                    name="job_title" value="{{ $testimonial->job_title }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Company</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Name of the company"
                                    name="company" value="{{ $testimonial->company }} " readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Website</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="User's website"
                                    name="website" value="{{ $testimonial->website }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="optionsRadios2" value="pending" {{ $testimonial->status == 'pending' ? 'checked' : '' }} disabled>
                                        Pending
                                        <i class="input-helper"></i></label>
                                </div>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="optionsRadios1" value="approved" {{ $testimonial->status == 'approved' ? 'checked' : '' }} disabled>
                                        Approved
                                        <i class="input-helper"></i></label>
                                </div>
                                </div>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ $testimonial->is_featured == 1 ? 'checked' : '' }} disabled>
                                    Is Featured
                                    <i class="input-helper"></i></label></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
