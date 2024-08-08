@extends('adminlte::page')
@section('plugins.Datatables', true)

@section('title', 'Sem permissão - Finestra Móveis')

@section('content')
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header text-center">
                    <h5 class="mb-0">SEM PERMISSÃO PARA PROSSEGUIR</h5>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Desculpe, você não tem permissão para acessar esta página.</p>
                    <p class="text-muted">Caso esteja vendo essa página por engano, favor contate o administrador.</p>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        {{-- <p class="text-muted"> Finestra Indústria e Comércio de Madeiras LTDA.</p> --}}
                        <p class="text-muted"> Telefone: (49) 99918-7545 </p>
                        <p class="text-muted"> E-mail: henrique.hohn11@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('adminlte_css')
    <style>
        .card-default {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
        }

        .card-body {
            padding: 30px;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 20px;
        }
    </style>
@endsection

@section('adminlte_js')
    <!-- Adicione aqui qualquer script JS adicional específico para esta página -->
    <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
@endsection
