<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementPlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_placements', function (Blueprint $table) {
            $table->id();
            $table->string('compte_name');
            $table->unsignedBigInteger('placement_id');
            $table->float('montant');
            $table->float('montant_restant');
            $table->foreign('placement_id')->references('id')->on('placements');
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
        Schema::dropIfExists('paiement_placements');
    }
}
