<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('result_team_1')->nullable();
            $table->string('result_team_2')->nullable();
            $table->string('set_1_team_1')->nullable();
            $table->string('set_1_team_2')->nullable();
            $table->string('set_2_team_1')->nullable();
            $table->string('set_2_team_2')->nullable();
            $table->string('set_3_team_1')->nullable();
            $table->string('set_3_team_2')->nullable();
            $table->date('date')->change();
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('result_team_1');
            $table->dropColumn('result_team_2');
            $table->dropColumn('set_1_team_1');
            $table->dropColumn('set_1_team_1');
            $table->dropColumn('set_2_team_1');
            $table->dropColumn('set_2_team_2');
            $table->dropColumn('set_3_team_1');
            $table->dropColumn('set_3_team_2');
        });
    }
}
