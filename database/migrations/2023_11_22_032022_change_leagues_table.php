<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->decimal('money')->nullable();
            $table->string('slug')->nullable();
            $table->renameColumn('format', 'format_of_league');
            $table->string('type_of_league')->nullable();
        });
    }

    public function down()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('money');
            $table->dropColumn('slug');
            $table->dropColumn('type_of_league');
            $table->renameColumn('format_of_league', 'format');
        });
    }
}
