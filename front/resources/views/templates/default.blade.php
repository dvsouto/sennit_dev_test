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
    {{-- Navbar --}}
    <nav id="navbar" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Dev Test</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="https://github.com/dvsouto/sennit_dev_test" target="_blank" >
                            <i class="fa fa-github" aria-hidden="true"></i> Github
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Davi Souto <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="appAbout()">Sobre</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" onclick="appLogout()">Sair</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div id="full">
        <div class="container content-box">
            @yield('template')
        </div>
    </div>

    {{-- Javascript --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')
</body>
</html>