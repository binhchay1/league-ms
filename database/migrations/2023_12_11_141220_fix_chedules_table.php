<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixChedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('round')->nullable();
            $table->bigInteger('player1_team_1')->nullable();
            $table->bigInteger('player2_team_1')->nullable();
            $table->bigInteger('player1_team_2')->nullable();
            $table->bigInteger('player2_team_2')->nullable();
            $table->dropColumn('team_id_1');
            $table->dropColumn('team_id_2');
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('player1_team_1');
            $table->dropColumn('player2_team_1');
            $table->dropColumn('player1_team_2');
            $table->dropColumn('player2_team_2');
        });
    }
}
