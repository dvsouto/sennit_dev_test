@extends('templates/authenticate')

@section('template')
    <form class="form-login">
        <h2>Entrar</h2>

        <input type="text" id="usuario-login" class="form-control" placeholder="Usuário" required autofocus />
        <input type="password" id="senha-login" class="form-control" placeholder="Senha" required />
        
{{--         <div class="checkbox">
            <label>
                <input type="checkbox" value="lembrar-login"> Lembrar
            </label>
        </div> --}}

        <button id="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">
            Login
        </button>
    </form>

    <div class="github-link">
        <a href="https://github.com/dvsouto/sennit_dev_test" target="_blank" >
            <i class="fa fa-github" aria-hidden="true"></i> Github
        </a>
    </div>
@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('script')
    <script>
        $("#btn-login").on('click', function(){
            window.location = "http://localhost/sennit_dev_test/front/public/project/home"
        });
    </script>
@endsection