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
            $table->id();
            $table->foreignId('plantilla_tblOffice_Addr_id');

            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_active')->default(true);

            // required in every table
            $table->string('updated_by')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
