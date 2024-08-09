<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UsuConta;
use App\Models\MovContaMovimentacao;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MovimentacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        // Abaixo é buscado o id do usuário logado, que é o codumento CPF/CNPJ
        $loggedCodigo = intval(Auth::id());

        $Usu_Usuario = User::where('Usu_Codigo', $loggedCodigo)->first();
        $Usu_Conta = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

        $Mov_ContaMovimentacao = MovContaMovimentacao::whereRaw("Usu_CodigoDestino = $loggedCodigo OR Usu_CodigoOrigem = $loggedCodigo and Mov_Status = 'F'")
        ->orderBy('Mov_Data', 'desc')
        ->get();

        return view('movimentacao.index', ['Mov_ContaMovimentacao' => $Mov_ContaMovimentacao, 'Usu_Usuario' => $Usu_Usuario, 'Usu_Conta' => $Usu_Conta]);

    }

    public function gerarRelatorio(){

        $loggedCodigo = intval(Auth::id());

        $Usu_Usuario = User::where('Usu_Codigo', $loggedCodigo)->first();
        $Usu_Conta = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

        $Mov_ContaMovimentacao = MovContaMovimentacao::whereRaw("Usu_CodigoDestino = $loggedCodigo OR Usu_CodigoOrigem = $loggedCodigo and Mov_Status = 'F'")
        ->orderBy('Mov_Data', 'desc')
        ->get();

        $DataAtual = date('d/m/Y');

        $pdf = Pdf::loadView('movimentacao.relatorio.index',
        [   'Usu_Usuario' => $Usu_Usuario,
            'Usu_Conta' => $Usu_Conta,
            'DataAtual' => $DataAtual,
            'Mov_ContaMovimentacao' => $Mov_ContaMovimentacao,
        ]);

        return $pdf->download('Movimentação de Conta.pdf');
    }
}
