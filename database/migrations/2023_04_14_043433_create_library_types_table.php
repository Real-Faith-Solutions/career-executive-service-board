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
        Schema::create('library_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('field_name')->nullable();
            $table->string('desscription')->nullable();
            $table->integer('sub_type')->nullable();
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
        Schema::dropIfExists('library_types');
    }
};
