<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->change();
            $table->string('location')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('condition')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expires_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('description')->change();
            $table->dropColumn('location')->nullable();
            $table->dropColumn('user_id')->nullable();
            $table->dropColumn('condition')->nullable();
            $table->dropColumn('start_date')->nullable();
            $table->dropColumn('expires_at')->nullable();
        });
    }
};
