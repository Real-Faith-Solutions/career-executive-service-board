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
        Schema::table('board_interviews', function (Blueprint $table) {
            $table->string('type_of_interview')->nullable();
            $table->bigInteger('acno')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_interviews', function (Blueprint $table) {
            //
        });
    }
};
