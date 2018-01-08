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
                            <li><a href="#" ng-click="appAbout()">Sobre</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" ng-click="appLogout()">Sair</a></li>
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

    {{-- About Modal --}}
    <div id="about-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Sobre</h4>
                </div>
                <div class="modal-body">
                    <img class="img-about" src="https://avatars0.githubusercontent.com/u/16228821?s=460&v=4" alt="Davi Souto" width="100" height="100" />

                    <p class="text-center">
                        Desenvolvido por <strong>Davi Souto</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Javascript --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('script')
</body>
</html>