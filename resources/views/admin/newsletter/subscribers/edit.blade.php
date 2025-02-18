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
                        <h4 class="card-title">Newsletter Update form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.newsletter.update', $newsletter) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                    name="email" value="{{ old('email', $newsletter->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="First Name"
                                    name="fname" value="{{ old('fname', $newsletter->firstname) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Last Name"
                                    name="lname" value="{{ old('lname', $newsletter->lastname) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Confirmed</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios2" value="yes" {{ old('confirmed',$newsletter->confirmed) == 'yes' ? 'checked' : ''}}>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="confirmed" id="optionsRadios1" value="no" {{ old('confirmed', $newsletter->confirmed) == 'no' ? 'checked' : ''}}>
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
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios2" value="yes" {{ old('subscribed', $newsletter->subscribed) == 'yes' ? 'checked' : ''}}>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="subscribed" id="optionsRadios1" value="no" {{ old('subscribed', $newsletter->subscribed) == 'no' ? 'checked' : ''}}>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
