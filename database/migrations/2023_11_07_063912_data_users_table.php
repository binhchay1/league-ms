<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('role');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('age')->nullable();
            $table->string('sex')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('role');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('age');
            $table->dropColumn('sex');
        });
    }
}
