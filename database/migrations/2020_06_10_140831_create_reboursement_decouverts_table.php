<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReboursementDecouvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reboursement_decouverts', function (Blueprint $table) {
            $table->id();
            $table->string('compte_name');
            $table->float('montant');
            $table->date('date_remboursement');
            $table->integer('decouvert_id');
            $table->integer('user_id');
            $table->foreign('decouvert_id')->references('id')->on('decouverts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reboursement_decouverts');
    }
}
