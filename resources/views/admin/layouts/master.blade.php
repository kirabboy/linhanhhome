<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,700;0,900;1,400;1,500&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" type="text/css" src="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="url-home" content="{{ url('/') }}" />
    @stack('css')
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        @yield('content')
        <div class="modal-area">

        </div>
        @include('admin.layouts.footer')
    </div>
    <script src="{{ asset('public/admin/js/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/admin/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/admin/js/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/admin/js/js/demo.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('public/admin/js/chart.js/Chart.min.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script src="{{ asset('public/admin/toastr/toastr.min.js') }}"></script>
    @if (session('success') || (session('error') || $errors->any()))
        @include('admin.layouts.include.toastr');
    @endif
    @stack('script-plugin')

    <script src="{{ asset('public/admin/js/all.js') }}"></script>
    
    @stack('script')
</body>
