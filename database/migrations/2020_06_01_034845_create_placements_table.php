<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant',65,2);
            $table->string('compte_name');
            $table->integer('nbre_moi');
            $table->decimal('interet_total',65,2);
            $table->decimal('interet',65,2);
            $table->decimal('interet_Moi',65,2);
            $table->decimal('place_interet',65,2)->nullable();
            $table->date('date_placement');
            $table->date('date_fin');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status')->default('NON PAYE');
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
        Schema::dropIfExists('placements');
    }
}
