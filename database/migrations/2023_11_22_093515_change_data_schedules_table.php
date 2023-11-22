<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->renameColumn('tournament_id', 'league_id');
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->renameColumn('league_id', 'tournament_id');
        });
    }
}
