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
            $table->float('montant_rembourse');
            $table->date('date_remboursement');
            $table->date('decouvert_id');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('decouvert_id')->references('id')->on('decouverts');
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
