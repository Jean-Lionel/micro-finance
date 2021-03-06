<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKirimbaOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kirimba_operations', function (Blueprint $table) {
            $table->id();
            $table->integer('kirimba_compte_id');
            $table->string('compte_name');
            $table->string('type_operation');
            $table->double('montant', 64 ,2);
            $table->double('benefice', 64 ,2)->default(0);
            $table->foreignId('user_id');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('kirimba_operations');
    }
}
