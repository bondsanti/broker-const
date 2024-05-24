<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Broker Construction | @yield('title')</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('uploads/vbeicon.ico') }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Date -->
        <link rel="stylesheet" href="{{ asset('vendors/datepicker/css/bootstrap-datepicker.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css') }}">

        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/plugins/select2/css/select2.min.css') }}">

          <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/toastr/toastr.min.css') }}">

        <link rel="stylesheet" href="{{ asset('vendors/plugins/daterangepicker/daterangepicker.css') }}">

        <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/plugins/pace-progress/pace.css') }}">

        @stack('style')
    </head>

<body class="hold-transition sidebar-mini layout-fixed text-sm pace-primary">
    <div class="wrapper" class="">

        @include('layouts.top')

        @include('layouts.left')

        <div class="content-wrapper">

            @yield('content')

        </div>

        @include('layouts.footer')

    </div>
</body>

<!-- jQuery -->
@stack('script')

<script src="{{ asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('vendors/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('vendors/plugins/pace-progress/pace.min.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('vendors/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('vendors/plugins/sparklines/sparkline.js') }}"></script>

<script src="{{ asset('vendors/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('vendors/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('vendors/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('vendors/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('vendors/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('vendors/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('vendors/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('vendors/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendors/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendors/datepicker/locales/bootstrap-datepicker.th.min.js') }}"></script>

<script src="{{ asset('vendors/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendors/dist/js/adminlte.js') }}"></script>



</html>
