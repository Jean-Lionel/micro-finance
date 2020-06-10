<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('compte_name');
            $table->enum('type_operation',['RETRAIT','VERSEMENT']);
            $table->string('operer_par');
            $table->string('cni');
            $table->float('montant');
            $table->integer('user_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
