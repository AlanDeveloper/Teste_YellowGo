<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsUtilizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails_utilizados', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->string('email', 255)->unique();

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
        Schema::dropIfExists('emails_utilizados');
    }
}
