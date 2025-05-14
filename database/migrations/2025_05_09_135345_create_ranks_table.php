<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id')->nullable();;
            $table->unsignedBigInteger('team_id')->nullable();;

            // Dữ liệu thống kê
            $table->integer('match_played')->default(0)->nullable();   // Số trận đã đấu
            $table->integer('win')->default(0)->nullable(); ;            // Trận thắng
            $table->integer('lose')->default(0)->nullable();;           // Trận thua
            $table->integer('point')->default(0)->nullable();;          // Tổng điểm (3 cho thắng, 0 cho thua)

            // Thông tin vòng đấu bị loại (cho knockout)
            $table->string('eliminated_round')->nullable(); // vd: "Quarterfinal", "Semifinal", "Final"

            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
