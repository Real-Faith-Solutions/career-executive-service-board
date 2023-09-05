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
        Schema::create('plantilla_tblOffice', function (Blueprint $table) {
            $table->id('officeid');
            $table->foreignId('officelocid')->constrained('plantilla_tblAgencyLocation', 'officelocid');
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('website')->nullable();
            $table->boolean('isActive')->default(true);
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblOffice');
    }
};
