<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_trainings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id');
            $table->string('name');
            $table->bigInteger('number_of_members');
            $table->string('location');
            $table->string('activity_time');
            $table->string('description');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_trainings');
    }
}
