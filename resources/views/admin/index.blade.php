@extends('admin.layout.master')
@section('body')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2>Welcome back,</h2>
                            <p class="mb-md-0">Your lifes last wishes dashboard.</p>
                        </div>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                            <i class="mdi mdi-download text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-plus text-muted"></i>
                        </button>
                        <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <ul class="nav nav-tabs px-4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                        </ul>
                        <div class="tab-content py-0 px-0">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                aria-labelledby="overview-tab">
                                <div class="d-flex flex-wrap justify-content-xl-between">
                                    <div
                                        class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                                        <div class="d-flex flex-column justify-content-around">
                                            <small class="mb-1 text-muted">Today's Date</small>
                                            <div>
                                                <?php
                                                // Set the timezone if needed
                                                date_default_timezone_set('UTC'); // Adjust the timezone as required

                                                // Get the current date
                                                $currentDate = date('d M Y'); // Format: 20 May 2024
                                                ?>
                                                <a class="btn btn-secondary p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                                                    href="#" role="button" id="dropdownMenuLinkA"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <h5 class="mb-0 d-inline-block"><?php echo $currentDate; ?></h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <a href="{{ route('admin.post.index') }}" style="text-decoration: none;"><i
                                                class="mdi mdi-content-save me-3 icon-lg text-danger"></i>
                                            <div class="d-flex flex-column justify-content-around">
                                                <small class="mb-1 text-muted">Total Post</small>
                                        </a>
                                        <h5 class="me-2 mb-0">{{ $post }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <a href="{{ route('admin.page.index') }}" style="text-decoration: none;"><i
                                            class="mdi mdi-book-open-page-variant me-3 icon-lg text-success"></i>
                                        <div class="d-flex flex-column justify-content-around">
                                            <small class="mb-1 text-muted">Total Page</small>
                                    </a>
                                    <h5 class="me-2 mb-0">{{ $page }}</h5>
                                </div>
                            </div>
                            <div
                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <a href="{{ route('users.index') }}" style="text-decoration: none;"><i
                                        class="mdi mdi-account-circle me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total User</small>
                                </a>
                                <h5 class="me-2 mb-0">{{ $user }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
