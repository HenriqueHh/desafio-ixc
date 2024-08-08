<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMovimentacaoConta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MovContaMovimentacao', function (Blueprint $table) {
            $table->id('Mov_Id');
            $table->decimal('Usu_CodigoOrigem',14,0);
            $table->decimal('Mov_Valor',17,2);
            $table->char('Mov_Status',1);
            $table->datetime('Mov_Data');


            $table->decimal('Usu_CodigoDestino',14,0);

            $table->rememberToken();
            $table->timestampsTz(0);

            $table->foreign('Usu_CodigoOrigem')->references('Usu_Codigo')->on('UsuUsuario');
            $table->foreign('Usu_CodigoDestino')->references('Usu_Codigo')->on('UsuUsuario');

            //->nullable(); permite que valores nulos sejam inseridos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MovContaMovimentacao');
    }
}

