<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementCompteOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_compte_operations', function (Blueprint $table) {
         $table->id();
         $table->string('type_operation');
         $table->string('compte_name');
         $table->double('montant',60,2);
         $table->integer('user_id');
         $table->text('placement');
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
        Schema::dropIfExists('placement_compte_operations');
    }
}
