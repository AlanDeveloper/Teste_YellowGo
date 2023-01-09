<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('nome', 255);
            $table->integer('tipo_de_usuario')->comment('0 - Gerente | 1 - Comercial Ativo | 2 - Comercial Passivo | 3 - Comercial Reativo | 4 - Comercial PAP | 5 - Marketing');
            $table->boolean('status');
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('senha');
            $table->rememberToken();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('created_by')->references('id')->on('usuarios')->onDelete('NO ACTION')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('usuarios')->onDelete('NO ACTION')->onUpdate('CASCADE');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
