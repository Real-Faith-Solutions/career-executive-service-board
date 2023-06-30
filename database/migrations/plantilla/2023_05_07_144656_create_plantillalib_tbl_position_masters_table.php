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
        Schema::create('plantillalib_tbl_position_masters', function (Blueprint $table) {
            $table->id();
            $table->string('pos_code')->nullable();
            $table->string('dbm_title')->nullable();
            $table->string('poslevel_code')->nullable();
            $table->string('sg')->nullable();
            $table->string('func_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tbl_position_masters');
    }
};
