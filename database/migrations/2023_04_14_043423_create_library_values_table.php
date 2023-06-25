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
        Schema::create('library_values', function (Blueprint $table) {
            $table->id();
            $table->integer('library_type_id');
            $table->integer('value_count_id')->nullable();
            $table->string('value');
            $table->string('description')->nullable();
            $table->integer('is_show')->default(0);
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_values');
    }
};
