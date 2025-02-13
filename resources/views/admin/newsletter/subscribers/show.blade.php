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
            <a href="{{ route('admin.newsletter.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Newsletter View page </h4>
                        <form class="forms-sample" method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                    name="email" value="{{ $newsletter->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="First Name"
                                    name="fname" value="{{ $newsletter->firstname }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Last Name"
                                    name="lname" value="{{ $newsletter->lastname }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Confirmed</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios2" value="yes" {{ $newsletter->confirmed == 'yes' ? 'checked' : '' }} disabled>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios1" value="no" {{ $newsletter->confirmed == 'no' ? 'checked' : '' }} disabled>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Subscribed</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios2" value="yes" {{ $newsletter->subscribed == 'yes' ? 'checked' : '' }} disabled>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios1" value="no" {{ $newsletter->subscribed == 'no' ? 'checked' : '' }} disabled>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
