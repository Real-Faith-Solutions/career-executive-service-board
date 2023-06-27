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
        Schema::create('plantillalib__tbl_position_levels', function (Blueprint $table) {
            $table->id();
            $table->string('poslevel_code')->nullable();
            $table->string('seq')->nullable();
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('sg')->nullable();
            $table->string('pl_func_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib__tbl_position_levels');
    }
};
