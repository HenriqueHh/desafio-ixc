@extends('adminlte::page')
@section ('plugins.Datatables', true )
@section('content')
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    @if (Session::has('mensagem_erro'))
        <div class="alert alert-danger">{{Session::get('mensagem_erro')}}</div>
        <script type="text/javascript">
            $(document).ready(function(){
                toastr.error('Erro!')
            });
        </script>
    @endif

    @if (Session::has('mensagem_sucesso'))
        <div class="alert alert-success">{{Session::get('mensagem_sucesso')}}</div>
        <script type="text/javascript">
            $(document).ready(function(){
                toastr.success('Sucesso!')

            });
        </script>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-row">
                <div class="float-left">
                    <h5><i class="fa fa-home"></i> PÁGINA INICIAL, Bem-Vindo(a) {{$Usu_Usuario->Usu_NomeCompleto}}
                </div>
                <div class="float-right row">

                </div>
            </div>
        </div>
        <div class="card-body" style="text-align: center; background-color: white; margin-top: 5px; border-radius: 10px">
            <div class="row">
                <div style="box-shadow: 2px 2px 4px rgb(68, 67, 67)" class="col-sm-3 col-6 ">
                    <div class="description-block">
                        <span class="description-icons">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        @include('includes.saldo_total')
                        <span class="description-text">Meu Saldo</span>
                    </div>
                </div>
                @if(!is_null($TotalEntradas))
                    <div style="box-shadow: 2px 2px 4px rgb(68, 67, 67); color: green" class="col-sm-3 col-6 ">
                        <div class="description-block">
                            <span class="description-icons">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <h5 style="font-size: 20px" class="description-header">
                                <span >R$ {{ number_format($TotalEntradas->valorTotal, 2, ',', '.') }}</span>
                            </h5>
                            <span class="description-text">Total de Entradas</span>
                        </div>
                    </div>
                @endif
                @can('user-pessoa')
                    @if(!is_null($TotalSaidas))
                    <div style="box-shadow: 2px 2px 4px rgb(68, 67, 67); color: red" class="col-sm-3 col-6 ">
                        <div class="description-block">
                            <span class="description-icons">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <h5 style="font-size: 20px" class="description-header">
                                <span >R$ {{ number_format($TotalSaidas->valorTotal, 2, ',', '.') }}</span>
                            </h5>
                            <span class="description-text">Total de Saídas</span>
                        </div>
                    </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
@endsection
