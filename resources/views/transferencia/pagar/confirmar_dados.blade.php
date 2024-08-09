@extends('adminlte::page')
@section('title', 'Confirmar Transferência')

@section('content')
    @if($errors->any())
       <div class="alert alert-danger">
           <ul>
               <h5><i class="icon fas fa-ban"></i>Ocorreu um erro!</h5>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
           </ul>
       </div>
    @endif
    <br>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-row">
                <div class="float-left">
                    <h5><i class="fas fa-exchange-alt"> </i> Confirmar dados da Transferência</h5>
                </div>
                <div class="float-right">
                    <a href="{{url('transferencia')}}" class="btn" style="margin-left: 5px; border-radius: 5px; border-width: 2px; background-color: rgb(97, 95, 95); color: white; box-shadow: 3px 3px 5px rgb(68, 67, 67)">
                        <i class="fas fa-reply"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/transferencia/enviar') }}" id="my-form" method="POST" class="form-horizontal">
            @csrf
            <div class="card" style="border-color: grey; box-shadow: 2px 2px 4px rgb(112, 112, 112)">
                <p>{{$message}} - Confirme os dados abaixo para concluir a operação!</p>
                <div style="padding: 10px" class="form-group row">
                    <div class="col-sm-3">
                        <label  class="col-sm-12 col-form-label">CNPJ/CPF do Recebedor</label>
                        <input type="text" readonly required name="Usu_CodigoDestino" value="{{$Usu_Usuario->Usu_Codigo}}" class="form-control"/>
                    </div>
                    <div class="col-sm-5">
                        <label  class="col-sm-12 col-form-label">Nome do Recebedor</label>
                        <input type="text" readonly required name="Usu_NomeCompleto" value="{{$Usu_Usuario->Usu_NomeCompleto}}" class="form-control"/>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-sm-12 col-form-label">Valor R$</label>
                        <input type="text" readonly required name="Mov_Valor" id="Mov_Valor" value="{{$valorTransferencia}}" maxlength="20" size='23' maxlength='23' data-precision='2' data-thousands='.' data-decimal=',' autocomplete="off" class="form-control"/>
                    </div>
                </div>
            </div>

            <div style="margin-left: 5px" class="form-group row">
                <div class="float-left">
                    <button type="submit" id="submit-button" class="btn" style="border-radius: 5px; border-width: 2px; background-color: rgb(5, 136, 11); color: white; box-shadow: 3px 3px 5px rgb(112, 112, 112)">
                        <i class="far fa-save"></i>
                        Confirmar e Enviar
                        <span id="loading-icon" style="display: none;"> <i class="fa fa-spinner fa-spin"></i> </span>
                    </button>
                    <script>
                        document.getElementById('my-form').addEventListener('submit', function() {
                            var button = document.getElementById('submit-button');
                            var loadingIcon = document.getElementById('loading-icon');
                            button.disabled = true;
                            loadingIcon.style.display = 'inline-block';
                        });
                    </script>
                </script>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection

