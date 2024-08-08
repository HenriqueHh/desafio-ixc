<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuUsuario', function (Blueprint $table) {

            $table->decimal('Usu_Codigo',14,0);
            $table->string('Usu_NomeCompleto', 60);
            $table->string('Usu_Email')->unique();
            $table->string('password');
            $table->char('Usu_TipoPessoa',1);
            $table->char('Usu_Ativo',1);

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestampsTz(0);
            $table->primary('Usu_Codigo');

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
        Schema::dropIfExists('UsuUsuario');
    }
}
