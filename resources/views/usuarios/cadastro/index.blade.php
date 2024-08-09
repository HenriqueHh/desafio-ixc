@extends('adminlte::page')
@section('title', 'Cadastro de Usuário')

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
    @if (Session::has('mensagem_sucesso'))
        <div class="alert alert-success">
            <h4 class="alert-heading"><i class="fas fa-check" style="padding-right: 5px"></i>Sucesso!</h4>
            <hr>{{Session::get('mensagem_sucesso')}}
        </div>
    @endif
    @if (Session::has('mensagem_cliente_existe'))
        <div class="alert alert-primary">
            <h4 class="alert-heading"><i class="fas fa-ban" style="padding-right: 5px"></i>Aviso!</h4>
            <hr>{{Session::get('mensagem_cliente_existe')}}
        </div>
    @endif
    @if (Session::has('mensagem_erro'))
        <div class="alert alert-danger">
            <h4 class="alert-heading"><i class="fas fa-ban" style="padding-right: 5px"></i>Ocorreu um erro!</h4>
        <hr>{{Session::get('mensagem_erro')}}
        </div>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5><i class="fas fa-plus"></i> <i class="far fa-user"></i> Cadastro de Usuário</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/novo-usuario/salvar') }}" id="formCadastro" method="POST" class="form-horizontal">
            @csrf
            <div class="card" >
                <div style="padding: 10px" class="form-group row">
                    <div class="col-sm-2">
                        <label class="col-sm-12 col-form-label">Tipo de Pessoa</label>
                        <select required name="Usu_TipoPessoa" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option value="F">Pessoa Física</option>
                            <option value="J">Pessoa Jurídica</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-sm-12 col-form-label">CPF/CNPJ *</label>
                        <input type="text" required name="Usu_Codigo" id="Usu_Codigo" maxlength="18" autocomplete="off" class="form-control cnpj"/>
                    </div>
                    @include('includes.formatar_documento')
                    <div class="col-sm-4">
                        <label class="col-sm-12 col-form-label">Nome Completo *</label>
                        <input type="text" required name="Usu_NomeCompleto" maxlength="60" autocomplete="off" class="form-control"/>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12 col-form-label">E-mail *</label>
                        <input type="email" required name="Usu_Email" maxlength="255" autocomplete="off" class="form-control"/>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12 col-form-label">Senha *</label>
                        <input type="password" required name="password" maxlength="50" autocomplete="off" class="form-control"/>
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
            <script>
                function validarUF() {
                    var ufInput = document.getElementById('buscaEstado');
                    var ufValue = ufInput.value.trim();

                    if (ufValue.length !== 2) {
                        alert('Você deve digitar o nome da cidade e selecionar ela, para que o campo UF busque de forma automática.');
                        formCadastro.busca.focus();
                        // formCadastro.busca.onfocus = function() {
                        //     this.style.border = '1px solid red';
                        // };

                        return false; // Impede o envio do formulário
                    }
                    // Exibir a mensagem de salvamento
                    document.getElementById('mensagemSalvando').style.display = 'block';
                    $('button[type="submit"]').prop('disabled', true);
                    return true; // Permite o envio do formulário

                }
            </script>
        </form>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {

           $('#TotalPedido').maskMoney();

        })
    </script>
@endsection

