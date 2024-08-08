<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsuConta;
use App\Models\MovContaMovimentacao;
use Illuminate\Support\Facades\Auth;

class TelaInicialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Abaixo é buscado o id do usuário logado, que é o codumento CPF/CNPJ
        $loggedCodigo = intval(Auth::id());

        $Usu_Usuario = User::where('Usu_Codigo', $loggedCodigo)->first();

        $Usu_Conta = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

        $TotalEntradas = MovContaMovimentacao::selectRaw('sum(Mov_Valor) as valorTotal')
        ->whereRaw("Usu_CodigoDestino = $loggedCodigo")
        ->groupBy('Usu_CodigoDestino')
        ->first();

        $TotalSaidas = MovContaMovimentacao::selectRaw('sum(Mov_Valor) as valorTotal')
        ->whereRaw("Usu_CodigoOrigem = $loggedCodigo")
        ->groupBy('Usu_CodigoOrigem')
        ->first();

        return view('tela_inicial.index', ['TotalEntradas' => $TotalEntradas, 'TotalSaidas' => $TotalSaidas, 'Usu_Usuario' => $Usu_Usuario, 'Usu_Conta' => $Usu_Conta]);
    }
}
