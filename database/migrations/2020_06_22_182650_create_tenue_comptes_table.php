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
            $table->decimal('montant',60,2)->dafault(0);
            $table->string('compte_name');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
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
