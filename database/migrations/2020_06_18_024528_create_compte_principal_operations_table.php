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
            $table->decimal('retrait',60,2)->default(0);
            $table->decimal('versement',60,2)->default(0);
            $table->decimal('placement',60,2)->default(0);
            $table->decimal('decouvert',60,2)->default(0);
            $table->decimal('reboursement',60,2)->default(0);
            $table->decimal('tenue_compte',60,2)->default(0);
            $table->decimal('annulation_versement',60,2)->default(0);
            $table->decimal('annulation_retrait',60,2)->default(0);
            $table->decimal('paiment_placement',60,2)->default(0);
            $table->decimal('depense',60,2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('compte_name')->nullable();
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
        Schema::dropIfExists('compte_principal_operations');
    }
}
