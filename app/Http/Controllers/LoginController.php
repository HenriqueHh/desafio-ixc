<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Redirect;

class LoginController extends Controller
{

    // protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){

        return view('login.login');

    }

    public function authenticate(Request $request){

        try{

            $Usu_Usuario = User::where('Usu_Email', $request->input('Usu_Email'))->first();

            if(is_null($Usu_Usuario)){
                Session::flash('mensagem_inativo', 'Usuário não encontrado! Se está vendo essa mensagem por engano, favor entrar em contato com o Administrador.');
                return redirect()->route('login');
            }

            if($Usu_Usuario->USU_Ativo == 'N'){
                Session::flash('mensagem_inativo', 'Usuário sem permissão para fazer login. Inativado no Sistema!');
                return redirect()->route('login');
            }

            $data = $request->only([
            'Usu_Email',
            'password',
            ]);

            $validator = $this->validator($data);

            $remember = $request->input('remember', false);

            if ($validator->fails()){
                return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
            }
            if(Auth::attempt($data, $remember)){

                return redirect()->route('tela_inicial');
            }


            $validator->errors()->add('password', 'E-mail e/ou senha incorretos!');

            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();

        } catch (\Exception $e) {

            Session::flash('mensagem_inativo', 'Ocorreu algum erro ao fazer o login. Favor tentar novamente!');

            return redirect()->route('login');

        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'Usu_Email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:5']
        ]);
    }
}
