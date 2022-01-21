<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_histories', function (Blueprint $table) {
             $table->id();
             $table->foreignId("client_id");
            $table->string('nom');
            $table->string('prenom');
            $table->string('antenne')->nullable();
            $table->string('cni')->unique();
            $table->date('date_naissance');
            $table->date('date_ouverture')->nullable();
            $table->string('nom_association')->nullable();
            $table->string('nom_mandataire_1')->nullable();
            $table->string('nom_mandataire_2')->nullable();
            $table->string('nationalite')->nullable();
            $table->date('date_delivrance')->nullable();
            $table->enum('etat_civil',['CELIBATAIRE','MARIE','DIVORCE','VEUF','VEUVE']);

            $table->string('nom_conjoint')->nullable();
            $table->string('profession')->nullable();
            $table->string('nom_employeur')->nullable();
            $table->string('lieu_activite')->nullable();
            //Addresse 
            $table->string('commune')->nullable();
            $table->string('quartier')->nullable();
            $table->string('rue')->nullable();
            $table->string('address_no')->nullable();
            $table->string('boite_postal')->nullable();
            $table->string('telephone')->nullable();

            //Les signateurs 

            $table->string('signateur_1_nom_prenom')->nullable();
            $table->string('signateur_1_cni')->nullable();
            $table->string('signateur_1_tel')->nullable();

            $table->string('signateur_2_nom_prenom')->nullable();
            $table->string('signateur_2_cni')->nullable();
            $table->string('signateur_2_tel')->nullable();

             $table->string('signateur_3_nom_prenom')->nullable();
            $table->string('signateur_3_cni')->nullable();
            $table->string('signateur_3_tel')->nullable();
            $table->string('image')->nullable();
           
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
        Schema::dropIfExists('client_histories');
    }
}
