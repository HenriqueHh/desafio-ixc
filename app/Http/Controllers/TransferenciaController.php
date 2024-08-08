<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UsuConta;
use App\Models\MovContaMovimentacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\Mail\NovaTransferenciaMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TransferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if (Gate::allows('user-pessoa')) {
        } else {
            // comente os usuarios com a permissao user-pessoa podem acessar
            // O usuário não tem permissão, redirecione para outra tela de aviso
            return redirect()->route('sem_permissao');
        }

        // Abaixo é buscado o id do usuário logado, que é o codumento CPF/CNPJ
        $loggedCodigo = intval(Auth::id());

        $Usu_Usuario = User::where('Usu_Codigo', $loggedCodigo)->first();
        $Usu_Conta = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

        return view('transferencia.pagar.index', ['Usu_Usuario' => $Usu_Usuario, 'Usu_Conta' => $Usu_Conta]);

    }

    public function confirmarDadosTransferencia(Request $request){

        if (Gate::allows('user-pessoa')) {
        } else {
            // comente os usuarios com a permissao user-pessoa podem acessar
            // O usuário não tem permissão, redirecione para outra tela de aviso
            return redirect()->route('sem_permissao');
        }

        try{

            // Abaixo é buscado o id do usuário logado, que é o codumento CPF/CNPJ
            $loggedCodigo = intval(Auth::id());


            // remove todos os caracteres espeficicados e deixa somente os números.
            $UsuCodigoDestino = str_replace(['.', '/', '-'], '', $request->input('Usu_CodigoDestino'));
            $valorTransferencia = str_replace(['R$'], '', $request->input('Mov_Valor'));

            if($loggedCodigo == $UsuCodigoDestino){

                Session::flash('mensagem_erro', 'Não é possível realizar uma tranferência para a própria conta!');
                return redirect()->route('transferencia');

            }

            $Usu_Usuario = User::where('Usu_Codigo', $UsuCodigoDestino)->first();

            if(is_null($Usu_Usuario)){

                Session::flash('mensagem_erro', 'Não foi possível encontrar um usuário cadastrado com esse documento!');
                Session::flash('descricao_erro', 'Erro: Nenhm usuário cadastrado com o documento informado');
                return redirect()->route('transferencia');

            }

            // Verifica se o usuário de destino tem saldo suficiente para realizar a transferencia
            $VerificarSaldoOrigem = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

            if($VerificarSaldoOrigem->Usu_ContaSaldo < $valorTransferencia){

                Session::flash('mensagem_saldo_insuficiente', 'Desculpe, mas seu saldo é insuficiente para realizar essa operação!');
                return redirect()->route('transferencia');

            }

            $response = Http::get('https://66ad1f3cb18f3614e3b478f5.mockapi.io/v1/auth');

            if ($response->successful()) {
                $data = $response->json();

                // Acessar a mensagem específica
                $message = $data[0]['message'];

                if($message == 'Autorizado'){

                    return view('transferencia.pagar.confirmar_dados', ['valorTransferencia' => $valorTransferencia, 'Usu_Usuario' => $Usu_Usuario, 'message' => $message]);

                } else{

                    Session::flash('mensagem_erro', 'Não foi autorizada a transação!');
                    return redirect()->route('transferencia');
                }

            } else {
                // Tratar erros
                $status = $response->status();
                $error = $response->body();
                return response()->json(['error' => 'Failed to fetch data'], $status);
            }


        } catch (\Exception $e) {


            Session::flash('mensagem_erro', 'Ocorreu algum ao continuar. Favor tente novamente!');
            Session::flash('descricao_erro', 'Erro: ' . $e->getMessage());

            return redirect()->route('transferencia');

        }
    }

    public function realizarTransferencia(Request $request){

        if (Gate::allows('user-pessoa')) {
        } else {
            // O usuário não tem permissão, redirecione para outra tela de aviso
            return redirect()->route('sem_permissao');
        }

        // inicia a transação
        DB::beginTransaction();
        try{

            // Abaixo é buscado o id do usuário logado, que é o codumento CPF/CNPJ
            $loggedCodigo = intval(Auth::id());
            $UsuCodigoDestino = $request->input('Usu_CodigoDestino');
            $MovValor = $request->input('Mov_Valor');

            // Cria o histórico da movimentação, para log e registro
            $Mov_ContaMovimentacao = new MovContaMovimentacao();

            $Mov_ContaMovimentacao = $Mov_ContaMovimentacao->create(
                [
                    'Usu_CodigoOrigem' => $loggedCodigo,
                    'Mov_Valor' => $this->ConvertMoedaBD($MovValor),
                    'Mov_Status' => 'F', // Finalizada
                    'Mov_Data' => date('Y-m-d H:i:s'),
                    'Usu_CodigoDestino' => $UsuCodigoDestino,
                ]
            );

            // Altera o saldo da conta de origem
            $Usu_ContaOrigem = UsuConta::where('Usu_Codigo', $loggedCodigo)->first();

            $novoSaldoOrigem = $Usu_ContaOrigem->Usu_ContaSaldo - $this->ConvertMoedaBD($MovValor);

            $Usu_ContaOrigem = $Usu_ContaOrigem->update(
                [
                    'Usu_ContaSaldo' => $novoSaldoOrigem,
                ]
            );

            // Altera o saldo da conta de destino
            $Usu_ContaDestino = UsuConta::where('Usu_Codigo', $UsuCodigoDestino)->first();

            $novoSaldoDestino = $Usu_ContaDestino->Usu_ContaSaldo + $this->ConvertMoedaBD($MovValor);

            $Usu_ContaDestino = $Usu_ContaDestino->update(
                [
                    'Usu_ContaSaldo' => $novoSaldoDestino,
                ]
            );

            $this->enviaEmailComprovante($MovValor, $UsuCodigoDestino, $loggedCodigo, $Mov_ContaMovimentacao);

            DB::commit();

            Session::flash('mensagem_sucesso', 'Transferência realizada com Sucesso! Foi enviado no e-mail uma cópia do comprovante.');

            return redirect()->route('tela_inicial');

        } catch (\Exception $e) {
            // Em caso de erro, desfaz a transação e lida com a exceção
            DB::rollback();

            Session::flash('mensagem_erro', 'Ocorreu algum erro ao Salvar. Favor tente novamente!');
            Session::flash('descricao_erro', 'Erro: ' . $e->getMessage());

            return redirect()->route('transferencia');

        }
    }

    function enviaEmailComprovante($MovValor, $UsuCodigoDestino, $loggedCodigo, $Mov_ContaMovimentacao){

        $response = Http::get('https://66ad1f3cb18f3614e3b478f5.mockapi.io/v1/send');

        if ($response->successful()) {
            $data = $response->json();

            // Acessar a mensagem específica
            $message = $data[0]['message'];

            if($message == 'Notificação enviada'){

                // Mandar email para o usuario de origem e de destino
                $UsuarioOrigem = User::where('Usu_Codigo', $loggedCodigo)->first();
                $UsuarioDestino = User::where('Usu_Codigo', $UsuCodigoDestino)->first();

                // coloca os emails de destino no array para enviar junto, acima é buscado no banco os dois emails de origem e destino;
                $emails = [
                    trim($UsuarioOrigem->Usu_Email),
                    trim($UsuarioDestino->Usu_Email)
                ];
                // função do laravel para enviar emails
                mail::to($emails)->send(new NovaTransferenciaMail($Mov_ContaMovimentacao));

            } else{

                Session::flash('mensagem_erro', 'Não foi possível enviar o e-mail!');
                return redirect()->route('transferencia');
            }

        } else {

            $status = $response->status();
            $error = $response->body();
            return response()->json(['error' => 'Failed to fetch data'], $status);
        }
    }

    public function ConvertMoedaBD($value){
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        return $value;
    }

}
