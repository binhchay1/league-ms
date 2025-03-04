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
            $table->string('slug');
            $table->string('status');
            $table->double('discount_price')->nullable();
            $table->integer('category')->change();
            $table->integer('brand')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_trainings', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('status');
            $table->dropColumn('discount_price');
            $table->string('category')->change();
            $table->string('brand')->change();
        });
    }
};
