<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'LoginController@index')->name('login');

Route::post('/login', 'LoginController@authenticate');

Route::get('/novo-usuario', 'UserController@index')->name('novo_usuario');

Route::post('/novo-usuario/salvar', 'UserController@salvarNovoUsuario');

Route::group(['middleware' => ['auth']], function () {

    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::get('sair_sistema', 'LoginController@logout')->name('sair_sistema');

    Route::get('/sem-permissao', 'ForbiddenController@index')->name('sem_permissao');

    Route::get('/tela-inicial', 'TelaInicialController@index')->name('tela_inicial');

    Route::get('/', 'TelaInicialController@index')->name('telainicial');

    Route::post('/transferencia/confirmar-dados', 'TransferenciaController@confirmarDadosTransferencia');

    Route::post('/transferencia/enviar', 'TransferenciaController@realizarTransferencia');

    Route::get('/transferencia', 'TransferenciaController@index')->name('transferencia');

    Route::get('/movimentacoes', 'MovimentacaoController@index');

    Route::get('/movimentacao_relatorio', 'MovimentacaoController@gerarRelatorio');

});
