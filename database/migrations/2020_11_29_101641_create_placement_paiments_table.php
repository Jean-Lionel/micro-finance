<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementPaimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_paiments', function (Blueprint $table) {
            $table->id();
            $table->double('montant',62,0);
            $table->dateTime('date_paiment')->useCurrent();
            $table->string('compte_name');
            $table->unsignedBigInteger('compte_placement_id');
            $table->unsignedBigInteger('placement_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('placement_paiments');
    }
}
