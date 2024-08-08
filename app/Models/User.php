<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection= 'sqlsrv';

    protected $table = 'UsuUsuario';

    protected $keyType = 'string';

    protected $primaryKey = 'Usu_Codigo';

    protected $fillable = [
        'Usu_Codigo',              // Documento CPF/CNPJ
        'Usu_NomeCompleto',        // Nome completo
        'Usu_Email',               // Email do usuário, usado para acessar o sistema
        'password',                // Senha do usuário, usado para acessar o sistema
        'Usu_TipoPessoa',          // F= Pessoa Fisica/usuarios comuns, J= Pessoa Juridica/Lojistas
        'Usu_Ativo',               // Se está ativo ou não, S/N
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

