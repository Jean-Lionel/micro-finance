<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecouvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decouverts', function (Blueprint $table) {
            $table->id();
            $table->string('compte_name');
            $table->float('montant');
            $table->float('interet');
            $table->integer('periode');
            $table->float('total_a_rambourse');
            $table->float('montant_payer')->default(0);
            $table->float('montant_restant');
            $table->boolean('paye')->default(false);
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
        Schema::dropIfExists('decouverts');
    }
}
