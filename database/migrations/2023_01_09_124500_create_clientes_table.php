<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('telefone');
            $table->string('nome', 255)->nullable();
            $table->unsignedBigInteger('como_soube_id')->nullable();
            $table->string('cpf', 14)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('rua', 255)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->integer('viabilidade')->nullable()->comment('0 - Rádio | 1 - Fibra | 2 - Inviável');
            $table->string('observacao', 1000)->nullable();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('como_soube_id')->references('id')->on('como_soube')->onDelete('NO ACTION')->onUpdate('CASCADE');
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
        Schema::dropIfExists('clientes');
    }
}
