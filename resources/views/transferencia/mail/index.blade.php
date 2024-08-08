<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Transferência</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            color: #555555;
            text-align: center;
            margin-bottom: 30px;
        }

        .variable-list {
            margin-bottom: 20px;
        }

        .variable-list h2 {
            color: #333333;
            margin-bottom: 10px;
            border-bottom: 2px solid #333333;
            padding-bottom: 5px;
        }

        .variable-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .variable-list li {
            margin-bottom: 5px;
            color: #555555;
        }

        .variable-list li:before {
            content: '▸';
            color: #999999;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="variable-list">
            <ul>
                <h2>Comprovante da Transferência</h2>
                <li>Pagador: {{$transferencia->UsuarioOrigem->Usu_NomeCompleto}}</li>
                <li>Valor: R$ {{number_format($transferencia->Mov_Valor,2,',','.')}}</li>
                <li>Data: {{date('d/m/Y', strtotime($transferencia->Mov_Data))}}</li>
                <li>Destinatário: {{$transferencia->UsuarioDestino->Usu_NomeCompleto}}</li>
            </ul>
        </div>
    </div>
</body>
</html>
