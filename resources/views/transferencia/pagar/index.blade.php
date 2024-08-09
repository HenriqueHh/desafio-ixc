@extends('adminlte::page')
@section('title', 'Transferência')
@section('content')
<meta charset="UTF-8">
    <br>
    @if (Session::has('mensagem_sucesso'))
        <div class="alert alert-success">
            <h4 class="alert-heading"><i class="fas fa-check" style="padding-right: 5px"></i>Sucesso!</h4>
            <hr>{{Session::get('mensagem_sucesso')}}
        </div>
    @endif
    @if (Session::has('mensagem_saldo_insuficiente'))
        <div class="alert alert-warning">
            <h4 class="alert-heading"><i class="fas fa-ban" style="padding-right: 5px"></i>Saldo Insuficiente!</h4>
            <hr>{{Session::get('mensagem_saldo_insuficiente')}}
        </div>
    @endif
    @if (Session::has('mensagem_erro'))
        <div class="alert alert-danger">
            <h4 class="alert-heading"><i class="fas fa-ban" style="padding-right: 5px"></i>Ocorreu um erro!</h4>
            <hr>{{Session::get('mensagem_erro')}}
            @include('includes.modal_erro_detalhes')
        </div>
    @endif

    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-row">
                <div class="float-left">
                    <h5><i class="fas fa-exchange-alt"> </i> Realizar Transferência</h5>
                </div>
                <div class="float-right row">

                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/transferencia/confirmar-dados') }}" id="formCadastro" method="POST" class="form-horizontal">
            @csrf

            <div class="card" style="border-color: grey; box-shadow: 2px 2px 4px rgb(112, 112, 112)">
                <div style="padding: 10px" class="form-group row">

                    <div class="col-sm-5">
                        <label class="col-sm-12 col-form-label">CNPJ/CPF Recebedor *</label>
                        <input type="text" required name="Usu_CodigoDestino" autofocus="on" autocomplete="off" placeholder="Digite o CNPJ/CPF" class="form-control cnpj" maxlength="18"/>
                    </div>
                    @include('includes.formatar_documento')
                    <div class="col-sm-3">
                        <label class="col-sm-12 col-form-label">Valor R$ *</label>
                        <input type="text" required name="Mov_Valor" id="Mov_Valor" maxlength="20" size='23' maxlength='23' data-precision='2' data-thousands='.' data-decimal=',' autocomplete="off" class="form-control"/>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-sm-12 col-form-label">Meu Saldo:</label>
                        <label class="col-sm-12 col-form-label">@include('includes.saldo_total')</label>
                    </div>
                </div>
            </div>

            <div style="margin-left: 5px" class="form-group row">
                <div class="float-left">
                    <button type="submit" class="btn" style="border-radius: 5px; border-width: 2px; background-color: rgb(5, 136, 11); color: white; box-shadow: 3px 3px 5px rgb(112, 112, 112)">
                        <i class="far fa-save"></i>
                        Confirmar
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($){

           $('#Mov_Valor').maskMoney();

        })
    </script>
@endsection

