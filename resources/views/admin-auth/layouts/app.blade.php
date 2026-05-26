<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin') — Patrick Okeke</title>
    <link rel="icon" href="{{ asset('assets/website/favicon-po.svg') }}" type="image/svg+xml">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">
    @stack('styles')
    @stack('css')
</head>

<body class="hold-transition login-page sidebar-mini">

    @yield('content')

    <script src="{{ asset('admin/assets/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('admin/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icheck.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/demo.js') }}"></script>
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = { "closeButton": true, "progressBar": true }
            toastr.success("{{ session('message') }}");
        @endif
        @if (Session::has('error'))
            toastr.options = { "closeButton": true, "progressBar": true }
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.options = { "closeButton": true, "progressBar": true }
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.options = { "closeButton": true, "progressBar": true }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @stack('scripts')
    @stack('js')
</body>

</html>
