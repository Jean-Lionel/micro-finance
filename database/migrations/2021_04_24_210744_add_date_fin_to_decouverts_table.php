<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateFinToDecouvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('decouverts', function (Blueprint $table) {
            //
            $table->dateTime("date_fin")->nullable()->after('periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decouverts', function (Blueprint $table) {
            //
            $table->dropColumn('date_fin');
        });
    }
}
