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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- Javascript --}}
    @include('templates.init-script')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
    <script src="{{ asset('js/angular-app.js') }}"></script>
    <script src="{{ asset('js/angular-controllers.js') }}"></script>

    @yield('header')
</head>
<body ng-app="app" ng-controller="AppController">
    <div id="full">
        <div class="container login-box">
            @yield('template')
        </div>
    </div>

    {{-- Javascript --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('script')
</body>
</html>