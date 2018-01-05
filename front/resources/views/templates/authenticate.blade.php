<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sennit Dev Test (Developed by Davi Souto)</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('header')
</head>
<body>
    <div id="full">
        <div class="container login-box">
            @yield('template')
        </div>
    </div>

    {{-- Javascript --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>