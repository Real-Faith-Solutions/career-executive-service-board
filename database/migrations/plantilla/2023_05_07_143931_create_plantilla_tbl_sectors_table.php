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
        Schema::create('plantilla_tbl_sectors', function (Blueprint $table) {
            $table->id();
            $table->string('sectorid')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_date')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_sectors');
    }
};
