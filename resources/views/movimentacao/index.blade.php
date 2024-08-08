@extends('adminlte::page')
@section ('plugins.Datatables', true )
@section('title', 'Movimentações')
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
                    <h5><i class="fas fa-exchange-alt"> </i> Histórico de Movimentações</h5>
                    <label class="col-sm-12 col-form-label">@include('includes.saldo_total')</label>
                </div>
                <div class="float-right">
                    <a href="{{url('movimentacao_relatorio')}}" class="btn" target="black" style="margin-left: 5px; border-radius: 5px; border-width: 2px; background-color: rgb(97, 95, 95); color: white; box-shadow: 3px 3px 5px rgb(68, 67, 67)">
                        <i class="fas fa-print"></i> Imprimir em PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body" style="text-align: center; background-color: white; margin-top: 5px; border-radius: 10px">
            <div style="padding: 5px" class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-hover display nowrap" id="ListBanco">
                        <thead>
                           <tr>
                                <th scope="col">Origem</th>
                                <th scope="col">Destino</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Mov_ContaMovimentacao as $item)

                                <tr
                                    @if ($item->Usu_CodigoOrigem == $Usu_Usuario->Usu_Codigo)
                                        style="color: red"
                                    @else
                                        style="color: blue"
                                    @endif
                                >
                                    <td scope="col">{{$item->UsuarioOrigem->Usu_NomeCompleto}}</td>
                                    <td scope="col">{{$item->UsuarioDestino->Usu_NomeCompleto}}</td>
                                    <td scope="col">R$ {{number_format($item->Mov_Valor,2,',','.')}}</td>
                                    <td scope="col">{{date('d/m/Y', strtotime($item->Mov_Data))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#ListBanco').DataTable( {
                "scrollX": true,
                "aaSorting": [[3, "desc"]],
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de MAX registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    },
                    "buttons": {
                        "copy": "Copiar para a área de transferência",
                        "copyTitle": "Cópia bem sucedida",
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        }
                    }
                }
            } );
        });
    </script>

@endsection
