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
        Schema::create('plantillalib__tbl_class_bases', function (Blueprint $table) {
            $table->id();
            $table->string('cbasis_code')->nullable();
            $table->string('basis')->nullable();
            $table->string('title')->nullable();
            $table->string('classdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib__tbl_class_bases');
    }
};
