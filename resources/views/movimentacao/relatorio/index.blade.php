

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

</head>

    <table cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
            <tr>
               <td rowspan="2"><h3 style="text-align:center; font-family: Tahoma,Arial; font-size: 25px; "><b>Relatório de Movimentação Completa</b></td>
                <td style="text-align:right; font-family: Tahoma,Arial; font-size: 14px;"><h6>Data emissão: {{$DataAtual}}</h6></td>
            </tr>
            <tr>
                <td style="text-align:right; font-family: Tahoma,Arial; font-size: 14px;"><h6>Usuário: {{$Usu_Usuario->Usu_NomeCompleto}}</h6></td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%">
        <thead>
            <tr>
                <th style="text-align:center; font-family: Arial; font-size: 15px; border-bottom: 1px solid" scope="col">Origem</th>
                <th style="text-align:center; font-family: Arial; font-size: 15px; border-bottom: 1px solid" scope="col">Destino</th>
                <th style="text-align:center; font-family: Arial; font-size: 15px; border-bottom: 1px solid" scope="col">Valor</th>
                <th style="text-align:center; font-family: Arial; font-size: 15px; border-bottom: 1px solid" scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Mov_ContaMovimentacao as $item)
                <tr>
                    <td style="text-align:center; font-size: 13px; font-family: Arial; border-bottom: 1px solid;">{{$item->UsuarioOrigem->Usu_NomeCompleto}}</td>
                    <td style="text-align:center; font-size: 13px; font-family: Arial; border-bottom: 1px solid;">{{$item->UsuarioDestino->Usu_NomeCompleto}}</td>
                    <td style="text-align:center; font-size: 13px; font-family: Arial; border-bottom: 1px solid">
                        @if ($item->Usu_CodigoOrigem == $Usu_Usuario->Usu_Codigo)
                            -
                        @endif
                        R$ {{number_format($item->Mov_Valor,2,',','.')}}
                    </td>
                    <td style="text-align:center; font-size: 13px; font-family: Arial; border-bottom: 1px solid">{{date('d/m/Y', strtotime($item->Mov_Data))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
            <tr>
               <td rowspan="4"><b>Saldo Atual: R$ {{number_format($Usu_Conta->Usu_ContaSaldo,2,',','.')}}</b></td>
            </tr>
        </tbody>
    </table>
</html>
