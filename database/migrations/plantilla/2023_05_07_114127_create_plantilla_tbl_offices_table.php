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
        Schema::create('plantilla_tbl_offices', function (Blueprint $table) {
            $table->id();
            $table->string('officeid')->nullable();
            $table->string('officelocid')->nullable();
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('website')->nullable();
            $table->date('encdate')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_offices');
    }
};
