<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('name')->unique();
           
            $table->decimal('montant',65,2)->default(0);
            $table->enum('type_compte',['COURANT','EPARGNE','']);
            $table->boolean('etat')->default(true);

            $table->timestamps();

            

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('comptes');
    }
}
