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
        Schema::create('board_interviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('bid_bi_ces_we')->nullable();
            $table->string('r_bi_ces_we')->nullable();
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_interviews');
    }
};
