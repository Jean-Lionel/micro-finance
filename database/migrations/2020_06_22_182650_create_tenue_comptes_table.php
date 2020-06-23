<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenueComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenue_comptes', function (Blueprint $table) {
            $table->id();
            $table->flaot('montant')->dafault(0);
            $table->integer('compte_id');
            $table->foreign('compte_id')->references('comptes')->on('id');
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
        Schema::dropIfExists('tenue_comptes');
    }
}
