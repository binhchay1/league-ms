<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->renameColumn('number_of_team', 'number_of_athletes');
        });
    }

    public function down()
    {
        Schema::table('leagues', function (Blueprint $table) {

            $table->renameColumn('number_of_athletes', 'number_of_team');
        });
    }
}
