<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UsuConta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){

        return view('usuarios.cadastro.index');

    }

    public function salvarNovoUsuario(Request $request){

        DB::beginTransaction();

        try{

            // remove todos os caracteres espeficicados e deixa somente os números.
            $CodigoNovoUsuario = str_replace(['.', '/', '-'], '', $request->input('Usu_Codigo'));

            $Usu_Usuario = User::where('Usu_Codigo', $CodigoNovoUsuario)->first();

            if(!is_null($Usu_Usuario)){

                Session::flash('mensagem_erro', 'Já existe um usuário cadastrado com esse CPF/CNPJ!');

                return redirect()->route('novo_usuario');
            }

            $Usu_Usuario = User::where('Usu_Email', $request->input('Usu_Email'))->first();

            if(!is_null($Usu_Usuario)){

                Session::flash('mensagem_erro', 'Já existe um usuário cadastrado com esse E-mail, favor inserir outro!');

                return redirect()->route('novo_usuario');
            }

            $Usuario = new User();

            $Usuario = $Usuario->create(
                [
                    'Usu_Codigo' => $CodigoNovoUsuario,
                    'Usu_NomeCompleto' => $request->input('Usu_NomeCompleto'),
                    'password' => Hash::make($request->input('password')),
                    'Usu_Email' => $request->input('Usu_Email'),
                    'Usu_TipoPessoa' => $request->input('Usu_TipoPessoa'),
                    'Usu_Ativo'=> 'S',
                ]
            );

            if($request->input('Usu_TipoPessoa') == 'F'){
                $valorSaldoBonus = 1000;
            }else{
                $valorSaldoBonus = 0;
            }


            $UsuConta = new UsuConta();

            $UsuConta = $UsuConta->create(
                [
                    'Usu_ContaSaldo'=> $valorSaldoBonus,
                    'Usu_Codigo' => $CodigoNovoUsuario,
                ]
            );

            DB::commit();

            Session::flash('mensagem_sucesso', 'Usuário criado com sucesso! Foi creditado para você um valor de R$ 1.000,00! Parabéns, faça login para acessar o seu saldo!');

            return redirect()->route('login');

        } catch (\Exception $e) {
            // Em caso de erro, desfaz a transação e lida com a exceção
            DB::rollback();

            Session::flash('mensagem_erro', 'Ocorreu algum erro ao Salvar. Favor tente novamente!');
            Session::flash('descricao_erro', 'Erro: ' . $e->getMessage());

            return redirect()->route('novo_usuario');

        }
    }

}
