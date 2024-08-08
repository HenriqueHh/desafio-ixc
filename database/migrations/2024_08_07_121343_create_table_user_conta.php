<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserConta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuConta', function (Blueprint $table) {
            $table->decimal('Usu_Codigo',14,0);
            $table->decimal('Usu_ContaSaldo', 17,2);

            $table->rememberToken();
            $table->timestampsTz(0);
            $table->primary('Usu_Codigo');
            $table->foreign('Usu_Codigo')->references('Usu_Codigo')->on('UsuUsuario');

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
        Schema::dropIfExists('UsuConta');
    }
}
