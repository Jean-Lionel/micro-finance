<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptePrincipalOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compte_principal_operations', function (Blueprint $table) {
            $table->id();
            $table->float('retrait')->default(0);
            $table->float('versement')->default(0);
            $table->float('placement')->default(0);
            $table->float('decouvert')->default(0);
            $table->float('reboursement')->default(0);
            $table->float('depense')->default(0);
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('compte_principal_operations');
    }
}
