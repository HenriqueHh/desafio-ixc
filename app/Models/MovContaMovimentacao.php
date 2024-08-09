<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovContaMovimentacao extends Model
{
    protected $connection= 'sqlsrv';

    protected $table = 'MovContaMovimentacao';

    protected $primaryKey = 'Mov_Id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'Mov_Id',
        'Usu_CodigoOrigem',
        'Mov_Valor',
        'Mov_Status', // F = Finalizadas
        'Mov_Data',
        'Usu_CodigoDestino',
    ];

    public function UsuarioOrigem()
    {
        return $this->belongsTo('App\Models\User', 'Usu_CodigoOrigem', 'Usu_Codigo');
    }

    public function UsuarioDestino()
    {
        return $this->belongsTo('App\Models\User', 'Usu_CodigoDestino', 'Usu_Codigo');
    }
}
