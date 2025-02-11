<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lifes Last Wishes | Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />

    @stack('css')

</head>

<body>
    <div class="container-scroller">
        <!--BEGIN partials/_navbar.html -->
        @include('admin.layout.partial.navbar')
        <!--END partials/_navbar.html -->

        <div class="container-fluid page-body-wrapper">
            <!--BEGIN partials/_sidebar.html -->
            @include('admin.layout.partial.sidebar')
            <!--END partials/_sidebar.html -->


            <div class="main-panel">
                {{-- BEGIN Body Section --}}
                @yield('body')
                {{-- END Body Section --}}

                <!-- BEGIN partials/_footer.html -->
                @include('admin.layout.partial.footer')
                <!-- END partials/_footer.html -->

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('backend/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('backend/js/chart.js') }}"></script>
    <!-- End custom js for this page-->

    @stack('js')

</body>

</html>
