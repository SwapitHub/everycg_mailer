<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Everycg Mailer </title>
    <!-- color-modes:js -->
    <script src="{{ asset('theme') }}/js/color-modes.js"></script>
    <!-- endinject -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="{{ asset('theme') }}/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/jquery-tags-input/jquery.tagsinput.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/dropzone/dropzone.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/dropify/dist/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/pickr/themes/classic.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('theme') }}/css/demo1/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('theme') }}/images/favicon.png">

    <!-- Google tag (gtag.js) -->
    <script async="" src="{{ asset('theme') }}/gtag/js?id=G-NXVN8PTKWG"></script>


    <link rel="stylesheet" href="{{ asset('theme') }}/vendors/sweetalert2/sweetalert2.min.css">

    	<link rel="stylesheet" href="{{ asset('theme') }}/vendors/easymde/easymde.min.css">

    <style>
        .spin {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>




    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NXVN8PTKWG');
    </script>

</head>

<body>
    <div class="main-wrapper">
        <!-- partial:partials/_sidebar.html -->
        {{-- sidenav here --}}
        @include('partials.sidebar')
        <!-- partial -->
        <div class="page-wrapper">
            <!-- partial:partials/_navbar.html -->
            {{-- headernav here --}}
            @include('partials.header')
            <!-- partial -->
            {{ $slot }}
            <!-- partial:partials/_footer.html -->
            {{-- footer here --}}
            @include('partials.footer')
            <!-- partial -->
        </div>
    </div>


    <!-- core:js -->
    <script src="{{ asset('theme') }}/vendors/core/core.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('theme') }}/vendors/jquery/jquery.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/inputmask/jquery.inputmask.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/dropzone/dropzone-min.js"></script>
    <script src="{{ asset('theme') }}/vendors/dropify/dist/dropify.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/pickr/pickr.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/moment/moment.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('theme') }}/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('theme') }}/js/app.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('theme') }}/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('theme') }}/js/form-validation.js"></script>
    <script src="{{ asset('theme') }}/js/bootstrap-maxlength.js"></script>
    <script src="{{ asset('theme') }}/js/inputmask.js"></script>
    <script src="{{ asset('theme') }}/js/select2.js"></script>
    <script src="{{ asset('theme') }}/js/typeahead.js"></script>
    <script src="{{ asset('theme') }}/js/tags-input.js"></script>
    <script src="{{ asset('theme') }}/js/dropzone.js"></script>
    <script src="{{ asset('theme') }}/js/dropify.js"></script>
    <script src="{{ asset('theme') }}/js/pickr.js"></script>
    <script src="{{ asset('theme') }}/js/flatpickr.js"></script>
    <!-- End custom js for this page -->
    <script src="{{ asset('theme') }}/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('theme') }}/js/custom.js"></script>
    <script src="{{ asset('theme') }}/js/sweet-alert.js"></script>


    <script src="{{ asset('theme') }}/vendors/easymde/easymde.min.js"></script>
    <!-- End plugin js for this page -->


    <!-- Custom js for this page -->
    <script src="{{ asset('theme') }}/js/email.js"></script>

    @stack('scripts')
</body>

</html>
