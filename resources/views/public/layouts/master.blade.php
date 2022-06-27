<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="url-home" content="{{ url('/') }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('custom.shortcut-icon')) }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/jquery.ui.slider.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/footer.css') }}">
    @stack('css')
</head>
<body>
    @include('public.layouts.header')
    @yield('content')
    @include('public.layouts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    @stack('script')
</body>
</html>
