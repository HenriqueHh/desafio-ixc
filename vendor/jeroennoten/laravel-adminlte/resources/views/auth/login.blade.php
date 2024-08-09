@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', 'Faça login para iniciar sua sessão')

@section('auth_body')
<style>
    /* Adicione este estilo ao seu arquivo CSS */
    .btn-loading {
        position: relative;
    }

    .btn-loading .btn-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
    }

    .btn-loading.loading .btn-text {
        visibility: hidden;
    }

    .btn-loading.loading .btn-spinner {
        display: inline-block;
    }

    /* Adicione o estilo para o efeito de tremer */
    .shake {
        animation: shake 0.5s;
    }

    @keyframes shake {
        10%, 90% {
            transform: translateX(-5px);
        }
        20%, 80% {
            transform: translateX(5px);
        }
        30%, 50%, 70% {
            transform: translateX(-10px);
        }
        40%, 60% {
            transform: translateX(10px);
        }
    }
</style>
<form action="{{ $login_url }}" method="post">
    @csrf

    {{-- NomeLogin field --}}
    <div id="login-card" class="input-group mb-3">
        <input type="text" name="Usu_Email" class="form-control @error('Usu_Email') is-invalid @enderror"
               value="{{ old('Usu_Email') }}" placeholder="Usuário" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('Usu_Email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>


    {{-- Password field --}}
    <div id="login-cardd" class="input-group mb-3">
        <input type="password" name="password" class="form-control password-toggle @error('password') is-invalid @enderror"
           placeholder="Senha">
        <div class="input-group-append">
            <span class="input-group-text password-toggle-icon">
                <i class="fas fa-eye-slash"></i>
            </span>
        </div>

        @if (Session::has('mensagem_inativo'))
            <p style="color: red">{{Session::get('mensagem_inativo')}}</p>
        @endif
        @if (Session::has('mensagem_deletado'))
            <p style="color: red">{{Session::get('mensagem_deletado')}}</p>
        @endif
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <script>
        $(document).ready(function() {
            $('.password-toggle-icon').click(function() {
                var passwordField = $('.password-toggle');
                var fieldType = passwordField.attr('type');
                var icon = $(this).find('i');

                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fas fa-eye-slash').addClass('fas fa-eye');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fas fa-eye').addClass('fas fa-eye-slash');
                }
            });
        });
    </script>

    {{-- Login field --}}
    <div class="text-center">
        <button type="submit" class="btn btn-loading" style="width:100%; border-radius: 5px; border-width: 2px; background-color: rgb(39, 83, 228); color: white; box-shadow: 3px 3px 5px rgb(112, 112, 112)">
            <span class="btn-text">
                <span class="fas fa-sign-in-alt"></span>
                Entrar
            </span>
            <span class="btn-spinner">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
        <script>
            // Quando o formulário for enviado, ativa o estado de carregamento no botão
            document.querySelector('form').addEventListener('submit', function () {
                var btn = document.querySelector('.btn-loading');
                btn.classList.add('loading');
            });
        </script>
        @if (Session::has('mensagem_sucesso'))
            <div style="margin-top: 10px" class="alert alert-success">
                <h4 class="alert-heading"><i class="fas fa-check" style="padding-right: 5px"></i>Sucesso!</h4>
                <hr>{{Session::get('mensagem_sucesso')}}
            </div>
        @endif

        {{-- Se a variável $message estiver presente, adiciona a classe shake ao card --}}
        @if (Session::has('mensagem_inativo') || Session::has('mensagem_deletado'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var loginCard = document.getElementById('login-card');
                    loginCard.classList.add('shake');

                    var loginCardd = document.getElementById('login-cardd');
                    loginCardd.classList.add('shake');
                });
            </script>
        @endif
    </div>
</form>

    <div style="margin-top: 25px; " class="text-center">
        <hr style="background-color: rgb(209, 206, 206)">
    </div>


    {{-- Pedido Assistencia botão --}}
    <div class="text-center">
        <a type="button" href="{{url('novo-usuario')}}" class="btn btn-ass" style="margin-top: 10px; width:100%; border-radius: 5px; border-width: 2px; background-color: rgb(114, 112, 112); color: white; box-shadow: 3px 3px 5px rgb(112, 112, 112)" onclick="showSpinner()">
            <span id="loadingIndicatorBtn" class="btn-text">
                Cadastro
            </span>
            <span id="loadingIndicator" class="btn-spinner" style="display: none;">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </a>
    </div>

    <script>
        function showSpinner() {
            var button = document.querySelector('.btn');
            // var spinner = button.querySelector('.btn-spinner');
            var spinner = document.querySelector('#loadingIndicator');
            var loadingIndicatorBtn = document.querySelector('#loadingIndicatorBtn');

            loadingIndicatorBtn.style.display = 'none'; // Desabilita o botão para evitar cliques repetidos
            button.style.pointerEvents = 'none'; // Desabilita o botão para evitar cliques repetidos
            spinner.style.display = 'inline-block';

            // Simule um atraso para mostrar o spinner por um tempo
            setTimeout(function () {
                button.style.pointerEvents = 'auto'; // Habilita o botão novamente
                spinner.style.display = 'none';
            }, 2000); // Tempo em milissegundos (aqui definido como 2 segundos)
        }
    </script>


@stop


@section('auth_footer')
    {{-- Password reset link --}}
    {{-- @if($password_reset_url)
        <p class="my-0">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif --}}

    {{-- Register link --}}
    {{-- @if($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif --}}
@stop
