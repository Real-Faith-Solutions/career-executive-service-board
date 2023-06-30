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
        Schema::create('plantilla_tbl_remarks_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('cesno')->nullable();
            $table->string('subject')->nullable();
            $table->string('notes')->nullable();
            $table->string('effect_dt')->nullable();
            $table->string('created')->nullable();
            $table->string('encoder')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_remarks_reasons');
    }
};
