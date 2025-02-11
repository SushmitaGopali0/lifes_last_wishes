@extends('admin.layout.master')
@section('body')

<div class="col-md-6">
    <div class="card-body">
        <div class="template-demo">
            <a href="{{ route('admin.user-management.index') }}"><button type="button" class="btn btn-light btn-rounded btn-fw">←Back</button></a>
        </div>
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.user-management.store') }}">
                            @csrf
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
