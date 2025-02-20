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

    <!-- toastr css -->
    <link rel="stylesheet" href="/css/toastr.min.css">
    <link href="{{ asset('toastcss.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{asset('css/users.css')}}"> --}}

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

    <!-- toastr -->
    <script src="/js/toastr.min.js" type="text/javascript"></script>
    <script src="{{ asset('toastjs.js') }}"></script>
    <script src="{{ asset('select-all.js') }}"></script>

    @stack('js')

    <script>
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // Position of the toast message
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300", // Show duration in milliseconds
        "hideDuration": "1000", // Hide duration in milliseconds
        "timeOut": "5000", // Time the toast stays visible (milliseconds)
        "extendedTimeOut": "1000", // Additional time after mouse hover (milliseconds)
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn", // Show method
        "hideMethod": "fadeOut" // Hide method
    };
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function () {
            // When the select_all checkbox is clicked
            $('.select_all').on('change', function () {
                $('.checkbox_item').prop('checked', $(this).prop('checked'));
            });

            // If any checkbox is unchecked, uncheck the select_all checkbox
            $('.checkbox_item').on('change', function () {
                if ($('.checkbox_item:checked').length === $('.checkbox_item').length) {
                    $('.select_all').prop('checked', true);
                } else {
                    $('.select_all').prop('checked', false);
                }
            });
        });
    </script>

{{-- bulk delete --}}
<script>
    $(document).ready(function() {
        $('#deleteAllSelectedRecord').click(function(e) {
            e.preventDefault();

            var all_ids = [];
            $('input.checkbox_item:checked').each(function() {
                all_ids.push($(this).val());
            });

            if (all_ids.length === 0) {
                toastr.warning("Please select at least one data to delete.");
                return;
            }
            if (!confirm("Are you sure you want to delete all these entries?")) {
                    return;
                }

            $.ajax({
                type: "POST",
                data: {
                    ids: all_ids,
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.success);

                    // Remove deleted rows smoothly
                    $.each(all_ids, function(index, val) {
                        $('#delete_id' + val).fadeOut(500, function() {
                            $(this).remove();
                        });
                    });
                },
                error: function(xhr) {
                    toastr.error("Something went wrong: " + xhr.responseText);
                }
            });
        });
    });
</script>
</body>

</html>
