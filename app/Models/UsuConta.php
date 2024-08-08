<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuConta extends Model
{
    protected $connection= 'sqlsrv';

    protected $table = 'UsuConta';

    protected $primaryKey = 'Usu_Codigo';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'Usu_Codigo',
        'Usu_ContaSaldo',
    ];

}
