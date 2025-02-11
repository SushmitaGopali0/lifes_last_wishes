@extends('admin.layout.master')
@section('body')
<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('admin.testimonial.create') }}"><button type="button"
                    class="btn btn-primary btn-rounded btn-fw">Add
                    Testimonial</button></a>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Testimonial Table</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User Email</th>
                                    <th>Job Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
