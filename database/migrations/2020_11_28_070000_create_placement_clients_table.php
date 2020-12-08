<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         if(Schema::hasTable('placement_clients')) return;  
        Schema::create('placement_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cni')->nullable();
            $table->string('telephone')->nullable();
            $table->string('addresse')->nullable();
            $table->string('mandataire_name')->nullable();
            $table->string('mandataire_telephone')->nullable();
            $table->string('mandataire_cni')->nullable();
            $table->string('mandataire_addresse')->nullable();
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
        Schema::dropIfExists('placement_clients');
    }
}
