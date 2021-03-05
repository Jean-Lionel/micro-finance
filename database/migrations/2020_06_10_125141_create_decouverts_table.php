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
            $table->decimal('montant',60,2);
            $table->decimal('interet',60,2);
            $table->integer('periode');
            $table->decimal('total_a_rambourse',60,2);
            $table->decimal('montant_payer',60,2)->default(0);
            $table->decimal('montant_restant',60,2);
            $table->boolean('paye')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('decouverts');
    }
}
